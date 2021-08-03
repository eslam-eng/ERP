<?php

namespace App\Http\Controllers;

use App\PurchaseInvoice;
use App\PurchaseInvoiceDetail;
//use App\ReturnBuy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchase_invoices =PurchaseInvoice::with('supplier')->with('employee')->get();
        return view('dashbord.purchase-invoice.index',compact('purchase_invoices'));

    }

    public function create()
    {
        $suppliers =DB::table('suppliers')->get(['id','name']);
        $employees = DB::table('employees')->get(['id','name']);
        return view('dashbord.purchase-invoice.add',['suppliers'=>$suppliers,'employees'=>$employees]);


    }


    public function store(Request $request)
    {

       if ($request->ajax()){
           $this->validate($request,[
               'supplier_id'=>'required|integer',
               'receiver'=>'required|integer',
               'paytype'=>'required|integer',
               'payvalue'=>'integer|nullable',
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
               'supplier_id' =>$request->supplier_id,
               'receiver' =>$request->receiver,
               'paytype' =>$request->paytype,
               'payvalue' =>$request->payvalue,
               'discount' =>$request->discount,
               'tax' =>$request->tax,
               'total' =>$request->total,
               'finaltotal' =>$request->finaltotal,
           ];
           $billNum = PurchaseInvoice::create($header_bill)->id;
           if($billNum){
               $supplier = DB::table('suppliers')->find($header_bill['supplier_id']);
               if ($header_bill['paytype']==-1)
                   DB::table('suppliers')->where('id',$header_bill['supplier_id'])->update(['balance'=>$supplier->balance+$header_bill['finaltotal']]);
               if ($header_bill['paytype']==1&&$header_bill['payvalue']!='')
                   DB::table('suppliers')->where('id',$header_bill['supplier_id'])->update(['balance'=>$supplier->balance+$header_bill['finaltotal']]);
               foreach ($request->product as $key=>$value){
                   $bill_details=[
                       'billnum'=>$billNum,
                       'product'=>$value,
                       'qty'=>$request->qty[$key],
                       'unitprice'=>$request->unitprice[$key],
                       'subtotal'=>$request->subtotal[$key],
                       'note'=>$request->note[$key],
                   ];
                   PurchaseInvoiceDetail::create($bill_details);
               }
               return response(['status'=>true]);
           }
       }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $suppliers =DB::table('suppliers')->get(['id','name']);
//        $employees = DB::table('employees')->get(['id','name']);
        $purchaseinvoice = PurchaseInvoice::with(['purchaseInvoiceDetail','supplier','employee'])->where('id',$id)->first();
//        $sum_return_items = ReturnBuy::where('billnum',$id)->get()->sum('subtotal');
//        ,'sum_return_items'=>$sum_return_items

        return view('dashbord.purchase-invoice.show',['purchaseinvoice'=>$purchaseinvoice]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suppliers =DB::table('suppliers')->get(['id','name']);
        $employees = DB::table('employees')->get(['id','name']);
        $purchaseinvoice = PurchaseInvoice::with('purchaseInvoiceDetail')->where('id',$id)->first();
        return view('dashbord.purchase-invoice.edit',['purchaseinvoice'=>$purchaseinvoice,'suppliers'=>$suppliers,'employees'=>$employees]);
    }

    public function update(Request $request, $id)
    {
        $purchaseinvoice = PurchaseInvoice::find($id);
        $supplier =DB::table('suppliers')->find($purchaseinvoice->supplier_id);

        $header_bill =$this->validate($request, [
            'supplier_id'=>'required|integer',
            'receiver'=>'required|integer',
            'paytype'=>'required|integer',
            'payvalue'=>'integer|nullable',
            'discount'=>'numeric|nullable',
            'tax'=>'numeric|nullable',
            'total'=>'numeric|integer',
            'finaltotal'=>'required|numeric',
        ]);

        $bill_details = $this->validate($request,[
            'product'=>'required',
            'qty'=>'required',
            'unitprice'=>'required',
            'subtotal'=>'required',
            'note[]'=>'string|max:155|nullable',
        ]);
        $purchaseinvoice->paytype==0? $old_balance = $supplier->balance: $old_balance = $supplier->balance - $purchaseinvoice->finaltotal;
        DB::table('suppliers')->where('id',$supplier->id)->update(['balance'=>$old_balance]);
        if($purchaseinvoice->update($header_bill)){
            $supplier_balance = DB::table('suppliers')->find($header_bill['supplier_id']);
            PurchaseInvoiceDetail::where('billnum',$id)->delete();
            if ($header_bill['paytype']!=0)
//                $header_bill['payvalue']==''?0:$header_bill['payvalue'];
                DB::table('suppliers')->where('id',$header_bill['supplier_id'])->update(['balance'=>$supplier_balance->balance+$header_bill['finaltotal']]);
            foreach ($request->product as $key=>$value){
                $bill_details=[
                    'billnum'=>$id,
                    'product'=>$value,
                    'qty'=>$request->qty[$key],
                    'unitprice'=>$request->unitprice[$key],
                    'subtotal'=>$request->subtotal[$key],
                    'note'=>$request->note[$key],
                ];
                PurchaseInvoiceDetail::create($bill_details);
            }
            return redirect(route('purchaseInvoice.index'))->with('done',trans('trans.done'));
        }

//        elseif ($header_bill['paytype']==1&&$header_bill['payvalue']!='')
//                DB::table('suppliers')->where('id',$header_bill['supplier_id'])->update(['balance'=>$header_bill['finaltotal']-$header_bill['payvalue']+$supplier->balance]);



    }



    public function destroy($id)
    {
        $purchase_invoice = PurchaseInvoice::where('id',$id)->first();
        $supplier =DB::table('suppliers')->find($purchase_invoice->supplier_id);
        if ($purchase_invoice->paytype!=0)
            DB::table('suppliers')->where('id',$purchase_invoice->supplier_id)->update(['balance'=>$supplier->balance-$purchase_invoice->finaltotal]);
        if ($purchase_invoice->delete($id)){
            return response(['data'=>trans('trans.done')]);
        }
    }
}
