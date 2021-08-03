<?php

namespace App\Http\Controllers;

use App\CatchReceipt;
use App\PurchaseInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierReportController extends Controller
{
    public function index(){
        $suppliers =DB::table('suppliers')->get(['id','name']);
        return view('dashbord.supplier.report.index',['suppliers'=>$suppliers]);
    }

    public function show(Request $request){
        $data = $this->validate($request,[
            'supplierId'=>'required|integer',
            'fromdate'=>'required',
            'todate'=>'required'
        ]);
        if ($data['supplierId']==0){
            $suppliers_paid= CatchReceipt::whereBetween('date',[$data['fromdate'],$data['todate']])->get();
            $sum_paid= $suppliers_paid->sum('value');
            $sum_balance = DB::table('suppliers')->whereBetween('date',[$data['fromdate'],$data['todate']])->get()->sum('balance');
            $variabls = [
                'data'=>$data,
                'suppliers_paid'=>$suppliers_paid,
                'sum_paid'=>$sum_paid,
                'sum_balance'=>$sum_balance
            ];
            return view('dashbord.supplier.report.report',compact('variabls'));
        }else{
            $supplier = DB::table('suppliers')->find($data['supplierId']);
            $suppliers_paid= CatchReceipt::where('name',$data['supplierId'])->whereBetween('date',[$data['fromdate'],$data['todate']])->get();
            $sum_paid= $suppliers_paid->sum('value');
            $variabls = [
                'data'=>$data,
                'supplier'=>$supplier,
                'suppliers_paid'=>$suppliers_paid,
                'sum_paid'=>$sum_paid,
            ];
            return view('dashbord.supplier.report.report',compact('variabls'));

        }
    }
    public function fullIndex(){
        $suppliers = DB::table('suppliers')->get(['id','name']);
        return view('dashbord.supplier.report.full_report_index',compact('suppliers'));
    }

    public function getFullReport(Request $request)
    {

        $data = $this->validate($request,[
            'supplierId'=>'required',
            'fromdate'=>'required',
            'todate'=>'required',
        ]);
        if ($request->paytype!=0) {
            $purchases = PurchaseInvoice::with('employee')->with('supplier')->where('supplier_id', $data['supplierId'])->where('paytype', 0)->whereBetween('date', [$data['fromdate'], $data['todate']])->get();
            $sum_purchase = $purchases->sum('finaltotal');
            $variabls = [
                'purchases' => $purchases,
                'date' => $data,
                'sum_purchase' => $sum_purchase,
            ];
            return view('dashbord.supplier.report.cachparchase_report', compact('variabls'));
        }else{
            $catch_receipts = CatchReceipt::where('name', $data['supplierId'])->whereBetween('date', [$data['fromdate'], $data['todate']])->get();
            $purchases = PurchaseInvoice::with('employee')->where('supplier_id', $data['supplierId'])->where('paytype', -1)->orWhere('paytype', 1)->whereBetween('date', [$data['fromdate'], $data['todate']])->get();
            $supplier = DB::table('suppliers')->where('id', $data['supplierId'])->first();
            $sum_paid = $catch_receipts->sum('value');
            $sum_purchase = $purchases->sum('finaltotal');
            $variabls = [
                'catch_receipts' => $catch_receipts,
                'purchases' => $purchases,
                'supplier' => $supplier,
                'date' => $data,
                'sum_paid' => $sum_paid,
                'sum_purchase' => $sum_purchase,
            ];
            return view('dashbord.supplier.report.full_report', compact('variabls'));

        }
    }
}
