<?php

namespace App\Http\Controllers;

use App\EmployeeProductableDetails;
use App\EmployeeProductableHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emp_productable =EmployeeProductableHeader::with('employee')->get();
        return view('dashbord.employee.specialemployee.index',compact('emp_productable'));
    }

    public function create()
    {
        $employees = DB::table('employees')->get(['id','name']);
        return view('dashbord.employee.specialemployee.add',compact('employees'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'empId'=>'required|integer',
            'finaltotal'=>'required|numeric',
            'desc_work'=>'required',
            'product.*' => 'required|string',
            'qty.*'=>'required|numeric',
            'unitprice'=>'required',
            'subtotal'=>'required',
            'note.*'=>'string|nullable',
        ]);

        $header_bill =[
            'empId' =>$request->empId,
            'desc_work' =>$request->desc_work,
            'finaltotal' =>$request->finaltotal,
        ];
        $billNum = EmployeeProductableHeader::create($header_bill)->id;
        if($billNum){
            $employee = DB::table('employees')->find($header_bill['empId']);
                DB::table('employees')->where('id',$header_bill['empId'])->update(['balance'=>$employee->balance+$header_bill['finaltotal']]);
              foreach ($request->product as $key=>$value){
                $bill_details=[
                    'billnum'=>$billNum,
                    'product'=>$value,
                    'qty'=>$request->qty[$key],
                    'unitprice'=>$request->unitprice[$key],
                    'subtotal'=>$request->subtotal[$key],
                    'note'=>$request->note[$key],
                ];
                EmployeeProductableDetails::create($bill_details);
            }
            return redirect(route('employeeproductable.index'))->with('done',trans('trans.done'));
        }
    }

    public function show($id)
    {

        $details = EmployeeProductableHeader::with('productableDetails')->with('employee')->where('id',$id)->first();
        return view('dashbord.employee.specialemployee.show',['details'=>$details]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $details = EmployeeProductableHeader::with('productableDetails')->where('id',$id)->first();
        $employees = DB::table('employees')->get(['id','name']);
        return  view('dashbord.employee.specialemployee.edit',['details'=>$details,'employees'=>$employees]);

    }

    public function update(Request $request, $id)
    {
        $productable_bill = EmployeeProductableHeader::find($id);
        $employee =DB::table('employees')->find($productable_bill->empId);

        $request->validate([
            'empId'=>'required|integer',
            'finaltotal'=>'required|numeric',
            'desc_work'=>'required',
            'product.*' => 'required|string',
            'qty'=>'required|numeric',
            'unitprice'=>'required',
            'subtotal'=>'required',
            'note.*'=>'string|nullable',
        ]);

        $header_bill =[
            'empId' =>$request->empId,
            'desc_work' =>$request->desc_work,
            'finaltotal' =>$request->finaltotal,
        ];

         $old_balance = $employee->balance - $productable_bill->finaltotal;
         DB::table('employees')->where('id',$employee->id)->update(['balance'=>$old_balance]);
        if($productable_bill->update($header_bill)){
            $new_employee = DB::table('employees')->find($header_bill['empId']);
            DB::table('employees')->where('id',$header_bill['empId'])->update([
                'balance'=>$new_employee->balance+$header_bill['finaltotal']
            ]);
            EmployeeProductableDetails::where('billnum',$id)->delete();
            foreach ($request->product as $key=>$value){
                $bill_details=[
                    'billnum'=>$id,
                    'product'=>$value,
                    'qty'=>$request->qty[$key],
                    'unitprice'=>$request->unitprice[$key],
                    'subtotal'=>$request->subtotal[$key],
                    'note'=>$request->note[$key],
                ];
                EmployeeProductableDetails::create($bill_details);
            }
            return redirect(route('employeeproductable.index'))->with('done',trans('trans.done'));
        }

    }

    public function destroy($id)
    {
        $production_work = EmployeeProductableHeader::find($id);
        $employee = DB::table('employees')->where('id',$production_work->empId)->first();
        $msg = trans('trans.done');
        if($production_work->delete()){
            DB::table('employees')->where('id',$production_work->empId)->update([
                'balance'=>$employee->balance-$production_work->finaltotal
            ]);
            return response(['status'=>$msg]);
        }
    }
}
