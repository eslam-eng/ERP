<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerDealHeader;
use App\CustomerPaid;
use Illuminate\Http\Request;
class CustomerPaidReportController extends Controller
{
    public function index(){

        $deals =Customer::with('customerDeal')->get()->all();
        return view('dashbord.customerpaid.report.index',compact('deals'));
    }


    public function paidReport(Request $request)
    {
        $data = $this->validate($request,[
            'customer'=>'required|integer',
            'deal_id'=>'required|integer',
            'fromdate'=>'required',
            'todate'=>'required',
        ]);
        $customer = Customer::find($data['customer']);
        if ($data['customer']==0)
        {
            $customers_paid = CustomerPaid::with('customer')->whereBetween('date',[$request->fromdate,$request->todate])->selectRaw('*, sum(value) as sum_paid')->groupBy('customer_id')->get();
            return view('dashbord.customerpaid.report.customer_report',['customers_paid'=>$customers_paid,'data'=>$data]);
        }else{
            if ($data['deal_id']==0)
            {
                $customer_paid = CustomerPaid::with('deal')->where('customer_id',$data['customer'])->orderBy('date','asc')->get();
                $deals = CustomerDealHeader::where('customer_id',$data['customer'])->get();

            }else
            {
                $customer_paid = CustomerPaid::with('deal')->where('customer_id',$data['customer'])->where('deal_id',$data['deal_id'])->orderBy('date','asc')->get();
                $deals = CustomerDealHeader::where('id',$data['deal_id'])->get();

            }
            $sum_paid = $customer_paid->sum('value');
            $sum_deals = $deals->sum('dealtotal');
            return view('dashbord.customerpaid.report.customer_report',['customer_paid'=>$customer_paid,'sum_deals'=>$sum_deals,'sum_paid'=>$sum_paid,'customer'=>$customer,'deals'=>$deals,'data'=>$data]);
        }

    }
}
