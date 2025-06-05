<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class DiscountCode extends Model
{
    use HasFactory;

    protected $table = 'discount_codes';
    protected $primaryKey = 'id';
    protected $guarded = []; // Cho phép mass assignment toàn bộ trừ các trường bị bảo vệ


}
