<?php

namespace App\Http\Controllers;

use App\sallcustomerbill;
use App\sallcustomerbill_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerSalebillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salecustomerbills =sallcustomerbill::with('customers')->get();
        return view('dashbord.sellpurchase.index',compact('salecustomerbills'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers =DB::table('customers')->get(['id','name']);
        return view('dashbord.sellpurchase.add',['customers'=>$customers]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        if ($request->ajax()){
            $this->validate($request,[
                'customer_id'=>'required|integer',
                'date'=>'required',
                'discount'=>'numeric|nullable',
                'tax'=>'numeric|nullable',
                'total'=>'required|numeric',
                'finaltotal'=>'required|numeric',
                'product.*' => 'required|',
                'qty.*'=>'required|numeric',
                'unitprice.*'=>'required',
                'subtotal'=>'required',
                'note[]'=>'string|max:155|nullable',
            ]);
            $header_bill =[
                'customer_id' =>$request->customer_id,
                'date' =>$request->date,
                'discount' =>$request->discount,
                'tax' =>$request->tax,
                'total' =>$request->total,
                'finaltotal' =>$request->finaltotal,
            ];
            $billNum = sallcustomerbill::create($header_bill)->id;
            if($billNum){
                  foreach ($request->product as $key=>$value){
                    $bill_details=[
                        'billnum'=>$billNum,
                        'product'=>$value,
                        'qty'=>$request->qty[$key],
                        'unitprice'=>$request->unitprice[$key],
                        'subtotal'=>$request->subtotal[$key],
                        'note'=>$request->note[$key],
                    ];
                    sallcustomerbill_details::create($bill_details);
                }
                return redirect(route('customersalebill.index'))->with('done',trans("trans.done"));
            }
//        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $saleInvoive = sallcustomerbill::with('saleInvoiceDetail')->with('customers')->where('id',$id)->first();
        return view('dashbord.sellpurchase.show',['saleinvoice'=>$saleInvoive]);

    }
    public function edit($id)
    {
        $customerbill = sallcustomerbill::with('saleInvoiceDetail')->with('customers')->where('id',$id)->first();
        return view('dashbord.sellpurchase.edit',['customerbill'=>$customerbill]);
    }


    public function update(Request $request, $id)
    {
        $customerbill = sallcustomerbill::find($id);

        $header_bill =$this->validate($request, [
            'customer_id'=>'required|integer',
            'date'=>'required',
            'discount'=>'numeric|nullable',
            'tax'=>'numeric|nullable',
            'total'=>'required|numeric',
            'finaltotal'=>'required|numeric',
        ]);

        $bill_details = $this->validate($request,[
            'product'=>'required',
            'qty'=>'required',
            'unitprice'=>'required',
            'subtotal'=>'required',
            'note[]'=>'string|max:155|nullable',
        ]);
        if($customerbill->update($header_bill)){
            sallcustomerbill_details::where('billnum',$id)->delete();
            foreach ($request->product as $key=>$value){
                $bill_details=[
                    'billnum'=>$id,
                    'product'=>$value,
                    'qty'=>$request->qty[$key],
                    'unitprice'=>$request->unitprice[$key],
                    'subtotal'=>$request->subtotal[$key],
                    'note'=>$request->note[$key],
                ];
                sallcustomerbill_details::create($bill_details);
            }
            return redirect(route('customersalebill.index'))->with('done',trans('trans.done'));
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        sallcustomerbill::where('id',$id)->delete();
        return response(['data'=>trans('trans.done')]);
    }
}
