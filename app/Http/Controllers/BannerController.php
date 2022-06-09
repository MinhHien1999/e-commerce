<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataBanner = Banner::orderBy('id', 'DESC')->get();
        return view('backend.banner.index',compact('dataBanner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'bail|required',
            'image' => 'bail|required|mimes:jpeg,bmp,png',
            'status'=>'in:active,inactive',
        ]);
        // dd($request->all());
        $data = new Banner;

        $data->title = $request->title;
        $data->description = $request->description;
        if($request->hasFile('image')){
            $newImageName = time() . '-' . $request->image->getClientOriginalName();
            $request->image->move(public_path('upload'), $newImageName);
            $data->image = $newImageName;
            // dd($request);
        }
        $data->status = $request->status;
        $data->save();
        return redirect()->route('banner.index')->with('message', 'successfully');
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
        //
        $dataBanner = Banner::find($id);
        // dd($dataBanner)
        if($dataBanner == null){
            return back()->with('error', 'data not found');

        }else{
            return view('backend.banner.edit',compact('dataBanner'));
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
        $request->validate([
            'title' => 'bail|required',
            'status'=>'required|in:active,inactive',
        ]);
        $data = $request->all();
        $banner = Banner::find($id);

        if($request->hasFile('image')){
            $newImageName = time() . '-' . $request->image->getClientOriginalName();
            $request->image->move(public_path('upload'), $newImageName);
            $request->image = $newImageName;
            $data['image'] =  $newImageName;
        }
        if($banner){
            $banner->fill($data)->update();
            return back()->with('message', 'successfully');
        }else{
            return back()->with('error', 'data not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $banner = Banner::find($id);
        if($banner == true){
            $banner->delete();
            return back()->with('message', 'successfully');
        }else{
            return back()->with('error', 'data not found');
        }
    }
    public function status(Request $request){
        if($request->check == 'true'){
            Banner::findOrFail($request->id)->update(['status' => 'active']);
        }else{
            Banner::findOrFail($request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['message' => 'successfully']);
    }
}
