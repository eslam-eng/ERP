<?php

namespace App\Http\Controllers;

use App\CatchReceipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class catchReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catchReceipts=CatchReceipt::all();
        return view('dashbord.catch_receipt.index',compact('catchReceipts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $employees = DB::table('employees')->get(['id','name']);
        $suppliers = DB::table('suppliers')->get(['id','name']);
        return view('dashbord.catch_receipt.add',compact('suppliers'));

    }

    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'date'=>'required',
            'name'=>'required|integer',
            'receiver'=>'string|nullable',
            'value'=>'required|numeric',
            'note'=>'string|nullable'
        ]);
        $supplier = DB::table('suppliers')->where('id',$data['name'])->first();
        if (CatchReceipt::create($data)){
            DB::table('suppliers')->where('id',$data['name'])->update([
                'balance' => $supplier->balance-$data['value']
            ]);
            return redirect(route('catchreceipt.index'))->with('done',trans('trans.done'));
        }
//        }
        return redirect(route('catchreceipt.edit'))->with('fail',trans('trans.fail'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $suppliers = DB::table('suppliers')->get(['id','name']);
        $catchReceipt = CatchReceipt::find($id);
        return view('dashbord.catch_receipt.edit',compact('catchReceipt','suppliers'));

    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request,[
            'date'=>'required',
            'name'=>'required|integer',
            'receiver'=>'required|string',
            'value'=>'required|numeric',
            'note'=>'string|nullable'
        ]);
        $receipt = CatchReceipt::find($id);
        $supplier = DB::table('suppliers')->where('id',$data['name'])->first();
        if (CatchReceipt::create($data)){
            DB::table('suppliers')->where('id',$data['name'])->update([
                'balance' => $supplier->balance-$receipt->value+$data['value']
            ]);
            return redirect(route('catchreceipt.edit'))->with('done',trans('trans.done'));
        }
//        }
        return redirect(route('catchreceipt.edit'))->with('fail',trans('trans.fail'));
    }

    public function destroy($id)
    {
        $msg = trans('trans.done');
        $catchreceipt = CatchReceipt::find($id);
            $supplier = DB::table('suppliers')->find($catchreceipt->name);
            if ($catchreceipt->delete())
                DB::table('suppliers')->where('id',$catchreceipt->name)->update([
                    'balance'=>$catchreceipt->value+$supplier->balance
                ]);
            return $msg;

        }
//    }
}
