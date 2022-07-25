<?php

namespace App\Http\Controllers;

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
        $dataProduct = Product::getAllProduct();
        // return $dataProduct;
        return view('backend.product.index',compact('dataProduct'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title'=>'bail|required|string',
            'image' => 'bail|required|mimes:jpeg,bmp,png',
            'description'=>'bail|string|nullable',
            'price' => 'bail|required|min:0',
            'stock' => 'bail|required|numeric|min:1',
            'cat_id'=>'bail|required|exists:categories,id',
            'brand_id'=>'bail|nullable|exists:brands,id',
            'child_cat_id'=>'bail|nullable|exists:categories,id',
            'status'=>'bail|required|in:active,inactive',
            'price'=>'bail|required|numeric',
            'discount'=>'bail|nullable|numeric|max:100',
        ]);
        $data = $request->all();
//         dd($data);
        if($request->hasFile('image')){
            $newImageName = time() . '-' . $request->image->getClientOriginalName();
            $request->image->move(public_path('upload/product'), $newImageName);
            $data['image'] = $newImageName;
        }
//        dd($data);
        $status = Product::create($data);
        if($status){
            return redirect()->route('product.index')->with('message', 'successfully');
        }else{
            return back()->with('error', 'something went wrong');
        }
        // // dd($data);
//        dd($request->file('image')->getClientOriginalExtension());
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
        $dataProduct = Product::find($id);
        if(!empty($dataProduct)){
            return view('backend.product.edit',compact('dataProduct'));
        }else{
            return redirect()->route('product.index')->with('error', 'data not found');
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
        //
        $request->validate([
            'title'=>'bail|required|string',
            'image' => 'bail|mimes:jpeg,bmp,png',
            'description'=>'bail|string|nullable',
            'price' => 'bail|required|min:0',
            'stock' => 'bail|required|numeric|min:1',
            'cat_id'=>'bail|required|exists:categories,id',
            'brand_id'=>'bail|nullable|exists:brands,id',
            'child_cat_id'=>'bail|nullable|exists:categories,id',
            'status'=>'bail|required|in:active,inactive',
            'price'=>'bail|required|numeric',
            'discount'=>'bail|nullable|numeric|max:100'
        ]);
//        dd(empty($request->child_cat_id));
        $data = $request->all();
        $product = Product::find($id);
        $cat_child_id = Category::where('parent_id', $request->cat_id)->get();
//        dd($data);
        if(empty($request->discount)){
            $data['discount'] = 0;
        }
        if(empty($request->child_cat_id))
            $data['child_cat_id'] = null;
        if(count($cat_child_id) == 0){
            $data['child_cat_id'] = null;
        }else{
             foreach ($cat_child_id as $key => $value) {
                 if ($value->id == $request->child_cat_id) {
                     $data['child_cat_id'] = $request->child_cat_id;
                     break;
                 }else{
                    $data['child_cat_id'] = null;
                 }
             }
        }

        if($request->hasFile('image')){
            $newImageName = time() . '-' . $request->image->getClientOriginalName();
            $request->image->move(public_path('upload/product'), $newImageName);
            $request->image = $newImageName;
            $data['image'] =  $newImageName;
        }
        if($product){
            $product->fill($data)->update();
            return redirect()->route('product.index')->with('message', 'successfully');
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
        $product = Product::find($id);
        if($product == true){
            $product->delete();
            return redirect()->route('product.index')->with('message', 'Product successfully deleted');
        }else{
            return back()->with('error','Please try again!');
        }
    }

    public function status(Request $request){
        if($request->check == 'true'){
            Product::findOrFail($request->id)->update(['status' => 'active']);
        }else{
            Product::findOrFail($request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['message' => 'update successfully']);
    }

}
