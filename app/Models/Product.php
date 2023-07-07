<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
class Product extends Model
{
    protected $guarded=[];

    public function cat_info()
    {
         return $this->hasOne('App\Models\Category','id','cat_id');
    }
    
    public function sub_cat_info()
    {
        return $this->hasOne('App\Models\SubCategory','id','sub_cat_id');
    }
    
    public function child_cat_info()
    {
        return $this->hasOne('App\Models\ChildCategory','id','child_cat_id');
    }
    
    public static function getAllProduct()
    {
        return Product::with(['cat_info','sub_cat_info'])->orderBy('id','desc')->paginate(10);
    }
    
    public function rel_prods()
    {
        return $this->hasMany('App\Models\Product','cat_id','cat_id')->where('status','active')->orderBy('id','DESC')->limit(8);
    }
    
    public function getReview()
    {
        return $this->hasMany('App\Models\ProductReview','product_id','id')->with('user_info')->where('status','active')->orderBy('id','DESC');
    }
    
    public static function getProductBySlug($slug)
    {
        return Product::with(['cat_info','rel_prods','getReview'])->where('slug',$slug)->first();
    }
    
    public static function countActiveProduct()
    {
        $data=Product::where('status','active')->count();
        if($data)
        {
            return $data;
        }
        return 0;
    }

    public function carts()
    {
        return $this->hasMany(Cart::class)->whereNotNull('order_id');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class)->whereNotNull('cart_id');
    }

    public function brands()
    {
        return $this->hasOne(Brand::class,'id','brand_id');
    }

    public function colors()
    {
        return $this->hasMany('App\Models\Color','product_id','id');
    }

    public function sizes()
    {
        return $this->hasMany('App\Models\Size','product_id','id');
    }

}
