<?php

namespace App\Http\Controllers;

use App\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receipts = Receipt::all();
        return view('dashbord.receipt.index',compact('receipts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = DB::table('employees')->get(['id','name']);
        $suppliers = DB::table('suppliers')->get(['id','name']);
        return view('dashbord.receipt.add',compact('employees','suppliers'));
    }

    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'date'=>'required',
            'type'=>'required|integer',
            'name'=>'required|integer',
            'value'=>'required',
            'note'=>'string|nullable'
        ]);
        if ($data['type']==1){
            $employee = DB::table('employees')->where('id',$data['name'])->first();
            if (Receipt::create($data)){
              DB::table('employees')->where('id',$data['name'])->update([
                  'balance' => $employee->balance+$data['value']
              ]);
                return back()->with('done','Receipt added successfully');
            }
        }else{
            $supplier = DB::table('suppliers')->where('id',$data['name'])->first();
            if (Receipt::create($data)){
                DB::table('suppliers')->where('id',$data['name'])->update([
                    'balance' => $supplier->balance+$data['value']
                ]);
                return back()->with('done','Receipt added successfully');
            }
        }
        return back()->with('fail','something Wrong Try again!');


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employees = DB::table('employees')->get(['id','name']);
        $suppliers = DB::table('suppliers')->get(['id','name']);
        $receipt = Receipt::find($id);
        return view('dashbord.receipt.edit',compact('receipt','employees','suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate($request,[
            'date'=>'required',
            'type'=>'required|integer',
            'name'=>'required|integer',
            'value'=>'required',
            'note'=>'string|nullable'
        ]);
        $receipt = Receipt::find($id);
        if ($data['type']==1){
            $employee = DB::table('employees')->where('id',$data['name'])->first();
            if (Receipt::create($data)){
                DB::table('employees')->where('id',$data['name'])->update([
                    'balance' => $employee->balance-$receipt->value+$data['value']
                ]);
                return back()->with('done','Receipt Updated successfully');
            }
        }else{
            $supplier = DB::table('suppliers')->where('id',$data['name'])->first();
            if (Receipt::create($data)){
                DB::table('suppliers')->where('id',$data['name'])->update([
                    'balance' => $supplier->balance-$receipt->value+$data['value']
                ]);
                return back()->with('done','Receipt Updated successfully');
            }
        }
        return back()->with('fail','something Wrong Try again!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $msg = "Deleted Successfully! ";
        $catchreceipt = CatchReceipt::find($id);
        if ($catchreceipt->type == 1) {
            $employee = DB::table('employees')->find($catchreceipt->name);
            if ($catchreceipt->delete())
                DB::table('employees')->where('id', $catchreceipt->name)->update([
                    'balance' =>$employee->balance-$catchreceipt->value
                ]);
            return $msg;

        } else {
            $supplier = DB::table('suppliers')->find($catchreceipt->name);
            if ($catchreceipt->delete())
                DB::table('suppliers')->where('id', $catchreceipt->name)->update([
                    'balance' =>  $supplier->balance-$catchreceipt->value
                ]);
            return $msg;

        }
    }
}
