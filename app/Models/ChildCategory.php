<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    use HasFactory;
    protected $table = 'child_categories';
    protected $guarded = [];

    public static function getAllCategory()
    {
        return  ChildCategory::orderBy('id','DESC')->paginate(10);
    }

    public function parent_info()
    {
        return $this->hasOne('App\Models\Category','id','cat_id');
    }
    
    public function sub_cat_info()
    {
        return $this->hasOne('App\Models\SubCategory','id','sub_cat_id');
    }
}
