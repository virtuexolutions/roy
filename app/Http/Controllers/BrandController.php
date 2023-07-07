<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
class BrandController extends Controller
{
    
    public function index()
    {
		$category=Category::getAllCategory();
        $brand=Brand::orderBy('id','DESC')->paginate();
        return view('backend.brand.index')->with('brands',$brand)->with('category',$category);
    }

    public function create()
    {
		$category=Category::getAllCategory();
        return view('backend.brand.create')->with('category',$category);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'string|required',
        ]);
        $data=$request->all();
        $slug=Str::slug($request->title);
        $count=Brand::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']=$slug;
    
        $status=Brand::create($data);
        if($status){
            request()->session()->flash('success','Brand successfully created');
        }
        else{
            request()->session()->flash('error','Error, Please try again');
        }
        return redirect()->route('brand.index');
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
        $brand=Brand::find($id);
        if(!$brand){
            request()->session()->flash('error','Brand not found');
        }
        return view('backend.brand.edit')->with('brand',$brand)->with('parent_cats',$parent_cats);
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
        $brand=Brand::find($id);
        $this->validate($request,[
            'title'=>'string|required',
        ]);
        $data=$request->all();
       
        $status=$brand->fill($data)->save();
        if($status){
            request()->session()->flash('success','Brand successfully updated');
        }
        else{
            request()->session()->flash('error','Error, Please try again');
        }
        return redirect()->route('brand.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand=Brand::find($id);
        if($brand){
            $status=$brand->delete();
            if($status){
                request()->session()->flash('success','Brand successfully deleted');
            }
            else{
                request()->session()->flash('error','Error, Please try again');
            }
            return redirect()->route('brand.index');
        }
        else{
            request()->session()->flash('error','Brand not found');
            return redirect()->back();
        }
    }
}
