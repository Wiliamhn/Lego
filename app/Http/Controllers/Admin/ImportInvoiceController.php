<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ImportInvoice;
use App\Models\ImportInvoiceDetail;
use App\Models\Supplier;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ImportInvoicesExport;
use App\Exports\ImportInvoiceDetailsExport;

class ImportInvoiceController extends Controller
{
    public function index(Request $request)
    {
        $timeFrame = $request->get('timeFrame', 'day');
        $search = $request->get('search');
        $supplierId = $request->get('supplier_id');

        $query = ImportInvoice::query();

        switch ($timeFrame) {
            case 'week':
                $query->whereBetween('import_date', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereMonth('import_date', now()->month)->whereYear('import_date', now()->year);
                break;
            case 'year':
                $query->whereYear('import_date', now()->year);
                break;
            default:
                $query->whereDate('import_date', now());
                break;
        }

        if ($supplierId) {
            $query->where('supplier_id', $supplierId);
        }

        if ($search) {
            $query->where('id', 'like', "%$search%");
        }

        $invoices = $query->orderByDesc('id')->paginate(5);
        $suppliers = Supplier::all();

        return view('admin.import_invoice.index', compact('invoices', 'timeFrame', 'search', 'supplierId', 'suppliers'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();

        return view('admin.import_invoice.create', compact('suppliers', 'products'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $totalAmount = 0;
            $productsData = [];

            foreach ($request->products as $index => $productId) {
                $quantity = $request->quantities[$index];
                $unitPrice = $request->prices[$index];
                $totalAmount += $quantity * $unitPrice;

                $productsData[] = [
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                ];
            }

            $invoice = ImportInvoice::create([
                'supplier_id' => $request->supplier_id,
                'import_date' => $request->import_date,
                'total_amount' => $totalAmount,
            ]);

            $invoice->details()->createMany($productsData);

            DB::commit();
            return redirect('admin/import-invoice')->with('success', 'Tạo hóa đơn thành công!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Lỗi: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $invoice = ImportInvoice::with('details')->findOrFail($id);
        $suppliers = Supplier::all();
        $products = Product::all();

        return view('admin.import_invoice.edit', compact('invoice', 'suppliers', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'import_date' => 'required|date',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.unit_price' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $invoice = ImportInvoice::findOrFail($id);
            $totalAmount = 0;
            $productsData = [];

            foreach ($request->products as $item) {
                $quantity = $item['quantity'];
                $unitPrice = $item['unit_price'];
                $totalAmount += $quantity * $unitPrice;

                $productsData[] = [
                    'product_id' => $item['product_id'],
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                ];
            }

            $invoice->update([
                'supplier_id' => $request->supplier_id,
                'import_date' => $request->import_date,
                'total_amount' => $totalAmount,
            ]);

            $invoice->details()->delete();
            $invoice->details()->createMany($productsData);

            DB::commit();
            return redirect('admin/import-invoice')->with('success', 'Cập nhật hóa đơn thành công!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Lỗi: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $importInvoice = ImportInvoice::with('details.product')->findOrFail($id);
        return view('admin.import_invoice.show', compact('importInvoice'));
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $invoice = ImportInvoice::findOrFail($id);
            $invoice->details()->delete();
            $invoice->delete();

            DB::commit();
            return redirect('admin/import-invoice')->with('success', 'Xóa hóa đơn thành công!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Lỗi: ' . $e->getMessage()]);
        }
    }

    public function export(Request $request)
    {
        $timeFrame = $request->input('timeFrame', 'day');
        $supplierId = $request->input('supplier_id');
        $search = $request->input('search', '');
        $fileName = 'import_invoices_' . $timeFrame . '_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(
            new ImportInvoicesExport($timeFrame, $supplierId, $search),
            $fileName
        );
    }

    public function exportDetails($id)
    {
        $importInvoice = ImportInvoice::with('details')->find($id);
        if (!$importInvoice) {
            return back()->withErrors(['error' => 'Không tìm thấy hóa đơn.']);
        }

        $fileName = 'import_invoice_details_' . $importInvoice->id . '_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(
            new ImportInvoiceDetailsExport($importInvoice),
            $fileName
        );
    }
}
