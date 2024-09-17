<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductComment extends Model
{
    use HasFactory;

    protected $table ='product_comments';
    protected $primarykey = 'id';
    protected $guarded = [];

    public function products(){
        return $this-belongsTo(Product::Class, 'product_id', 'id');
    }
    public function user(){
        return $this->belongsTo(User::Class,'user_id','id');
    }
}
