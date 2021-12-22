<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands =Brand::orderBy('id', 'desc')->get();
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.product.create',compact('brands','categories'));
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
            'summary'=>'string|required',
            'description'=>'string|required',
            'stock'=>'required|numeric',
            'price'=>'required|numeric',
            'discount'=>'required|numeric',
            'condition'=>'required|in:new,popular,hot,winter,used',
            'status'=>'nullable|in:active,inactive',
            'slug' => 'nullable|unique:products',
            'photo' => 'required',
            'category_id'=>'required|exists:categories,id',
            'brand_id'=>'required',
            'size'=>'required',

        ]);
        // $products=Product::create([
        //     'title' => $request->title,
        //     'summary' => $request->summary,
        //     'description' => $request->description,
        //     'stock' => $request->stock,
        //     'price' => $request->price,
        //     'discount' => $request->discount,
        //     'condition' => $request->condition,
        //     'category_id' => $request->category_id,
        //     'brand_id' => $request->brand_id,
        //     'status' => $request->status,
        //     'slug' => $request->slug,
        //     'photo' => $request->photo,
        //     'size'=>$request->size,

        // ]);

        $data=$request->all();
        $data['offer_price']=($request->price-(($request->price*$request->discount)/100));
        $products=Product::create($data);

        if($products){
            return redirect()->route('product.index')->with('success', 'Product created successfully');

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
        $products=Product::find($id);
        $brands =Brand::orderBy('id', 'desc')->get();
        $categories = Category::orderBy('id', 'desc')->get();
        if($products){
            return view('admin.product.edit',compact('products','categories','brands'));
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
            'title'=>'string|required',
            'summary'=>'string|required',
            'description'=>'string|required',
            'stock'=>'required|numeric',
            'price'=>'required|numeric',
            'discount'=>'required|numeric',
            'condition'=>'required|in:new,popular,hot,winter,used',
            'status'=>'nullable|in:active,inactive',
            'slug' => 'nullable|unique:products',
            'photo' => 'required',
            'category_id'=>'required|exists:categories,id',
            'brand_id'=>'required',
            'size'=>'required'

        ]);
        //saving the update data
        $products=Product::find($id);
        $products->update($validatedData);
        return redirect()->route('product.index')->with('success','Product Updated Successfully');
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
            $products=Product::where('id',$id);
            $products->delete();
            return redirect()->route('product.index')->with('success','Product Deleted Successfully');
        }
    }
}
