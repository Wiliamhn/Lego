<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Supplier as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function import_invoices()
    {
        return $this->hasMany(ImportInvoice::class,'supplier_id','id');
    }
}