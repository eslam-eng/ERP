<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerDealHeader;
use App\DealOrderDeatails;
use App\DealOrderHeader;
use Illuminate\Http\Request;

class DealOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $deal_orders = DealOrderHeader::with('deal')->orderBy('date','asc')->get();
        return view('dashbord.customers.deal_order.index',['deal_orders'=>$deal_orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all(['id','name']);
        $customer_deals = CustomerDealHeader::orderBy('date','asc')->get(['id','descdeal','customer_id','date']);
        return view('dashbord.customers.deal_order.add',['customers'=>$customers,'customer_deals'=>$customer_deals]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return $request->all();
            $this->validate($request,[
                'deal_id'=>'required|integer|min:1',
                'discount'=>'numeric|nullable',
                'tax'=>'numeric|nullable',
                'total'=>'required|numeric',
                'product.*' => 'required',
                'qty.*'=>'required|min:1',
                'unitprice.*'=>'required',
                'subtotal'=>'required',
                'note[]'=>'string|max:155|nullable',
            ]);
            $deal_order_header =[
                'deal_id' =>$request->deal_id,
                'discount' =>$request->discount,
                'tax' =>$request->tax,
                'total' =>$request->total,
            ];
            $check_deal_exsist = DealOrderHeader::where('deal_id',$request->deal_id)->count();

            if ($check_deal_exsist!=0) {
                $old_order_deal = DealOrderHeader::find($request->deal_id);
                DealOrderHeader::where('deal_id',$deal_order_header['deal_id'])->update([
                    'tax' => $old_order_deal->tax + $deal_order_header['tax'],
                    'discount' => $old_order_deal->discount + $deal_order_header['discount'],
                    'total' => $old_order_deal->total + $deal_order_header['total']

                ]);
                foreach ($request->product as $key=>$value)
                {
                    $deal_details=[
                        'deal_id'=>$deal_order_header['deal_id'],
                        'product'=>$value,
                        'qty'=>$request->qty[$key],
                        'unitprice'=>$request->unitprice[$key],
                        'subtotal'=>$request->subtotal[$key],
                        'note'=>$request->note[$key],
                    ];
                    DealOrderDeatails::create($deal_details);
                }
                return redirect(route('customer-Deal-order.index'))->with('done',trans('trans.done'));
            }
            else
            {
                if(DealOrderHeader::create($deal_order_header)){
                    foreach ($request->product as $key=>$value){
                        $deal_details=[
                            'deal_id'=>$deal_order_header['deal_id'],
                            'product'=>$value,
                            'qty'=>$request->qty[$key],
                            'unitprice'=>$request->unitprice[$key],
                            'subtotal'=>$request->subtotal[$key],
                            'note'=>$request->note[$key],
                        ];
                        DealOrderDeatails::create($deal_details);
                    }
                    return back()->with('done',trans('trans.done'));
                }
            }
            return back()->with('fail',trans('trans.fail'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $deal_order = DealOrderHeader::with('dealOrderDetail')->where('id',$id)->first();
        $deal = CustomerDealHeader::with('customer')->where('id',$deal_order->deal_id)->first();
        return view('dashbord.customers.deal_order.show',['deal_order'=>$deal_order,'deal'=>$deal]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $deal_order = DealOrderHeader::with('dealOrderDetail')->where('id',$id)->first();
        $deal = CustomerDealHeader::with('customer')->where('id',$deal_order->deal_id)->first();
        return view('dashbord.customers.deal_order.edit',['deal_order'=>$deal_order,'deal'=>$deal]);
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
        $deal_order = DealOrderHeader::find($id);
        $this->validate($request,[
            'deal_id'=>'required|integer|min:1',
            'discount'=>'integer|nullable',
            'tax'=>'integer|nullable',
            'total'=>'required|integer',
            'product.*' => 'required',
            'qty.*'=>'required|min:1',
            'unitprice.*'=>'required',
            'subtotal'=>'required',
            'note[]'=>'string|max:155|nullable',
        ]);
        $deal_order_header =[
            'deal_id' =>$request->deal_id,
            'discount' =>$request->discount,
            'tax' =>$request->tax,
            'total' =>$request->total,
        ];
        DealOrderDeatails::where('deal_id',$deal_order_header['deal_id'])->delete();
        if($deal_order->update($deal_order_header)){
            foreach ($request->product as $key=>$value){
                $deal_details=[
                    'deal_id'=>$deal_order_header['deal_id'],
                    'product'=>$value,
                    'qty'=>$request->qty[$key],
                    'unitprice'=>$request->unitprice[$key],
                    'subtotal'=>$request->subtotal[$key],
                    'note'=>$request->note[$key],
                ];
                DealOrderDeatails::create($deal_details);
            }
            return redirect(route('customer-Deal-order.index'))->with('done',trans('trans.done'));
        }
        return redirect(route('customer-Deal-order.index'))->with('fail',trans('trans.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deal_deleted = DealOrderHeader::where('id',$id)->delete();
        $msg =trans('trans.done');
        if ($deal_deleted)
            return response(['data'=>$msg]);

    }
}
