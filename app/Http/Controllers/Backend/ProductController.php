<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show()
    {
        $products = Product::latest()->get();
        return view('backend.product.view_product', compact('products'));
    }

    public function add()
    {
        $data['suppliers'] = Supplier::all();
        $data['categories'] = Category::all();
        $data['units'] = Unit::all();
        return view('backend.product.add_product', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'supplier_id' => 'required',
           'category_id' => 'required',
           'name' => 'required|min:2',
           'unit_id' => 'required',
        ]);
        $products = Product::all();
        foreach ($products as $pro){
            if($pro->supplier_id == $request->supplier_id && $pro->category_id == $request->category_id && $pro->name == $request->name){
                $notification=array(
                    'messege' => "Sorry ! Product Already Taken (:",
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        }


        $product = new Product();
        $product->supplier_id = $request->supplier_id;
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->unit_id = $request->unit_id;
        $product->save();

        $notification=array(
            'messege' => "Product Added Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.product')->with($notification);
    }

    public function edit($id)
    {
        $data['suppliers'] = Supplier::all();
        $data['categories'] = Category::all();
        $data['units'] = Unit::all();
        $data['product'] = Product::find($id);
        return view('backend.product.edit_product', $data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'supplier_id' => 'required',
            'category_id' => 'required',
            'name' => 'required|min:2',
            'unit_id' => 'required',
        ]);

        $product = Product::find($id);
        $product->supplier_id = $request->supplier_id;
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->unit_id = $request->unit_id;
        $product->save();

        $notification=array(
            'messege' => "Product Updated Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.product')->with($notification);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        $notification=array(
            'messege' => "Product Deleted Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.product')->with($notification);
    }
}
