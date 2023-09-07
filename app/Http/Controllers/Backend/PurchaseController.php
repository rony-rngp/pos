<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class PurchaseController extends Controller
{
    public function show()
    {
        $data['purchases'] = Purchase::with(['category', 'supplier', 'product'])->orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', 1)->get();
        return view('backend.purchase.view_purchase', $data);
    }

    public function add()
    {
        $data['suppliers'] = Supplier::all();
        $purchase_data = Purchase::orderBy('id', 'desc')->first();
        if($purchase_data == NULL){
            $firstReg = 0;
            $data['purchase_no'] = $firstReg+1;
        }else{
            $purchase_da= Purchase::orderBy('id', 'desc')->first()->purchase_no;
            $data['purchase_no'] = $purchase_da+1;
        }
        return view('backend.purchase.add_purchase', $data);
    }

    public function get_category(Request $request)
    {
        Session::put('supplier_id', $request->supplier_id);
        $categories = Product::with('category')->where('supplier_id', $request->supplier_id)->get();
        return response()->json($categories);
    }

    public function get_product(Request $request)
    {
        $supplier_id = Session::get('supplier_id');
        $products = Product::where('supplier_id', $supplier_id)->where('category_id', $request->category_id)->get();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        if($request->category_id == NULL || $request->product_id == NULL){
            $notification=array(
                'messege' => "Field Must Not be Empty",
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }else{
            $count_category = count($request->category_id);
            for ($i=0; $i<$count_category; $i++){
                $purchase = new Purchase();
                $purchase->date = $request->date;
                $purchase->purchase_no = $request->purchase_no;
                $purchase->supplier_id = $request->supplier_id[$i];
                $purchase->category_id = $request->category_id[$i];
                $purchase->product_id = $request->product_id[$i];
                $purchase->buying_qty = $request->buying_qty[$i];
                $purchase->unit_price = $request->unit_price[$i];
                $purchase->buying_price = $request->buying_price[$i];
                $purchase->status = '0';
                $purchase->save();
            }

            $notification=array(
                'messege' => "purchase added successfully :)",
                'alert-type' => 'success'
            );
            return redirect()->route('pending.purchase')->with($notification);
        }
    }

    public function pending()
    {
        $data['purchases'] = Purchase::with(['category', 'supplier', 'product'])->orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', 0)->get();
        return view('backend.purchase.pending_purchase', $data);
    }

    public function approve($id)
    {
        $purchase = Purchase::find($id);
        $product = Product::where('id', $purchase->product_id)->first();
        $purchase_qty = ((float)($purchase->buying_qty)) + ((float)($product->quantity));
        $product->quantity = $purchase_qty;
        $product->save();
        DB::table('purchases')->where('id', $id)->update(['status' => 1]);
        $notification=array(
            'messege' => "Purchase Approved Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.purchase')->with($notification);
    }

    public function destroy($id)
    {
        $purchase = Purchase::find($id);
        $purchase->delete();
        $notification=array(
            'messege' => "Purchase Deleted Successfully",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function daily_report()
    {
        return view('backend.purchase.daily_report');
    }

    public function daily_report_pdf(Request $request)
    {
        $this->validate($request, [
           'start_date' => 'required',
           'end_date' => 'required',
        ]);

        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));
        $data['all_data'] = Purchase::whereBetween('date',[$start_date, $end_date])->where('status', '1')->get();
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;
        $pdf = PDF::loadView('backend.purchase.daily_report_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');

    }
}
