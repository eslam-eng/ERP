<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\CustomerDealHeader;
use App\DealOrderHeader;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function home()
    {
        $num_employees=DB::table('employees')->count();
        $num_suppliers=DB::table('suppliers')->count();
        $num_users=DB::table('users')->count();
        $num_purchaseInvoice=DB::table('purchase_invoices')->count();
        $num_customers=DB::table('customers')->count();
        $num_products=DB::table('products')->count();
//-------------------------Mony receive chart------------------------------------

        $mony = DB::table('mony_movements')->select(
            DB::raw('YEAR(date) as year'),
            DB::raw('MONTH(date) as month'),
            DB::raw('SUM(value) as total')
        )->groupBy('month')->get();


//--------------------Employee Borrow chart------------------------------------------
        $emp_borrow = DB::table('employee_moves')->select(
            DB::raw('YEAR(date) as year'),
            DB::raw('MONTH(date) as month'),
            DB::raw('SUM(borrow) as total')
        )->groupBy('month')->where('borrow','!=',null)->get();


        $variables = [
            'num_employees'             =>$num_employees,
            'num_suppliers'             =>$num_suppliers,
            'num_users'                 =>$num_users,
            'num_purchaseInvoice'       =>$num_purchaseInvoice,
            'num_customers'             =>$num_customers,
            'num_products'              =>$num_products,
//            'profit'                     =>$profit,
            'money'                     =>$mony,
            'emp_borrow'                 =>$emp_borrow,
//            'daily_expenses'            =>$daily_expenses,
        ];

        return view('dashbord.home.home',['variables'=>$variables]);

    }
    public function login(){
        if (auth()->attempt(['name'=>request('name'),'password'=>request('password')])){
            return redirect(route('home'));
        }

        return back()->with('faild','username Or password Wrong please try again!');

    }

    public function logout()
    {
        auth()->logout();
        return redirect(route('login'));
    }

}




