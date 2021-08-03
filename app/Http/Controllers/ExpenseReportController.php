<?php

namespace App\Http\Controllers;

use App\Employee;
use App\EmployeeMove;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class expenseReportController extends Controller
{
    public function index(){
        $employees = DB::table('employees')->get(['id','name']);
        return view('dashbord.employee.report.expense.expenseReport',['employees'=>$employees]);
    }

    public function expenseReport(Request $request)
    {
        $data = $this->validate($request,[
            'empId'=>'required',
            'fromdate'=>'required',
            'todate'=>'required'
        ]);
        if ($request->empId!=0){
            $employee = Employee::with(['employeeMove'=>function($query){
                global $request;
                $query->whereBetween('date',[$request->fromdate,$request->todate]);
            }])->find($request->empId);
            $sum_reward = $employee->employeeMove->sum('reward');
            $sum_borrow = $employee->employeeMove->sum('borrow');
            $sum_salary_deduct = $employee->employeeMove->sum('S_deduct');
            $sum_work_hour = $employee->employeeMove->sum('work_hour');
            $variabls = [
                'date'=>$data,
                'sum_reward'=>$sum_reward,
                'sum_borrow'=>$sum_borrow,
                'sum_salary_deduct'=>$sum_salary_deduct,
                'sum_work_hour'=>$sum_work_hour,
            ];
            return view('dashbord.employee.report.expense.employee_expense',['variabls'=>$variabls,'employee'=>$employee]);
        }else{

            $employees_time = EmployeeMove::whereBetween('date',[$request->fromdate,$request->todate])->orderBy('date','asc')->get();
            $employees_move = EmployeeMove::with('employee')->whereBetween('date',[$request->fromdate,$request->todate])->selectRaw('*, sum(reward) as sum_reward,sum(borrow) as sum_borrow,sum(S_deduct) as sum_S_deduct,sum(work_hour) as sum_work_hour')->groupBy('empId')->get();
            $sum_reward = $employees_time->sum('reward');
            $sum_borrow = $employees_time->sum('borrow');
            $sum_salary_deduct = $employees_time->sum('S_deduct');
            $sum_work_hour = $employees_time->sum('work_hour');
            $variabls = [
                'date'=>$data,
                'sum_reward'=>$sum_reward,
                'sum_borrow'=>$sum_borrow,
                'sum_salary_deduct'=>$sum_salary_deduct,
                'sum_work_hour'=>$sum_work_hour,
            ];
         return  view('dashbord.employee.report.expense.all_employee',['employees_time'=>$employees_time,'employees_move'=>$employees_move,'variabls'=>$variabls]);

        }

    }




//            $employees_time = Employee::with(['employeeMove'=>function($query){
//                global $request;
//                $query->whereBetween('date',[$request->fromdate,$request->todate])->orderBy('date','asc');
//            }])->get();
//            return $employees_time;
//            ['id','empId','attendanceTime','leaveTime','attnote','leavenote']





//    public function expenseReport(Request $request){
//
//        global $request;
//        $data = $this->validate($request,[
//            'empId'=>'required',
//            'fromdate'=>'required',
//            'todate'=>'required'
//        ]);
//        if ($request->empId==0){
//            $expenses = EmployeeMove::with('employee')->where('borrow','!=',null)->orWhere('reward','!=',null)->orWhere('extraTime','!=',null)->orWhere('S_deduct','!=',null)->whereBetween('date',[$data['fromdate'],$data['todate']])->get();
//            $sum_reward = $expenses->sum('reward');
//            $sum_borrow = $expenses->sum('borrow');
//            $sum_extratime = $expenses->sum('extraTime');
//            $sum_salary_deduct = $expenses->sum('S_deduct');
//            $variabls = [
//                'expenses'=>$expenses,
//                'date'=>$data,
//                'sum_reward'=>$sum_reward,
//                'sum_borrow'=>$sum_borrow,
//                'sum_salary_deduct'=>$sum_salary_deduct,
//                'sum_extra_time'=>$sum_extratime,
//            ];
//            return  view('dashbord.employee.report.expense.all_employee',['variabls'=>$variabls]);
////            return (['status'=>true,'result'=>$html]);
//        }else {
//
//            $employee = DB::table('employees')->where('id',$data['empId'])->first();
//            $expenses = EmployeeMove::where('borrow','!=',null)->orWhere('reward','!=',null)->orWhere('extraTime','!=',null)->orWhere('S_deduct','!=',null)->where('empId',$data['empId'])->whereBetween('date',[$data['fromdate'],$data['todate']])->get();
//            $sum_reward = $expenses->sum('reward');
//            $sum_borrow = $expenses->sum('borrow');
//            $sum_extratime = $expenses->sum('extraTime');
//            $sum_salary_deduct = $expenses->sum('S_deduct');
//
//            $variabls = [
//                'date'=>$data,
//                'employee'=>$employee,
//                'expenses'=>$expenses,
//                'sum_reward'=>$sum_reward,
//                'sum_borrow'=>$sum_borrow,
//                'sum_salary_deduct'=>$sum_salary_deduct,
//                'sum_extra_time'=>$sum_extratime,
//            ];
////            ['expenses'=>$expenses,'date'=>$data,'employee'=>$employee]
//            return view('dashbord.employee.report.expense.employee_expense',['variabls'=>$variabls]);
//
////           return view('dashbord.employee.report.expense.empExpenseTable',['expenses'=>$expenses])->render();
////            return response(['status'=>true,'result'=>$html]);
//        }
//
////        return $expeses;
//
////            return (['status'=>true,'result'=>$expenses]);
////            $expeses = Employee::with(['expense'=>function($query){
////                global $request;
////                $query->whereBetween('date',[$request->fromdate,$request->todate]);
////
////            }])->find($data['empId']);
////            $sum_reward =$expeses->expense->sum('reward');
////            $sum_borrow =$expeses->expense->sum('borrow');
////            $sum_salary_deduct =$expeses->expense->sum('S_deduct');
////            $sum_extr_time =$expeses->expense->sum('extraTime');
//
//
//    }

}
