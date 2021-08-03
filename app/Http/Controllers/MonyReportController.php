<?php

namespace App\Http\Controllers;

use App\CatchReceipt;
use App\EmployeeMove;
use App\PurchaseInvoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonyReportController extends Controller
{
    public function index()
    {
        return view('dashbord.mony.report.index');
    }


    public function search(Request $request)
    {
        $data = $this->validate($request,['date'=>'required']);
        $emp_expense = EmployeeMove::where('date',$data['date'])->get()->sum('borrow');
        $daily_expenses = DB::table('daily_expenses')->where('date','LIKE',$data['date'].'%')->get();
        $sum_daily_expenses = $daily_expenses->sum('value');
        $suppliers_paid = CatchReceipt::where('date',$data['date'])->get();
        $sum_suppliers_paid = $suppliers_paid->sum('value');
        $purchase_invoices = PurchaseInvoice::with('Supplier')->where('paytype','=',0)->orwhere('paytype','=',1)->where('date',$data['date'])->get();
        $sum_purchase_values = $purchase_invoices->sum('finaltotal');
        $mony = DB::table('mony_movements')->where('date','LIKE',$data['date'].'%')->get();
        $sum_mony =$mony->sum('value');
        $variabls = [
            'date'=>$data['date'],
            'sum_borrows'=>$emp_expense,
            'dalily_expense'=>$daily_expenses,
            'sum_dalily_expense'=>$sum_daily_expenses,
            'mony'=>$mony,
            'sum_mony'=>$sum_mony,
            'suppliers_paid'=>$suppliers_paid,
            'sum_suppliers_paid'=>$sum_suppliers_paid,
            'purchase_invoices'=>$purchase_invoices,
            'sum_purchase_values'=>$sum_purchase_values
        ];
//        dd($variabls);
        return view('dashbord.mony.report.daily_report',['variabls'=>$variabls]);
    }

    public function show(){
        return view('dashbord.mony.report.mony_report');
    }


//    public function search_in_spacefictime(Request $request){
//
//
//        $data = $this->validate($request,[
//            'fromdate'=>'required',
//            'todate'=>'required'
//        ]);
//        $emp_expense = EmployeeMove::whereBetween('date',[$data['fromdate'],$data['todate']])->get()->sum('borrow');
//        $daily_expenses = DB::table('daily_expenses')->whereBetween('date',[$data['fromdate'],$data['todate']])->get()->sum('value');
//        $suppliers_paid = DB::table('catch_receipts')->whereBetween('date',[$data['fromdate'],$data['todate']])->get()->sum('value');
//        $purchase_invoices = DB::table('purchase_invoices')->where('paytype','=',0)->orwhere('paytype','=',1)->whereBetween('date',[$data['fromdate'],$data['todate']])->get()->sum('finaltotal');
//        $mony = DB::table('mony_movements')->whereBetween('date',[$data['fromdate'],$data['todate']])->get()->sum('value');
//
//
//        $variables = [
//            'sum_borrows'=>$emp_expense,
//            'sum_daily_expenses'=>$daily_expenses,
//            'sum_supplier_paid'=>$suppliers_paid,
//            'sum_purchase_invoices'=>$purchase_invoices,
//            'sum_mony'=>$mony,
//        ];
//        return $variables;
//    }

    public function sendingAway(Request $request)
    {
        $date=Carbon::now('Africa/Cairo')->format('y-m-d');
//        return response(['msg' => $date, 'icon' => 'success']);
        if ($request->ajax()){
            $password = $request->password;
            $sendingmonydate = $request->date;

            if (auth()->attempt(['name'=>auth()->user()->name,'password'=>$password])) {
               $emp_expense = DB::table('employee_moves')->where('date',$date)->sum('borrow');
               $daily_expense = DB::table('daily_expenses')->where('date',$date)->sum('value');
                $suppliers_paid = DB::table('catch_receipts')->where('date',$date)->get()->sum('value');
                $purchase_invoices = DB::table('purchase_invoices')->where('paytype','=',0)->orWhere('paytype','=',1)->where('date',$date)->sum('finaltotal');
                $total_mony = DB::table('mony_movements')->where('date',$date)->get()->sum('value');
                $remain = $total_mony-($emp_expense+$daily_expense+$suppliers_paid+$purchase_invoices);
                if ($remain!=0){
                    DB::table('mony_movements')->insert([
                        'from'=>trans('trans.sending_away')." ".$date,
                        'to'=>auth()->user()->name,
                        'value'=>$remain,
                        'date'=>$sendingmonydate,
                        'note'=>'عهده مرحله'
                    ]);
                    return response(['msg'=>trans('trans.sending_away_ok'),'icon'=>'success']);
//                    $check =  DB::table('mony_movements')->where('from',"=",$date.'تم ترحيلها من يوم ')->where('date','=',$sendingmonydate)->count();
//                    if ($check) {
//                        DB::table('mony_movements')->where('date',$sendingmonydate)->update([
//                            'from' => $date . 'تم ترحيلها من يوم ',
//                            'to' => auth()->user()->name,
//                            'value' => $remain,
//                            'date' => $sendingmonydate,
//                            'note' => 'عهده مرحله'
//                        ]);
//                        return response(['msg' => 'تم التعديل و ترحيل العهده بنجاح!', 'icon' => 'success']);
//                    }
//                    else{
//                        DB::table('mony_movements')->insert([
//                            'from'=>$date.'تم ترحيلها من يوم ',
//                            'to'=>auth()->user()->name,
//                            'value'=>$remain,
//                            'date'=>$sendingmonydate,
//                            'note'=>'عهده مرحله'
//                        ]);
//                        return response(['msg'=>'تم ترحيل العهده بنجاح','icon'=>'success']);
//                    }
                }
                else
                    return response(['msg'=>'لا يمكن ترحيل العهده او لا يوجد مال لترحيله','icon'=>'error']);
            }
            else
                return response(['msg'=>trans('trans.pass_wrong'),'icon'=>'error']);
        }
    }
}
