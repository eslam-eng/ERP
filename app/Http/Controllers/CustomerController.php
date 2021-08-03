<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('dashbord.customers.index',['customers'=>$customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashbord.customers.add');
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
        'name'          =>'required|string',
        'nationalId'    =>'numeric|nullable',
        'mobile'        =>'numeric|required',
        'address'       =>'string|nullable',
        'dept'          =>'numeric|nullable',
        'note'          =>'nullable|string',
    ]);
        $data['isactive']=$request->isactive==''?0 : 1;

        if ( Customer::create($data))
             return redirect(route('customers.index'))->with('done',trans("trans.done"));
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $customer = Customer::find($id);
        return view('dashbord.customers.edit',['customer'=>$customer]);

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
        $customer = Customer::find($id);
        $data = $this->validate($request,[
            'name' =>'required|string',
            'nationalId' =>'integer|required',
            'mobile' =>'integer|required',
            'address' =>'string|nullable',
            'dept' =>'integer|min:0',
            'note' =>'nullable|string',

        ]);
        $data['isactive']=$request->isactive==''?0 : 1;
        if ($customer->update($data))
            return redirect(route('customers.index'))->with('done',trans("trans.done"));

        return redirect(route('customers.index'))->with('fail',trans("trans.fail"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::where('id',$id)->delete();
        $msg =trans('trans.done');
        if ($customer)
            return response(['data'=>$msg]);

    }
}
