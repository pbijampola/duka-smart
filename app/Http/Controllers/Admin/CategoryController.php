<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.category.index', compact('categories'));
    }

    public function categorystatus(Request $request){
        if($request->mode=='true'){
            DB::table('categories')->where('id',$request->id)->update(['status'=>1]);
    }
    else{
        DB::table('categories')->where('id',$request->id)->update(['status'=>0]);
    }
    return response()->json(['message'=>'Category status change successfully.']);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_cats = Category::where('is_parent', 1)->orderBy('title',"DESC")->get();
        return view('admin.category.create',compact('parent_cats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'string|required',
            'summary'=>'string|nullable',
            'is_parent'=>'sometimes|in:1',
            'parent_id'=>'nullable||exists:categories,id',
            'status'=>'required|in:active,inactive'
        ]);
        $data=$request->all();
        $slug=Str::slug($request->title);
        $lug_count=Category::where('slug',$slug)->count();
        if($lug_count>0){
            $slug=$slug.'-'.$lug_count;
        }
        $data['slug']=$slug;
        $status=Category::create($data);
        if($status){
            return redirect('category.index')->with('success','Category added successfully.');
        }
        else{
            return redirect('category.index')->with('error','Something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories=Category::find($id);
        $parent_cats = Category::where('is_parent', 1)->orderBy('title',"ASC")->get();
        if($categories){

            return view('admin.category.edit',compact(['categories','parent_cats']));
        }
        else{
            return back()->with('error','category not found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validatedData=request()->validate([
            'title'=>'string|required',
            'summary'=>'string|nullable',
            'is_parent'=>'sometimes|in:1',
            'parent_id'=>'nullable|exists:categories,id',


        ]);
        //saving the update data
        $categories=Category::find($id);
        $categories->update($validatedData);
        return redirect()->route('category.index')->with('success','Category Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id=!null){
            $category=Category::where('id',$id);
            $category->delete();
            return redirect()->route('category.index')->with('success','Category Deleted Successfully');
        }

    }
}
