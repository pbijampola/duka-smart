<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
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
        $users=User::create([
            'title' => $request->title,
            'description' => $request->description,
            'condition' => $request->condition,
            'status' => $request->status,
            'slug' => $request->slug,
            'photo' => $request->photo
        ]);
        if($users){
            return redirect()->route('user.index')->with('success', 'Banner created successfully');

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
        $users=User::find($id);
        if($users){
            return view('admin.user.edit',compact('banner'));
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
        $users=User::find($id);
        $users->update($validatedData);
        return redirect()->route('user.index')->with('success','Banner Updated Successfully');
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
            $users=User::where('id',$id);
            $users->delete();
            return redirect('user.index')->with('success','Banner Deleted Successfully');
        }
    }
}
