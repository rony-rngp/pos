<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function show()
    {
        $suppliers = Supplier::all();
        return view('backend.supplier.view_supplier', compact('suppliers'));
    }

    public function add()
    {
        return view('backend.supplier.add_supplier');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:30',
            'mobile' => 'required|unique:suppliers|min:9|max:15',
            'address' => 'required|min:4',
        ]);

        if($request->email){
            $validatedData = $request->validate([
                'email' => 'unique:suppliers',
            ]);
        }

        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->mobile = $request->mobile;
        $supplier->email = $request->email;
        $supplier->address = $request->address;
        $save = $supplier->save();

        $notification = array(
            'messege' => "Supplier Added Successfully :)",
            'alert-type' => 'success'
        );
        return redirect()->route('view.supplier')->with($notification);

    }

    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view('backend.supplier.edit_supplier', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'mobile' => 'required|min:9|max:15|unique:suppliers,mobile,'.$id,
            'address' => 'required|min:4',
        ]);

        if($request->email){
            $validatedData = $request->validate([
                'email' => 'unique:suppliers,email,'.$id,
            ]);
        }

        $supplier = Supplier::find($id);
        $supplier->name = $request->name;
        $supplier->mobile = $request->mobile;
        $supplier->email = $request->email;
        $supplier->address = $request->address;
        $supplier->save();
        $notification = array(
            'messege' => "Supplier Updated Successfully :)",
            'alert-type' => 'success'
        );
        return redirect()->route('view.supplier')->with($notification);
    }

    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        $notification = array(
            'messege' => "Supplier Deleted Successfully :)",
            'alert-type' => 'success'
        );
        return redirect()->route('view.supplier')->with($notification);
    }
}
