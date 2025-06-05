<?php

namespace App\Exports;

use App\Models\ImportInvoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ImportInvoiceDetailsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $importInvoice;

    public function __construct($importInvoice)
    {
        $this->importInvoice = $importInvoice;
    }

    public function collection()
    {
        // Thêm thông tin hóa đơn nhập vào đầu danh sách
        $invoiceInfo = collect([
            ['Import Invoice Information'], // Tiêu đề cho phần thông tin hóa đơn nhập
            ['Invoice ID', $this->importInvoice->id],
            ['Supplier', $this->importInvoice->supplier->name ?? 'N/A'],
            ['Import Date', $this->importInvoice->import_date ? \Carbon\Carbon::parse($this->importInvoice->import_date)->format('d/m/Y') : 'N/A'],
            ['Total Amount', '$' . number_format($this->importInvoice->total_amount, 2)],
            [''], // Dòng trống để phân tách
        ]);

        // Tiêu đề danh sách sản phẩm
        $productHeaders = collect([
            ['Product Name', 'Quantity', 'Unit Price', 'Total']
        ]);

        // Lấy danh sách sản phẩm của hóa đơn nhập
        $invoiceDetails = $this->importInvoice->details->map(function ($detail) {
            return [
                $detail->product->name ?? 'N/A',
                $detail->quantity,
                '$' . number_format($detail->unit_price, 2),
                '$' . number_format($detail->quantity * $detail->unit_price, 2),
            ];
        });

        // Gộp thông tin hóa đơn nhập, tiêu đề danh sách sản phẩm và danh sách sản phẩm
        return $invoiceInfo->concat($productHeaders)->concat($invoiceDetails);
    }

    public function headings(): array
    {
        // Trả về tiêu đề rỗng vì chúng ta đã chèn tiêu đề sản phẩm trong `collection()`
        return [];
    }

    public function map($row): array
    {
        return $row;
    }
}