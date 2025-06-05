<?php

namespace App\Exports;

use App\Models\ImportInvoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ImportInvoicesExport implements FromCollection, WithMapping, WithTitle, WithHeadings
{
    protected $timeFrame;
    protected $supplierId;
    protected $search;

    public function __construct($timeFrame, $supplierId, $search)
    {
        $this->timeFrame = $timeFrame;
        $this->supplierId = $supplierId;
        $this->search = $search;
    }

    public function collection()
    {
        $query = ImportInvoice::query();

        // Lọc theo thời gian
        if ($this->timeFrame === 'day') {
            $query->whereDate('import_date', today());
        } elseif ($this->timeFrame === 'week') {
            $query->whereBetween('import_date', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($this->timeFrame === 'month') {
            $query->whereMonth('import_date', now()->month)
                ->whereYear('import_date', now()->year);
        } elseif ($this->timeFrame === 'year') {
            $query->whereYear('import_date', now()->year);
        }

        // Lọc theo nhà cung cấp
        if ($this->supplierId) {
            $query->where('supplier_id', $this->supplierId);
        }

        // Lọc theo từ khóa tìm kiếm
        if ($this->search) {
            $query->where('id', 'like', '%' . $this->search . '%');
        }

        return $query->get();
    }

    // Định nghĩa tên cột
    public function headings(): array
    {
        return [
            'Invoice ID',
            'Supplier Name',
            'Import Date',
            'Total Amount',
        ];
    }

    // Áp dụng dữ liệu cho các cột trong Excel
    public function map($invoice): array
    {

        return [
            $invoice->id,
            $invoice->supplier->name ?? 'N/A',
            $invoice->import_date ? \Carbon\Carbon::parse($invoice->import_date)->format('d/m/Y') : 'N/A',
            number_format($invoice->details->sum(function ($detail) {
                return $detail->quantity * $detail->unit_price;
            }), 2),
        ];
    }

    // Đặt tên cho trang sheet trong Excel
    public function title(): string
    {
        return 'Import Invoices';
    }
}