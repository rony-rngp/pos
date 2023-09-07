<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceDetails;
use App\Models\Payment;
use App\Models\PaymentDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class InvoiceController extends Controller
{
    public function show()
    {
        $invoices = Invoice::with('invoice_details', 'payment')->orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', 1)->get();
        return view('backend.invoice.view_invoice', compact('invoices'));
    }

    public function add()
    {
        $categories = Category::all();
        $customers = Customer::all();
        $invoice_date = Invoice::orderBy('id', 'desc')->first();
        if($invoice_date == NULL){
            $firstReg = 0;
            $invoice_no = $firstReg+1;
        }else{
            $invoice_da= Invoice::orderBy('id', 'desc')->first()->invoice_no;
            $invoice_no = $invoice_da+1;
        }
        return view('backend.invoice.add_invoice', compact('categories', 'invoice_no', 'customers'));
    }

    public function get_product(Request $request)
    {
        $products = Product::where('category_id', $request->category_id)->get();
        return response()->json($products);
    }

    public function check_product_stock(Request $request)
    {
        $product_id = $request->product_id;
        $check_product_stock = Product::where('id', $product_id )->first()->quantity;
        return response()->json($check_product_stock);
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
            if($request->paid_amount > $request->estimated_amount){
                $notification=array(
                    'messege' => "Sorry ! Paid amount is maximum than total price ",
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }else{
                $invoice = new Invoice();
                $invoice->invoice_no = $request->invoice_no;
                $invoice->date = date('Y-m-d',strtotime($request->date));
                $invoice->status = 0;
                DB::transaction(function () use($request, $invoice){
                    $count_category = count($request->category_id);
                    for ($i=0; $i<$count_category; $i++){
                        $invoice->save();
                        $invoice_details = new InvoiceDetails();
                        $invoice_details->invoice_id = $invoice->id;
                        $invoice_details->date = date('Y-m-d',strtotime($request->date));
                        $invoice_details->category_id = $request->category_id[$i];
                        $invoice_details->product_id = $request->product_id[$i];
                        $invoice_details->selling_qty = $request->selling_qty[$i];
                        $invoice_details->unit_price = $request->unit_price[$i];
                        $invoice_details->selling_price = $request->selling_price[$i];
                        $invoice_details->status = 0;
                        $invoice_details->save();
                    }
                    if($request->customer_id == '0'){
                        $customer = new Customer();
                        $customer->name = $request->name;
                        $customer->mobile = $request->mobile;
                        $customer->address = $request->address;
                        $customer->save();
                        $customer_id = $customer->id;
                    }else{
                        $customer_id = $request->customer_id;
                    }

                    $payment = new Payment();
                    $payment_details = new PaymentDetails();
                    $payment->invoice_id = $invoice->id;
                    $payment->customer_id = $customer_id;
                    $payment->paid_status = $request->paid_status;
                    $payment->total_amount = $request->estimated_amount;
                    $payment->discount_amount = $request->discount_amount;
                    if($request->paid_status == 'full_paid'){
                        $payment->paid_amount = $request->estimated_amount;
                        $payment->due_amount = '0';
                        $payment_details->current_paid_amount = $request->estimated_amount;
                    }elseif($request->paid_status == 'full_due'){
                        $payment->paid_amount = '0';
                        $payment->due_amount = $request->estimated_amount;
                        $payment_details->current_paid_amount = '0';
                    }elseif($request->paid_status == 'partial_paid'){
                        $payment->paid_amount = $request->paid_amount;
                        $payment->due_amount = $request->estimated_amount-$request->paid_amount;
                        $payment_details->current_paid_amount = $request->paid_amount;
                    }
                    $payment->save();

                    $payment_details->invoice_id = $invoice->id;
                    $payment_details->date = date('Y-m-d',strtotime($request->date));
                    $payment_details->save();
                });

                $notification=array(
                    'messege' => "Invoice Created Successfully",
                    'alert-type' => 'success'
                );
                return redirect()->route('pending.invoice')->with($notification);
            }
        }
    }

    public function pending()
    {
        $invoices = Invoice::with('invoice_details', 'payment')->orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', 0)->get();
        return view('backend.invoice.pending_invoice', compact('invoices'));
    }

    public function destroy($id){
        $invoice = Invoice::find($id);
        InvoiceDetails::where('invoice_id', $invoice->id)->delete();
        Payment::where('invoice_id', $invoice->id)->delete();
        PaymentDetails::where('invoice_id', $invoice->id)->delete();
        $invoice->delete();
        $notification=array(
            'messege' => "Invoice Deleted Successfully",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function approve($id)
    {
        $invoice = Invoice::with(['invoice_details', 'payment'])->find($id);
        return view('backend.invoice.approve_invoice', compact('invoice'));
    }

    public function approve_store(Request $request, $id)
    {
        foreach ($request->selling_qty as $key => $val){
            $invoice_details = InvoiceDetails::where('id', $key)->first();
            $product = Product::where('id', $invoice_details->product_id)->first();
            if($product->quantity < $request->selling_qty[$key]){
                $notification=array(
                    'messege' => "Sorry ! You Approve Maximum Quantity",
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        }
        $invoices = Invoice::find($id);
        $invoices->status = '1';
        DB::transaction(function () use ($request, $invoices,$id) {
            foreach ($request->selling_qty as $key => $val) {
                $invoice_details = InvoiceDetails::where('id', $key)->first();
                $invoice_details->status = 1;
                $invoice_details->save();
                $product = Product::where('id', $invoice_details->product_id)->first();
                $product->quantity = ((float)$product->quantity)-((float)$request->selling_qty[$key]);
                $product->save();
            }
            $invoices->save();
        });

        $notification=array(
            'messege' => "Invoice Approved Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.invoice')->with($notification);
    }

    public function print_invoice()
    {
        $invoices = Invoice::with('invoice_details', 'payment')->orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', 1)->get();
        return view('backend.invoice.print_invoice', compact('invoices'));
    }

    public function print_invoice_pdf($id)
    {
        $data['invoice'] = Invoice::with(['invoice_details', 'payment'])->find($id);
        $pdf = PDF::loadView('backend.invoice.print_invoice_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function daily_report()
    {
        return view('backend.invoice.daily_invoice_report');
    }

    public function daily_report_pdf(Request $request)
    {
        $this->validate($request, [
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));
        $data['all_data'] = Invoice::with('invoice_details', 'payment')->whereBetween('date',[$start_date, $end_date])->where('status', '1')->get();
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;
        $pdf = PDF::loadView('backend.invoice.daily_invoice_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
