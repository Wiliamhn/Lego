<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details';
    protected $primaryKey = 'id'; // Sửa từ $primarykey thành $primaryKey
    protected $guarded = [];

    public function order(){
        return $this->belongsTo(Order::Class, 'order_id', 'id');
    }

    public function product(){
        return $this->belongsTo(Product::Class, 'product_id', 'id');
    }
}
