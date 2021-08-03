<?php

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

Route::get('/',function (){
    return redirect()->route('login');
});
Route::group(['middleware'=>'guest'],function (){

    Route::get('/login','LoginController@index')->name('login');
    Route::post('/login','LoginController@login')->name('login');
});


Route::get('/dashboard', function () {
    return redirect()->route('home');
});

Route::group(['prefix'=>'dashboard','middleware'=>['auth','lang']],function (){

    Route::get('http://localhost/projects/NazeehSystem/public/dashboard/lang/{lang}',function ($lang){
        session()->has('lang')?session()->forget('lang'):'';
        $lang=='ar'?session()->put('lang','ar'):session()->put('lang','en');
        return back();
    })->name('lang');
    Route::get('/home','LoginController@home')->name('home');
// employee Route Part That include Timemove Expenses employee data
    Route::resource('/employee','EmployeeController');

    Route::get("/attendanceAndLeave","AttendanceLeaveController@index")->name('all.AttendanceAndLeave');

    Route::get("/Add/time",'AttendanceLeaveController@create')->name("create.AttendanceLeave");

    Route::get("/edit/{id?}/attendance&leave",'AttendanceLeaveController@edit')->name("edit.AttendanceLeave");
    Route::post("/edit/{id}/attendance&leave",'AttendanceLeaveController@update')->name("update.AttendanceLeave");
    Route::Delete("/delete/attendance&leave/{id?}",'AttendanceLeaveController@destory')->name("destory.AttendanceLeave");

    Route::post("/Add/attendance",'AttendanceLeaveController@storeAttendance')->name("store.Attendance");
    Route::post("/Add/leave",'AttendanceLeaveController@storeLeave')->name("store.Leave");
    Route::post("/Add/absent",'AttendanceLeaveController@storeabsent')->name("store.absent");

    Route::resource('expense','ExpenseController');
//    Route::get('mony/expense','MonyExpenseController@index')->name('monyexpense');
//    Route::get('mony/expense/add','MonyExpenseController@create')->name('monyexpense.add');
//    Route::post('mony/expense/add','MonyExpenseController@store')->name('monyexpense.store');
//  _______________________________________________________________________________________
//Customers and his deals routes
    Route::resource('customers','CustomerController');
    Route::resource('customer-Deal','CustomerDealController');
    Route::resource('customer-Deal-order','DealOrderController');

// Report Route  Part_______________________________________________________________________
    Route::get('fullTime/report','FullTimeReportController@index')->name('fulltime.report.view');
    Route::get('fulltime/report/',function (){
        return redirect()->route('fulltime.report.view');
    });
    Route::post('fulltime/report/','FullTimeReportController@allTimeReport')->name('fulltime.report');
    Route::get('complete/employee/report','FullTimeReportController@completeReportView')->name('complete.emp.report');
    Route::post('complete/employee/report','FullTimeReportController@getCompleteReport')->name('complete.emp.report');

    Route::get('expenses/report','ExpenseReportController@index')->name('expenses.report');
    Route::post('expenses/report','ExpenseReportController@expenseReport')->name('expenses.report');
//End Report Route Part ______________________________________________________________________
//start Employee Productable Report

    Route::get('employee/productable/report','EmployeeProductableReportController@index')->name('emp_peoductableReport');
    Route::post('employee/productable/report','EmployeeProductableReportController@getReport')->name('emp_peoductableReport');

//Start Customer Paid Report
    Route::get('customer/payments/report','CustomerPaidReportController@index')->name('customer.payments.report');
    Route::post('customer/payments/report','CustomerPaidReportController@paidReport')->name('customer.payments.report');

// Start Customer Deal report
    Route::get('customer/deal/report','CustomerDealReportController@index')->name('customer.deal.report');
    Route::post('customer/deal/report','CustomerDealReportController@dealReport')->name('customer.deal.report');

//-------------------------------------------------------

// Supplier Route Part _______________________________________________________________________
    Route::resource('supplier','SupplierController');
// End Supplier Route________________________________________________________________

// Supplier Report Route Part _______________________________________________________________________
    Route::get('supplier/payments/report','SupplierReportController@index')->name('supplier.payments.report');
    Route::post('supplier/payments/report','SupplierReportController@show')->name('supplier.payments.report');
    Route::get('supplier/full/report','SupplierReportController@fullIndex')->name('supplier.full.report');
    Route::post('supplier/full/report','SupplierReportController@getFullReport')->name('supplier.full.report');
// End Supplier Route________________________________________________________________



// Start Supplier Bill Route___________________________________________________
    Route::resource('purchaseInvoice','PurchaseInvoiceController');
    //start customer bill route
    Route::resource('customersalebill','CustomerSalebillController');
// Start Store Route___________________________________________________________
    Route::resource('stock','StoreController');
//----------------------------------------------------

// Start Product and Category Route___________________________________________________________
    Route::resource('product','ProductController');

    Route::resource('productaddrequest','ProductAddRequestController');
//    Route::resource('category','CategoryController');

// Start Product order Route___________________________________________________________

    Route::resource('productorder','productordercontroller');

//    Route::get('order/product','ProductOrderController@index')->name('productOrder');
//    Route::post('order/product','ProductOrderController@create')->name('productOrder');
//    Route::get('order/show','ProductOrderController@show')->name('productOrder.show');
    Route::get('report/products','ProductReportController@productReportindex')->name('productreport');
    Route::post('report/products','ProductReportController@report')->name('productreport');


    //----------Start user Route--------------------------------
    Route::resource('users','userController');
//--------------------------------------------
//return Product
    Route::resource('return-product','ReturnBuyController');
//    Route::get('return/product','ReturnProductController@index')->name('returnproduct');
//    Route::get('return/product/create','ReturnProductController@create')->name('returnproduct.create');
//----------------------------------------------------
    //catchreceipt دفعات الموردين
    Route::resource('catchreceipt','catchReceiptController');
// customer paid
    Route::resource('customer-paid','CustomerPaidController');
//--------------------------------------------
//    موظفين الانتاج
    Route::resource('employeeproductable','EmployeeProductionController');
//----------------------------------------------------
    //receipt سند صرف
    Route::resource('receipt','receiptController');
//--------------------------------------------

//----------------------------------------------------
    // الخزنه
    Route::resource('Monymove','MonyMoveController');
    Route::resource('DailyExpense','DailyExpenseController');
    Route::get('Mony/daily/report','MonyReportController@index')->name('mony.report');
    Route::post('Mony/daily/report','MonyReportController@search')->name('mony.report');
    Route::get('Mony/report','MonyReportController@show')->name('monyreport');
    Route::post('Mony/report','MonyReportController@search_in_spacefictime')->name('monyreport');
    Route::post('Mony/end','MonyReportController@sendingAway')->name('endMony');
//--------------------------------------------
    // Logout _______________________________________________________
    Route::get('/logout','LoginController@logout')->name('logout');

});
