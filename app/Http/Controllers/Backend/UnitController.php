<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function show()
    {
        $units = Unit::all();
        return view('backend.unit.view_unit', compact('units'));
    }

    public function add()
    {
        return view('backend.unit.add_unit');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:units|min:2',
        ]);


        $unit = new Unit();
        $unit->name = $request->name;
        $unit->save();

        $notification = array(
            'messege' => "Unit Added Successfully :)",
            'alert-type' => 'success'
        );
        return redirect()->route('view.unit')->with($notification);

    }

    public function edit($id)
    {
        $unit = Unit::find($id);
        return view('backend.unit.edit_unit', compact('unit'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:2|unique:units,name,'.$id,
        ]);

        $unit = Unit::find($id);
        $unit->name = $request->name;
        $unit->save();
        $notification = array(
            'messege' => "Unit Updated Successfully :)",
            'alert-type' => 'success'
        );
        return redirect()->route('view.unit')->with($notification);
    }

    public function destroy($id)
    {
        $unit = Unit::find($id);
        $unit->delete();
        $notification = array(
            'messege' => "Unit Deleted Successfully :)",
            'alert-type' => 'success'
        );
        return redirect()->route('view.unit')->with($notification);
    }
}
