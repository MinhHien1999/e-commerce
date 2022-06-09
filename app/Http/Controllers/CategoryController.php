<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Category;
use function PHPUnit\Framework\isEmpty;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataCategory = Category::orderBy('id', 'DESC')->get();
        return view('backend.category.index', compact('dataCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $parent_cats = Category::where('is_parent',1)->orderBy('title', 'DESC')->get();
        return view('backend.category.create', compact('parent_cats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'title' => 'required',
            'is_parent' => 'sometimes|in:1',
            'parent_id' => 'nullable|not_in:0|exists:categories,id',
            'status' => 'in:active,inactive'
        ]);
        $data = $request->all();
        // dd($data);
        if( isset( $data['is_parent'])){
            unset( $data['parent_id'] );
        }else{
            if($data['parent_id'] == null){
                return back()->with('error', 'The selected parent id is invalid.');
            }
        }
        // // dd($data);
        $status = Category::create($data);
        if($status){
            return redirect()->route('category.index')->with('message', 'successfully');
        }else{
            return back()->with('error', 'something went wrong');
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
        //
        $parent_cats = Category::where('is_parent',1)->orderBy('title', 'DESC')->get();
        $dataCategory = Category::find($id);

        if($dataCategory == null){
            return back()->with('error', 'data not found');

        }else{
            return view('backend.category.edit',compact('dataCategory', 'parent_cats'));
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
            'title' => 'required',
            'is_parent' => 'sometimes|in:1',
            'parent_id' => 'nullable|not_in:0|exists:categories,id',
            'status' => 'in:active,inactive'
        ]);
        $data = $request->all();
        $Category = Category::find($id);
        // dd($data);
        if( isset( $data['is_parent'])){
            $data['parent_id'] = null;
        }else{
            if($data['parent_id'] == null){
                return back()->with('error', 'The selected parent id is invalid.');
            }
            $data['is_parent'] = 0;
        }
        if($Category){
            $Category->fill($data)->update();
            return redirect()->route('category.index')->with('message', 'successfully');
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
        $dataCategory = Category::find($id);
        $child_id_cat = Category::where('parent_id', $id)->pluck('id');
        $status= $dataCategory->delete();

        if($status){
            if(count($child_id_cat) > 0){
                Category::whereIn('id',$child_id_cat)->update(['is_parent' => 1]);
            }
            return back()->with('message', 'successfully');
        }else{
            return back()->with('error', 'Error while deleting category');
        }
        // dd($child_id_cat);
    }

    public function status(Request $request){
        if($request->check == 'true'){
            Category::findOrFail($request->id)->update(['status' => 'active']);
        }else{
            Category::findOrFail($request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['message' => 'successfully']);
    }

    public function getChildByParentId(request $request){
        $data = Category::getChildByParentId($request->cat_id);
        if(count($data) == 0){
            return Response()->json(['status' => 'null']);
        }else{
            return response()->json(['data' => $data]);
        }
    }
}
