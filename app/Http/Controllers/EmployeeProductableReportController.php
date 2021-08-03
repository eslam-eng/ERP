<?php

namespace App\Http\Controllers;

use App\EmployeeProductableHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeProductableReportController extends Controller
{
    public function index()
    {
        $employees = DB::table('employees')->get(['id','name']);
        return view('dashbord.employee.specialemployee.report.index',['employees'=>$employees]);
    }

    public function getReport(Request $request)
    {
        $data = $this->validate($request,[
            'empId'=>'required',
            'fromdate'=>'required',
            'todate'=>'required',
        ]);
        if ($data['empId']==0)
        {
            $productabls = EmployeeProductableHeader::with('employee')->whereBetween('date',[$data['fromdate'],$data['todate']])->get();
            $sum = $productabls->sum('finaltotal');
            $variabls = [
                'date'=>$data,
                'productabls'=>$productabls,
                'finaltotal'=>$sum
            ];
            return view('dashbord.employee.specialemployee.report.allemployee_report',['variabls'=>$variabls]);
        }else
        {
            $employee = DB::table('employees')->where('id',$data['empId'])->first();
            $productabls = EmployeeProductableHeader::with('productableDetails')->where('empId',$data['empId'])->whereBetween('date',[$data['fromdate'],$data['todate']])->get();
            $sum = $productabls->sum('finaltotal');
            $variabls = [
                'date'=>$data,
                'employee'=>$employee,
                'productabls'=>$productabls,
                'finaltotal'=>$sum
            ];

            return view('dashbord.employee.specialemployee.report.report',['variabls'=>$variabls]);
        }
    }

}
