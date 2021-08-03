<?php

namespace App\Http\Controllers;

use App\Employee;
use App\EmployeeMove;
use App\Expense;
use App\MangeTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class fullTimeReportController extends Controller
{
    public function index(){
        $employees = Employee::all('id','name');
        return view('dashbord.employee.report.att_leave.index',['employees'=>$employees]);
    }

    public function allTimeReport(Request $request){

//        global $request;
        $data = $this->validate($request,[
            'empId'=>'required',
            'fromdate'=>'required',
            'todate'=>'required'
        ]);
        if ($request->empId==0){
            $periods = EmployeeMove::with('employee')->whereBetween('date',[$data['fromdate'],$data['todate']])->get();
            $variabls = [
                'periods'=>$periods,
                'date'=>$data
            ];

        }else {
            $periods = EmployeeMove::with('employee')->where('empId',$data['empId'])->whereBetween('date',[$data['fromdate'],$data['todate']])->get();

//            $periods = Employee::with(['employeeTime'=>function($query){
//                global $request;
//                $query->whereBetween('date',[$request->fromdate,$request->todate]);
//
//            }])->find($data['empId']);

            $variabls = [
                'date'=>$data,
                'periods'=>$periods
            ];
//            $html = view('dashbord.employee.report.att_leave.oneemployee',['variabls'=>$variabls])->render();
//            return response(['status'=>true,'result'=>$html]);
        }
        return view('dashbord.employee.report.att_leave.time_report',['variabls'=>$variabls]);
//        $html = view('dashbord.employee.report.att_leave.report',['variabls'=>$variabls])->render();
//        return (['status'=>true,'result'=>$html]);

    }


    public function completeReportView()
    {
        $employees = Employee::all(['id','name']);
        return view('dashbord.employee.report.complete_report.index',['employees'=>$employees]);
    }

    public function getCompleteReport(Request $request)
    {
        $data = $this->validate($request,[
            'empId'=>'required',
            'fromdate'=>'required',
            'todate'=>'required',
        ]);

        if ($data['empId']==0) {
            $result = EmployeeMove::with('employee')->whereBetween('date',[$data['fromdate'],$data['todate']])->get();
            $variabls = [
                'date' => $data,
                'result' => $result
            ];
        }else{
            $result = EmployeeMove::with('employee')->where('empId',$data['empId'])->whereBetween('date',[$data['fromdate'],$data['todate']])->get();
            $variabls = [
                'date' => $data,
                'result' => $result
            ];
        }
        return view('dashbord.employee.report.complete_report.report', ['variabls' => $variabls]);
    }

}
