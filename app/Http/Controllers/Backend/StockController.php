<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class StockController extends Controller
{
    public function stock_report()
    {
        $products = Product::orderBy('supplier_id', 'asc')->orderBy('category_id', 'asc')->get();
        return view('backend.stock.stock_report', compact('products'));
    }

    public function stock_report_pdf()
    {
        $data['all_data'] = Product::orderBy('supplier_id', 'asc')->orderBy('category_id', 'asc')->get();
        $pdf = PDF::loadView('backend.stock.stock_report_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function stock_report_supplier_product_wise()
    {
        $supplier = Supplier::all();
        $category = Category::all();
        return view('backend.stock.stock_report_supplier_product_wise', compact('supplier', 'category'));
    }

    public function get_product_invoice_report(Request $request)
    {
        $category_id = $request->category_id;
        $all_product = Product::where('category_id', $category_id )->get();
        return response()->json($all_product);
    }

    public function stock_report_product_wise_pdf(Request $request)
    {
        $data['product'] = Product::where('category_id', $request->category_id)->where('id',$request->product_id)->first();
        $pdf = PDF::loadView('backend.stock.stock_report_product_wise_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function stock_report_supplier_wise_pdf(Request $request)
    {
        $data['all_data'] = Product::orderBy('supplier_id', 'asc')->orderBy('category_id', 'asc')->where('supplier_id', $request->supplier_id)->get();
        $pdf = PDF::loadView('backend.stock.stock_report_supplier_wise_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
