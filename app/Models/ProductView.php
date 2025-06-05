<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\ProductView as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ProductView extends Model
{
    use HasFactory;

    protected $table = 'product_views';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }


}
