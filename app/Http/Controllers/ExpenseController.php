<?php

namespace App\Http\Controllers;

use App\Employee;
use App\EmployeeMove;
use App\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{

    public function index()
    {
        $expenses = EmployeeMove::with('employee')->where('borrow','!=',null)->orWhere('reward','!=',null)->orWhere('S_deduct','!=',null)->get();
        return view('dashbord.employee.expense.index',['expenses'=>$expenses]);
    }

    public function create()
    {
        $employees = Employee::all('id','name');
        return view('dashbord.employee.expense.add',['employees'=>$employees]);
    }

    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'empId'=>'required',
            'borrow' => 'required_without_all:reward,extraTime,S_deduct|integer|nullable',
            'reward' => 'required_without_all:borrow,extraTime,S_deduct|integer|nullable',
            'S_deduct' => 'required_without_all:reward,extraTime,borrow|integer|nullable',
            'note'=>'string|max:255|nullable'
        ]);
        $employee = Employee::where('id',$data['empId'])->first();
        $check =EmployeeMove::where('empId',$data['empId'])->where('date',date('Y-m-d'))->count();
        $oldexpense =EmployeeMove::where('empId',$data['empId'])->where('date',date("Y-m-d"))->first();
        if (!$check){
            $data['date'] = date('Y-m-d');
            EmployeeMove::create($data);
//            $blance = (($data['extraTime']*$employee->S_perHour)+$data['reward'])-($data['borrow']+$data['S_deduct']);
//            $employee->update(['balance'=>$employee->balance+$blance]);
//            return redirect(route('expense.index'))->with('done',trans('trans.done'));

        }else{
            $note =$oldexpense->note==''?'':$oldexpense->note.' / ';
            EmployeeMove::where('empId',$data['empId'])->where('date',date('Y-m-d'))->update([
                   'borrow'     =>$oldexpense->borrow+$data['borrow'],
                   'reward'     =>$oldexpense->reward+$data['reward'],
                   'S_deduct'   =>$oldexpense->S_deduct +$data['S_deduct'],
                   'note'        =>$note.$data['note']
               ]);
//            $blance = (($data['extraTime']*$employee->S_perHour)+$data['reward'])-($data['borrow']+$data['S_deduct']);
//            $employee->update(['balance'=>$employee->balance+$blance]);
//            return redirect(route('expense.index'))->with('done',trans('trans.done'));
        }
        $blance = ($data['reward'])-($data['borrow']+$data['S_deduct']);
        $employee->update(['balance'=>$employee->balance+$blance]);
        return redirect(route('expense.index'))->with('done',trans('trans.done'));


    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $expense = EmployeeMove::where('id',$id)->first();
        return view('dashbord.employee.expense.edit',['expense'=>$expense]);
    }

    public function update(Request $request, $id)
    {
        $expense = EmployeeMove::find($id);
        $data = $this->validate($request,[
            'empId'=>'required',
            'borrow' => 'required_without_all:reward,extraTime,S_deduct|integer|nullable',
            'reward' => 'required_without_all:borrow,extraTime,S_deduct|integer|nullable',
            'S_deduct' => 'required_without_all:reward,extraTime,borrow|integer|nullable',
            'note'=>'string|max:255|nullable'

        ]);
            $employee = Employee::where('id',$data['empId'])->first();
            $oldexpense = ($expense->reward)-($expense->borrow+$expense->S_deduct);
            if ($expense->update($data)){
                $newexpense = ($data['reward'])-($data['borrow']+$data['S_deduct']);
                $finalexpense = $employee->balance-$oldexpense+$newexpense;
                $employee->update(['balance'=>$finalexpense]);
            }
            return redirect()->route('expense.index')->with('done',trans('trans.done'));

//        }


    }

    public function destroy($id)
    {
        $expense = EmployeeMove::find($id);
        $msg = trans('trans.done');
        $employee = Employee::find($expense->empId);
        $blance = (($expense->extraTime*$employee->S_perHour)+$expense->reward)-($expense->borrow+$expense->S_deduct);
        if($expense->delete()){
            $employee->update(['balance'=>$employee->balance-$blance]);
            return response(['status'=>$msg]);
        }
    }
}
