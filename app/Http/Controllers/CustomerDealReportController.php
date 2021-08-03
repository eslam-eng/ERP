<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerDealHeader;
use App\DealOrderHeader;
use Illuminate\Http\Request;

class CustomerDealReportController extends Controller
{
    public function index()
    {
        $customers = Customer::all(['id','name']);
        $deals = CustomerDealHeader::orderBy('date','asc')->get(['id','customer_id','descdeal','date']);

        return view('dashbord.customers.customer_deal.report.index',['customers'=>$customers,'deals'=>$deals]);

    }

    public function dealReport(Request $request)
    {
        $data=$this->validate($request,[
           'deal'   =>'required',
           'fromdate'   =>'required',
           'todate'   =>'required'
        ]);

        if ($data['deal']==0)
        {
            $deal_order = DealOrderHeader::whereBetween('date',[$data['fromdate'],$data['todate']])->get();

            return $deal_order;
        }


    }
}
