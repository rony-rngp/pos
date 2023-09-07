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
use App\Models\Purchase;
use App\Models\ShopDetails;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class SettingsController extends Controller
{
    public function edit_profile()
    {
        $user = Auth::user();
        return view('backend.settings.edit_profile', compact('user'));
    }

    public function update_profile(Request $request, $id)
    {
        $this->validate($request, [
           'name' => 'required',
           'email' => 'required|email|unique:users,email,'.$id,
           'mobile' => 'unique:users,mobile,'.$id,
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $edit_user = User::find($id);
        $edit_user->name = $request->name;
        $edit_user->email = $request->email;
        $edit_user->mobile = $request->mobile;
        $edit_user->address = $request->address;
        $edit_user->gender = $request->gender;

        $image = $request->file('image');
        if($image){
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_fill_name = $image_name . '.' . $ext;
            //----Resize Large Image----
            $upload_path = 'public/backend/upload/users/';
            $image_url = $upload_path . $image_fill_name;
            Image::make($image)->resize(100, 100)->save($image_url);
            if(!empty($edit_user->image)){
                unlink($edit_user->image);
            }
            $edit_user->image = $image_url;
        }

        $edit_user->save();
        $notification = array(
            'messege' => "Profile Updated Successfully",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    public function change_password()
    {
        $user = Auth::user();
        return view('backend.settings.change_password', compact('user'));
    }

    public function check_current_pwd(Request $request)
    {
        if (Hash::check($request->c_pwd, Auth::user()->password)){
            echo 'true';
        }else{
            echo  'false';die();
        }
    }

    public function update_password(Request $request)
    {
        if (Hash::check($request->c_pwd, Auth::user()->password)){
            //Check if new and confirm password is matching
            if ($request->n_pwd == $request->con_pwd){
                //check new and old password is matching
                if (!Hash::check($request->con_pwd, Auth::user()->password)) {
                    //change password
                    $user = Auth::user();
                    $user->password = Hash::make($request->con_pwd);
                    $user->save();
                    $notification = array(
                        'messege' => "Password Successfully Changed!",
                        'alert-type' => 'success'
                    );
                    Auth::logout();
                    return redirect()->route('login')->with($notification);
                }else{
                    $notification = array(
                        'messege' => "Sorry ! New password can not be same as old password!",
                        'alert-type' => 'error'
                    );
                    return redirect()->back()->with($notification);
                }
            }else{
                $notification = array(
                    'messege' => "Confirm password does not match (:",
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        }else{
            $notification = array(
                'messege' => "Current Password is Wrong (:",
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function shop_details()
    {
        $shop = ShopDetails::first();
        return view('backend.settings.shop_details', compact('shop'));
    }

    public function update_shop_details(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'address' => 'required|min:4'
        ]);

        $shop = ShopDetails::find($id);
        $shop->name = $request->name;
        $shop->address = $request->address;
        $shop->save();

        $notification = array(
            'messege' => "Details Updated Successfully :)",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function erase_all_data(Request $request)
    {
        if (Hash::check($request->password, Auth::user()->password)){
            DB::table('suppliers')->delete();
            DB::table('customers')->delete();
            DB::table('units')->delete();
            DB::table('categories')->delete();
            DB::table('products')->delete();
            DB::table('purchases')->delete();
            DB::table('invoices')->delete();
            DB::table('invoice_details')->delete();
            DB::table('payments')->delete();
            DB::table('payment_details')->delete();

            $notification = array(
                'messege' => "Successfully Erase all data :)",
                'alert-type' => 'success'
            );
            return redirect()->route('home')->with($notification);
        }else{
            $notification = array(
                'messege' => "Sorry ! Your Password is Wrong :( ",
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }


    }
}
