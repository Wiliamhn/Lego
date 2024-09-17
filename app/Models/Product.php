<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table ='products';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function brand(){
        return $this->belongsTo(Brand::Class,'brand_id','id');
    }
    public function productCategory(){
        return $this->belongsTo(ProductCategory::Class,'product_category_id','id');
    }
    public function productImages(){
        return  $this->hasMany(ProductImage::Class, 'product_id', 'id');
    }
    public function productDetails(){
        return $this->hasMany(ProductDetail::Class, 'product_id', 'id');
    }
    public function productComments(){
        return $this->hasMany(ProductComment::Class, 'product_id', 'id');
    }
    public function orderDetails(){
        return $this->hasMany(OrderDetail::Class, 'product_id', 'id');
    }
}
