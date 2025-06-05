<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BestSellingProductsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $products;
    protected $timeFrame;

    public function __construct($products, $timeFrame)
    {
        $this->products = $products;
        $this->timeFrame = $timeFrame;
    }

    public function collection()
    {
        return $this->products;
    }

    public function headings(): array
    {
        return [
            'Product ID',
            'Product Name',
            'Brand',
            'Quantity Sold',
            'Total Revenue',
            'Time Frame'
        ];
    }

    public function map($product): array
    {
        return [
            $product->id,
            $product->name,
            $product->brand_name ?? 'No Brand',
            $product->total_quantity,
            number_format($product->total_revenue, 2) . 'đ',
            ucfirst($this->timeFrame)
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            'A1:F' . ($this->products->count() + 1) => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ],
        ];
    }
}
