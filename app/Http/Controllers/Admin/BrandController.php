<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::orderBy('id', 'desc')->get();
        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
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
            'status'=>'nullable|in:active,inactive',
            'slug' => 'nullable',
            'photo' => 'required|mimes:jpeg,jpg,png'
        ]);
        $brand=Brand::create([
            'title' => $request->title,
            'status' => $request->status,
            'slug' => $request->slug,
            'photo' => $request->photo
        ]);
        if($brand){
            return redirect()->route('brand.index')->with('success', 'Brand created successfully');

        }
        else{
            return redirect()->back()->with('error','Something went wrong');
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
        $brands=Brand::find($id);
        if($brands){
            return view('admin.brand.edit',compact('brands'));
        }
        else{
            return back()->with('error','Data Not Found');
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
            'title' => 'required|string|max:50',
            'status' => 'nullable|string|in:active,inactive',
            'slug' => 'nullable',
            'photo' => 'required|mimes:jpeg,jpg,png'

        ]);
        //saving the update data
        $brands=Brand::find($id);
        $brands->update($validatedData);
        return redirect()->route('brand.index')->with('success','Brand Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id!=null){
            $brands=Brand::where('id',$id);
            $brands->delete();
            return redirect()->route('brand.index')->with('success','Brand Deleted Successfully');
        }
    }
}
