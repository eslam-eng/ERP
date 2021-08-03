<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerDealHeader;
use App\CustomerPaid;
use Illuminate\Http\Request;

class CustomerPaidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customerpaids=CustomerPaid::with('customer')->with('deal')->orderBy('date')->get();
//        return $customerpaids;
        return view('dashbord.customerpaid.index',['customerpaids'=>$customerpaids]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $customers = Customer::with('customerDeal')->get(['id','name']);
        $customers = Customer::all(['id','name']);
        $deals = CustomerDealHeader::all(['id','customer_id','date','descdeal']);
        return view('dashbord.customerpaid.add',['customers'=>$customers,'deals'=>$deals]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'date'=>'required',
            'customer_id'=>'required|integer',
            'deal_id'=>'required|integer',
            'receiver'=>'required|string',
            'value'=>'required|numeric',
            'note'=>'string|nullable'
        ]);

        $customer = Customer::where('id',$data['customer_id'])->first();
        if (CustomerPaid::create($data)){
            $customer->update([
                'dept' => $customer->dept-$data['value']
            ]);
            return back()->with('done',trans("trans.done"));
        }
//        }
        return back()->with('fail',trans("trans.fail"));

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
        $customer_paid = CustomerPaid::where('id',$id)->first();
        $deals = CustomerDealHeader::with('customer')->get(['id','customer_id','descdeal','date']);

        return view('dashbord.customerpaid.edit',['customer_paid'=>$customer_paid,'deals'=>$deals]);

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
            'customer_id'=>'required|integer',
            'deal_id'=>'required|integer',
            'receiver'=>'required|string',
            'value'=>'required|integer',
            'note'=>'string|nullable'
        ]);
        $customerpaid = CustomerPaid::find($id);
        $customer = Customer::where('id',$data['customer_id'])->first();
        $old_dept_before_paid = $customer->dept+$customerpaid->value;
        if (CustomerPaid::where('id',$id)->update($data)){
            Customer::where('id',$data['customer_id'])->update([
                'dept' => $old_dept_before_paid-$data['value']
            ]);
            return back()->with('done',trans("trans.done"));
        }
//        }
        return back()->with('fail',trans("trans.fail"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $msg = trans("trans.done");
        $customerPaid = CustomerPaid::find($id);
        $customer = Customer::find($customerPaid->customer_id);
        if ($customerPaid->delete())
            $customer->update([
                'dept'=>$customer->dept+$customerPaid->value
            ]);
        return response(['data'=>$msg]);
    }
}
