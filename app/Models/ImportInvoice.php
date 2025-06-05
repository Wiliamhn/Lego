<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\ImportInvoice as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ImportInvoice extends Model
{
    use HasFactory;

    protected $table = 'import_invoices';
    protected $primaryKey = 'id';
    protected $guarded = [];

    // Một hóa đơn nhập có nhiều chi tiết sản phẩm
    public function details()
    {
        return $this->hasMany(ImportInvoiceDetail::class,'import_invoice_id', 'id');
    }

    // Hóa đơn nhập thuộc về 1 nhà cung cấp
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
}