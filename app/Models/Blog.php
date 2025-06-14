<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table ='blogs';
    protected $primarykey = 'id';
    protected $guarded = [];

    public function blogComments(){
        return $this->hasMany(BlogComment::class , 'blog_id', 'id');
    }
      public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

}
