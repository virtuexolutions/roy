<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_categories';
    protected $guarded = [];

    public static function getAllCategory()
    {
        return  SubCategory::orderBy('id','DESC')->paginate(10);
    }

    public function parent_info()
    {
        return $this->hasOne('App\Models\Category','id','cat_id');
    }
}
