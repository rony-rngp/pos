<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\PaymentDetails;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class CustomerController extends Controller
{
    public function show()
    {
        $customers = Customer::all();
        return view('backend.customer.view_customer', compact('customers'));
    }

    public function add()
    {
        return view('backend.customer.add_customer');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:30',
            'mobile' => 'required|unique:customers|min:9|max:15',
            'address' => 'required|min:4',
        ]);

        if($request->email){
            $validatedData = $request->validate([
                'email' => 'unique:customers',
            ]);
        }

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->mobile = $request->mobile;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->save();

        $notification = array(
            'messege' => "Customer Added Successfully :)",
            'alert-type' => 'success'
        );
        return redirect()->route('view.customer')->with($notification);

    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('backend.customer.edit_customer', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'mobile' => 'required|min:9|max:15|unique:customers,mobile,'.$id,
            'address' => 'required|min:4',
        ]);

        if($request->email){
            $validatedData = $request->validate([
                'email' => 'unique:customers,email,'.$id,
            ]);
        }

        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->mobile = $request->mobile;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->save();
        $notification = array(
            'messege' => "Customer Updated Successfully :)",
            'alert-type' => 'success'
        );
        return redirect()->route('view.customer')->with($notification);
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        $notification = array(
            'messege' => "Customer Deleted Successfully :)",
            'alert-type' => 'success'
        );
        return redirect()->route('view.customer')->with($notification);
    }

    public function credit_customer()
    {
        $credit_customers = Payment::with('customer', 'invoice')->whereIn('paid_status', ['full_due', 'partial_paid'])->get();
        return view('backend.customer.credit_customer', compact('credit_customers'));
    }

    public function credit_customer_pdf()
    {
        $data['credit_customer'] = Payment::with('customer', 'invoice')->whereIn('paid_status', ['full_due', 'partial_paid'])->get();
        $pdf = PDF::loadView('backend.customer.credit_customer_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf')->setPaper('A4')->stream();
    }

    public function edit_credit_customer($invoice_id)
    {
        /*$payment = Payment::with('invoice', 'customer')->where('invoice_id', $invoice_id)->first();*/
        $invoice = Invoice::with(['invoice_details', 'payment'])->find($invoice_id);
        return view('backend.customer.edit_credit_customer', compact('invoice'));
    }

    public function update_credit_customer(Request $request, $invoice_id)
    {
        if($request->new_paid_amount < $request->paid_amount){
            $notification=array(
                'messege' => "Sorry ! You have paid maximum Amount",
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }else{
            $payment = Payment::where('invoice_id', $invoice_id)->first();
            $payment_details = new PaymentDetails();
            $payment->paid_status = $request->paid_status;
            if($request->paid_status == 'full_paid'){
                $payment->paid_amount = Payment::where('invoice_id', $invoice_id)->first()['paid_amount']+$request->new_paid_amount;
                $payment->due_amount = '0';
                $payment_details->current_paid_amount = $request->new_paid_amount;
            }elseif ($request->paid_status == 'partial_paid'){
                $payment->paid_amount = Payment::where('invoice_id', $invoice_id)->first()['paid_amount']+$request->paid_amount;
                $payment->due_amount = Payment::where('invoice_id', $invoice_id)->first()['due_amount']-$request->paid_amount;
                $payment_details->current_paid_amount = $request->paid_amount;
            }

            $payment->save();
            $payment_details->invoice_id = $invoice_id;
            $payment_details->date = date('Y-m-d', strtotime($request->date));
            $payment_details->save();

            $notification=array(
                'messege' => "Data Updated Successfully",
                'alert-type' => 'success'
            );
            return redirect()->route('credit.customer')->with($notification);
        }
    }

    public function view_customer_details_pdf($invoice_id)
    {
        $data['invoice'] = Invoice::with(['invoice_details', 'payment', 'payment_details'])->find($invoice_id);
        $pdf = PDF::loadView('backend.customer.customer_details_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf')->setPaper('A4')->stream();
    }

    public function paid_customer()
    {
        $paid_customer = Payment::with('invoice', 'customer')->where('paid_status', 'full_paid')->get();
        return view('backend.customer.paid_customer', compact('paid_customer'));
    }
}
