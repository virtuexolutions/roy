<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::getAllProduct();
        // return $products;
        return view('backend.product.index')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand=Brand::get();
        $category=Category::where('status','active')->get();
        // return $category;
        return view('backend.product.create')->with('categories',$category)->with('brands',$brand);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $slug=Str::slug($request->title);
        $count= Product::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        // $data['slug']=$slug;

        $data = [
            'title'     => $request->title,
            'slug'     => $slug,
            'cat_id'    => $request->cat_id, 
            'sub_cat_id'    => $request->sub_cat_id, 
            'child_cat_id'    => $request->child_cat_id, 
            'brand_id'    => $request->brand_id, 
            'type'    => $request->type, 
            'sku'    => $request->sku, 
            'designer'    => $request->designer, 
            'description'    => $request->description, 
            'gender'    => $request->gender, 
            'notes'    => $request->notes, 
            'year_introduced'    => $request->year_introduced, 
            'recommended_use'    => $request->recommended_use, 
            'msrp'    => $request->msrp, 
            'wholsale_price'    => $request->price, 
            'large_image'    => $request->large_image, 
            'slug'    => $slug, 
            'small_image'    => $request->small_image, 
            'url'    => $request->url, 
            'upc'    => $request->upc, 
            'stock'    => $request->stock, 
            'size'    => '', 
            'color'    => '', 
            'status'    => $request->status, 
        ];
        // return $size;
        // return $data;
        $status=Product::create($data);
        if($status){
            request()->session()->flash('success','Product Successfully added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('product.index');

    }

    public function import() 
    {
        Excel::import(new ProductImport,request()->file('file'));
        request()->session()->flash('success','Product Successfully added');
        return back();
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
        $brand=Brand::get();
        $product=Product::findOrFail($id);
        
        $category=Category::where('status','active')->get();
        $items=Product::where('id',$id)->get();
        // return $items;
        return view('backend.product.edit')->with('product',$product)
                    ->with('brands',$brand)
                    ->with('categories',$category)->with('items',$items);
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
        $product=Product::findOrFail($id);
        $slug=Str::slug($request->title);
        $count= Product::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        // return $request->child_cat_id;
       
        $data = [
            'title'     => $request->title,
            'slug'     => $slug,
            'cat_id'    => $request->cat_id, 
            'sub_cat_id'    => $request->sub_cat_id, 
            'child_cat_id'    => $request->child_cat_id, 
            'brand_id'    => $request->brand_id, 
            'type'    => $request->type, 
            'sku'    => $request->sku, 
            'designer'    => $request->designer, 
            'description'    => $request->description, 
            'gender'    => $request->gender, 
            'notes'    => $request->notes, 
            'year_introduced'    => $request->year_introduced, 
            'recommended_use'    => $request->recommended_use, 
            'msrp'    => $request->msrp, 
            'wholsale_price'    => $request->price, 
            'large_image'    => $request->large_image, 
            'small_image'    => $request->small_image, 
            'url'    => $request->url, 
            'slug'    => $slug, 
            'upc'    => $request->upc, 
            'stock'    => $request->stock, 
            'size'    => '', 
            'color'    => '', 
            'status'    => 'Active', 
        ];

        $status=$product->fill($data)->save();
       
        if($status){
            request()->session()->flash('success','Product Successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::findOrFail($id);
        $status=$product->delete();
        
        if($status){
            request()->session()->flash('success','Product successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting product');
        }
        return redirect()->route('product.index');
    }
}
