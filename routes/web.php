<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

/*Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');*/

Route::group(['middleware'=>'auth'], function (){
    Route::get('/home', [\App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('home');
    //Supplier Routes
    Route::group(['prefix'=>'supplier'], function (){
        Route::get('/view', [\App\Http\Controllers\Backend\SupplierController::class, 'show'])->name('view.supplier');
        Route::get('/add', [\App\Http\Controllers\Backend\SupplierController::class, 'add'])->name('add.supplier');
        Route::post('/store', [\App\Http\Controllers\Backend\SupplierController::class, 'store'])->name('store.supplier');
        Route::get('/edit/{id}', [\App\Http\Controllers\Backend\SupplierController::class, 'edit'])->name('edit.supplier');
        Route::post('/update/{id}', [\App\Http\Controllers\Backend\SupplierController::class, 'update'])->name('update.supplier');
        Route::post('/destroy/{id}', [\App\Http\Controllers\Backend\SupplierController::class, 'destroy'])->name('destroy.supplier');
    });

    //Customer Routes
    Route::group(['prefix'=>'customer'], function (){
        Route::get('/view', [\App\Http\Controllers\Backend\CustomerController::class, 'show'])->name('view.customer');
        Route::get('/add', [\App\Http\Controllers\Backend\CustomerController::class, 'add'])->name('add.customer');
        Route::post('/store', [\App\Http\Controllers\Backend\CustomerController::class, 'store'])->name('store.customer');
        Route::get('/edit/{id}', [\App\Http\Controllers\Backend\CustomerController::class, 'edit'])->name('edit.customer');
        Route::post('/update/{id}', [\App\Http\Controllers\Backend\CustomerController::class, 'update'])->name('update.customer');
        Route::post('/destroy/{id}', [\App\Http\Controllers\Backend\CustomerController::class, 'destroy'])->name('destroy.customer');
        //---------Credit Customer-----
        Route::get('/credit', [\App\Http\Controllers\Backend\CustomerController::class, 'credit_customer'])->name('credit.customer');
        Route::get('/credit/pdf', [\App\Http\Controllers\Backend\CustomerController::class, 'credit_customer_pdf'])->name('credit.customer.pdf');
        Route::get('/edit/credit/customer/{invoice_id}', [\App\Http\Controllers\Backend\CustomerController::class, 'edit_credit_customer'])->name('edit.credit.customer');
        Route::post('/update/credit/customer/{invoice_id}', [\App\Http\Controllers\Backend\CustomerController::class, 'update_credit_customer'])->name('update.credit.customer');
        Route::get('/view/customer/details/pdf/{invoice_id}', [\App\Http\Controllers\Backend\CustomerController::class, 'view_customer_details_pdf'])->name('view.customer.details.pdf');
        //------Paid Customer-----
        Route::get('/paid', [\App\Http\Controllers\Backend\CustomerController::class, 'paid_customer'])->name('paid.customer');
        Route::get('/paid/pdf', [\App\Http\Controllers\Backend\CustomerController::class, 'paid_customer_pdf'])->name('paid.customer.pdf');

    });

    //Unit Routes
    Route::group(['prefix'=>'unit'], function (){
        Route::get('/view', [\App\Http\Controllers\Backend\UnitController::class, 'show'])->name('view.unit');
        Route::get('/add', [\App\Http\Controllers\Backend\UnitController::class, 'add'])->name('add.unit');
        Route::post('/store', [\App\Http\Controllers\Backend\UnitController::class, 'store'])->name('store.unit');
        Route::get('/edit/{id}', [\App\Http\Controllers\Backend\UnitController::class, 'edit'])->name('edit.unit');
        Route::post('/update/{id}', [\App\Http\Controllers\Backend\UnitController::class, 'update'])->name('update.unit');
        Route::post('/destroy/{id}', [\App\Http\Controllers\Backend\UnitController::class, 'destroy'])->name('destroy.unit');
    });

    //Category Routes
    Route::group(['prefix'=>'category'], function (){
        Route::get('/view', [\App\Http\Controllers\Backend\CategoryController::class, 'show'])->name('view.category');
        Route::get('/add', [\App\Http\Controllers\Backend\CategoryController::class, 'add'])->name('add.category');
        Route::post('/store', [\App\Http\Controllers\Backend\CategoryController::class, 'store'])->name('store.category');
        Route::get('/edit/{id}', [\App\Http\Controllers\Backend\CategoryController::class, 'edit'])->name('edit.category');
        Route::post('/update/{id}', [\App\Http\Controllers\Backend\CategoryController::class, 'update'])->name('update.category');
        Route::post('/destroy/{id}', [\App\Http\Controllers\Backend\CategoryController::class, 'destroy'])->name('destroy.category');
    });

    //Product Routes
    Route::group(['prefix'=>'product'], function (){
        Route::get('/view', [\App\Http\Controllers\Backend\ProductController::class, 'show'])->name('view.product');
        Route::get('/add', [\App\Http\Controllers\Backend\ProductController::class, 'add'])->name('add.product');
        Route::post('/store', [\App\Http\Controllers\Backend\ProductController::class, 'store'])->name('store.product');
        Route::get('/edit/{id}', [\App\Http\Controllers\Backend\ProductController::class, 'edit'])->name('edit.product');
        Route::post('/update/{id}', [\App\Http\Controllers\Backend\ProductController::class, 'update'])->name('update.product');
        Route::post('/destroy/{id}', [\App\Http\Controllers\Backend\ProductController::class, 'destroy'])->name('destroy.product');
    });

    //Purchase Routes
    Route::group(['prefix'=>'purchase'], function (){
        Route::get('/view', [\App\Http\Controllers\Backend\PurchaseController::class, 'show'])->name('view.purchase');
        Route::get('/add', [\App\Http\Controllers\Backend\PurchaseController::class, 'add'])->name('add.purchase');
        //---ajex---
        Route::post('/get-category', [\App\Http\Controllers\Backend\PurchaseController::class, 'get_category'])->name('purchase.get.category');
        Route::post('/get-product', [\App\Http\Controllers\Backend\PurchaseController::class, 'get_product'])->name('purchase.get.product');
        //--End ajex--
        Route::post('/store', [\App\Http\Controllers\Backend\PurchaseController::class, 'store'])->name('store.purchase');
        Route::get('/pending', [\App\Http\Controllers\Backend\PurchaseController::class, 'pending'])->name('pending.purchase');
        Route::get('/approve/{id}', [\App\Http\Controllers\Backend\PurchaseController::class, 'approve'])->name('approve.purchase');
        Route::post('/destroy/{id}', [\App\Http\Controllers\Backend\PurchaseController::class, 'destroy'])->name('destroy.purchase');
        Route::get('/daily/report', [\App\Http\Controllers\Backend\PurchaseController::class, 'daily_report'])->name('daily.purchase.report');
        Route::get('/daily/report/pdf', [\App\Http\Controllers\Backend\PurchaseController::class, 'daily_report_pdf'])->name('daily.purchase.report.pdf');
    });

    //Invoice Routes
    Route::group(['prefix'=>'invoice'], function (){
        Route::get('/view', [\App\Http\Controllers\Backend\InvoiceController::class, 'show'])->name('view.invoice');
        Route::get('/add', [\App\Http\Controllers\Backend\InvoiceController::class, 'add'])->name('add.invoice');
        //---ajex---
        Route::post('/get-product', [\App\Http\Controllers\Backend\InvoiceController::class, 'get_product'])->name('invoice.get.product');
        Route::post('/get-product-stock', [\App\Http\Controllers\Backend\InvoiceController::class, 'check_product_stock'])->name('check.product.stock');
        //--End ajex--
        Route::post('/store', [\App\Http\Controllers\Backend\InvoiceController::class, 'store'])->name('store.invoice');
        Route::get('/pending', [\App\Http\Controllers\Backend\InvoiceController::class, 'pending'])->name('pending.invoice');
        Route::get('/approve/{id}', [\App\Http\Controllers\Backend\InvoiceController::class, 'approve'])->name('approve.invoice');
        Route::post('/approve/store/{id}', [\App\Http\Controllers\Backend\InvoiceController::class, 'approve_store'])->name('approve.store.invoice');
        Route::post('/destroy/{id}', [\App\Http\Controllers\Backend\InvoiceController::class, 'destroy'])->name('destroy.invoice');
        Route::get('/print/invoice', [\App\Http\Controllers\Backend\InvoiceController::class, 'print_invoice'])->name('print.invoice');
        Route::get('/print/invoice/pdf/{id}', [\App\Http\Controllers\Backend\InvoiceController::class, 'print_invoice_pdf'])->name('print.invoice.pdf');
        Route::get('/daily/report', [\App\Http\Controllers\Backend\InvoiceController::class, 'daily_report'])->name('daily.invoice.report');
        Route::get('/daily/report/pdf', [\App\Http\Controllers\Backend\InvoiceController::class, 'daily_report_pdf'])->name('daily.invoice.report.pdf');
    });

    //Stock Routes
    Route::group(['prefix'=>'stock'], function (){
        Route::get('/report', [\App\Http\Controllers\Backend\StockController::class, 'stock_report'])->name('stock.report');
        Route::get('/report/pdf', [\App\Http\Controllers\Backend\StockController::class, 'stock_report_pdf'])->name('stock.report.pdf');
        Route::get('/report/supplier/product/wise', [\App\Http\Controllers\Backend\StockController::class, 'stock_report_supplier_product_wise'])->name('stock.report.supplier.product.wise');
        Route::get('/report/supplier/wise/pdf', [\App\Http\Controllers\Backend\StockController::class, 'stock_report_supplier_wise_pdf'])->name('stock.report.supplier.wise.pdf');
        Route::get('/report/product/wise/pdf', [\App\Http\Controllers\Backend\StockController::class, 'stock_report_product_wise_pdf'])->name('stock.report.product.wise.pdf');
        Route::get('/get/product/invoice/report', [\App\Http\Controllers\Backend\StockController::class, 'get_product_invoice_report'])->name('get.product.invoice.report');
    });

    //--Settings -------
    Route::group(['prefix' => 'settings'], function (){
        Route::get('/edit/profile', [\App\Http\Controllers\Backend\SettingsController::class, 'edit_profile'])->name('edit.profile');
        Route::post('/update/profile/{id}', [\App\Http\Controllers\Backend\SettingsController::class, 'update_profile'])->name('update.profile');
        Route::get('/change/password', [\App\Http\Controllers\Backend\SettingsController::class, 'change_password'])->name('change.password');
        Route::post('/update/password', [\App\Http\Controllers\Backend\SettingsController::class, 'update_password'])->name('update.password');
        Route::get('/check/current/password', [\App\Http\Controllers\Backend\SettingsController::class, 'check_current_pwd'])->name('check.current.pwd');
        Route::get('/shop/details', [\App\Http\Controllers\Backend\SettingsController::class, 'shop_details'])->name('shop.details');
        Route::post('update/shop/details/{id}', [\App\Http\Controllers\Backend\SettingsController::class, 'update_shop_details'])->name('update.shop.details');
        Route::post('erase/all/data', [\App\Http\Controllers\Backend\SettingsController::class, 'erase_all_data'])->name('erase.all.data');
    });
});
