<?php

namespace App\Http\Controllers;

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
        //
        $dataBrand = Brand::orderBy('id', 'DESC')->get();
        return view('backend.brand.index', compact('dataBrand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.brand.create');
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

        $data = new Brand();
        $data->title = $request->title;

        if($request->hasFile('image')){
            $newImageName = time() . '-' . $request->image->getClientOriginalName();
            $request->image->move(public_path('upload/brand'), $newImageName);
            $data->image = $newImageName;
        }
        $data->status = $request->status;
        $data->save();
        return redirect()->route('brand.index')->with('message', 'successfully');
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
        $dataBrand = Brand::find($id);
        return view('backend.brand.edit',compact('dataBrand'));
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
        $brand = Brand::find($id);

        if($request->hasFile('image')){
            $newImageName = time() . '-' . $request->image->getClientOriginalName();
            $request->image->move(public_path('upload/brand'), $newImageName);
            $request->image = $newImageName;
            $data['image'] =  $newImageName;
        }

        if($brand){
            $brand->fill($data)->update();
            return redirect()->route('brand.index')->with('message', 'successfully');
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
        $brand = Brand::find($id);
        if($brand == true){
            $brand->delete();
            return redirect()->route('brand.index')->with('message', 'successfully');
        }else{
            return back()->with('error', 'data not found');
        }
    }

    public function status(Request $request){
        if($request->check == 'true'){
            Brand::findOrFail($request->id)->update(['status' => 'active']);
        }else{
            Brand::findOrFail($request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['message' => 'update successfully']);
    }
}
