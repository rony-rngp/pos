<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show()
    {
        $categories = Category::all();
        return view('backend.category.view_category', compact('categories'));
    }

    public function add()
    {
        return view('backend.category.add_category');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories|min:2',
        ]);


        $category = new Category();
        $category->name = $request->name;
        $category->save();

        $notification = array(
            'messege' => "Category Added Successfully :)",
            'alert-type' => 'success'
        );
        return redirect()->route('view.category')->with($notification);

    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('backend.category.edit_category', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:2|unique:categories,name,'.$id,
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();
        $notification = array(
            'messege' => "Category Updated Successfully :)",
            'alert-type' => 'success'
        );
        return redirect()->route('view.category')->with($notification);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        $notification = array(
            'messege' => "Category Deleted Successfully :)",
            'alert-type' => 'success'
        );
        return redirect()->route('view.category')->with($notification);
    }
}
