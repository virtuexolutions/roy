<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use Illuminate\Support\Str;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category= ChildCategory::getAllCategory();
        // return $category;
        return view('backend.child_category.index')->with('categories',$category);
    }

    public function getsubcat($id)
    {
        $children = SubCategory::where('cat_id', $id)->get();

        return response()->json($children);
    }
	
	public function getbrand($id)
    {
        $brand = Brand::where('category_id', $id)->get();

        return response()->json($brand);
    }
    
    public function getchildcat($id)
    {
        $children = ChildCategory::where('sub_cat_id', $id)->get();

        return response()->json($children);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_cats= Category::orderBy('title','ASC')->get();
        return view('backend.child_category.create')->with('parent_cats',$parent_cats);
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
        $this->validate($request,[
            'title'=>'string|required',
            'photo'=>'string|nullable',
            'status'=>'required|in:active,inactive',
            'cat_id'=>'required|exists:categories,id',
            'sub_cat_id'=>'nullable|exists:sub_categories,id',
        ]);
        $data= $request->all();
        $slug=Str::slug($request->title);
        $count= ChildCategory::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']=$slug;
        // return $data;   
        $status= ChildCategory::create($data);
        if($status){
            request()->session()->flash('success','Category successfully added');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('child_category.index');


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
        $parent_cats= Category::get();
        $sub_cats= SubCategory::get();
        $category= ChildCategory::findOrFail($id);
        return view('backend.child_category.edit')->with('category',$category)->with('sub_category',$sub_cats)->with('parent_cats',$parent_cats);
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
        // return $request->all();
        $category= ChildCategory::findOrFail($id);
        $this->validate($request,[
            'title'=>'string|required',
            'photo'=>'string|nullable',
            'status'=>'required|in:active,inactive',
            'cat_id'=>'required|exists:categories,id',
            'sub_cat_id'=>'nullable|exists:sub_categories,id',
        ]);
        $data= $request->all();
		
		$slug=Str::slug($request->title);
        $count= ChildCategory::where('slug',$slug)->count();
        if($count>0)
        {
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }

        $data['slug']=$slug;
		
        // return $data;
        $status=$category->fill($data)->save();
        if($status){
            request()->session()->flash('success','Category successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('child_category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category= ChildCategory::findOrFail($id);
        // return $child_cat_id;
        $status=$category->delete();
        
        
        request()->session()->flash('success','Category successfully deleted');
        return redirect()->route('child_category.index');
    }

    public function getChildByParent(Request $request){
        // return $request->all();
        $category= ChildCategory::findOrFail($request->id);
        $child_cat= ChildCategory::getChildByParentID($request->id);
        // return $child_cat;
        if(count($child_cat)<=0){
            return response()->json(['status'=>false,'msg'=>'','data'=>null]);
        }
        else{
            return response()->json(['status'=>true,'msg'=>'','data'=>$child_cat]);
        }
    }
}
