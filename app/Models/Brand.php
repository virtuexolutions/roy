<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $guarded=[];


    public function products()
    {
        return $this->hasMany('App\Models\Product','brand_id','id')->where('status','active');
    }
    public static function getProductByBrand($slug)
    {
        return Brand::with('products')->where('slug',$slug)->first();
    }
	
	public function parent_info()
    {
        return $this->hasOne('App\Models\Category','id','category_id');
    }
}
