<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::orderBy('id', 'desc')->get();
        return view('admin.banner.index', compact('banners'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required|string|max:50',
            'description' => 'required',
            'condition' => 'nullable|string|in:banner,promo',
            'status' => 'nullable|string|in:active,inactive',
            'slug' => 'required',
            'photo' => 'required'

        ]);
        $banner=Banner::create([
            'title' => $request->title,
            'description' => $request->description,
            'condition' => $request->condition,
            'status' => $request->status,
            'slug' => $request->slug,
            'photo' => $request->photo
        ]);
        if($banner){
            return redirect()->route('banner.index')->with('success', 'Banner created successfully');

        }
        else{
            return redirect()->back()->with('error','Something went wrong');
        }

        // return $request->all();
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
        $banner=Banner::find($id);
        if($banner){
            return view('admin.banner.edit',compact('banner'));
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
            'description' => 'required',
            'condition' => 'nullable|string|in:banner,promo',
            'status' => 'nullable|string|in:active,inactive',
            'slug' => 'required',
            'photo' => 'required'

        ]);
        //saving the update data
        $banner=Banner::find($id);
        $banner->update($validatedData);
        return redirect()->route('banner.index')->with('success','Banner Updated Successfully');

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
            $banner=Banner::where('id',$id);
            $banner->delete();
            return redirect('banner.index')->with('success','Banner Deleted Successfully');
        }

    }
}
