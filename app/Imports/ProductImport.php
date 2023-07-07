<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; 
class ProductImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $slug=\Str::slug($row['name']);
        $count=Product::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(9999,999);
        }

        return new Product([
            'title'     => $row['name'],
            'slug'     => $slug,
            'category'    => $row['category'], 
            'brand'    => $row['brand'], 
            'type'    => $row['type'], 
            'sku'    => $row['sku'], 
            'designer'    => $row['designer'], 
            'description'    => $row['description'], 
            'gender'    => $row['gender'], 
            'notes'    => $row['notes'], 
            'year_introduced'    => $row['introduced_year'], 
            'recommended_use'    => $row['recommended_use'], 
            'msrp'    => $row['msrp'], 
            'wholsale_price'    => $row['wholesale_price'], 
            'large_image'    => $row['image_large'], 
            'small_image'    => $row['image_small'], 
            'url'    => $row['url'], 
            'upc'    => $row['upc'], 
            'stock'    => $row['quantity'], 
            'size'    => '', 
            'color'    => '', 
            'status'    => 'Active', 
        ]);
    }
}
