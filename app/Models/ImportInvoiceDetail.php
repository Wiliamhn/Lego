<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\ImportInvoiceDetail as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ImportInvoiceDetail extends Model
{
    use HasFactory;

    protected $table = 'import_invoice_details';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function invoice()
    {
        return $this->belongsTo(ImportInvoice::class,'import_invoice_id','id');
    }


    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}