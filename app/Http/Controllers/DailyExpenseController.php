<?php

namespace App\Http\Controllers;

use App\DailyExpense;
use Illuminate\Http\Request;

class DailyExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = DailyExpense::all();
        return view('dashbord.mony.expense.index',['expenses'=>$expenses]);
    }

    public function create()
    {
        return view('dashbord.mony.expense.add');
    }
    public function store(Request $request){
        $data = $this->validate($request,[
            'genralexpense' =>'required',
            'value'=>'required|integer',
            'maker'=>'required',
            'note'=>'string|nullable'
        ]);

        if (DailyExpense::create($data))
            return redirect(route('DailyExpense.index'))->with('done',trans('trans.done'));
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
        $dailExpenes = DailyExpense::find($id);
        return view('dashbord.mony.expense.edit',['dailyExpense'=>$dailExpenes]);
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
            'genralexpense' =>'required',
            'value'=>'required|integer',
            'maker'=>'required',
            'note'=>'string|nullable'
        ]);

        if (DailyExpense::where('id',$id)->update($data))
            return redirect()->route('DailyExpense.index')->with('done',trans('trans.done'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $msg = trans('trans.done');
        $delete = DailyExpense::find($id)->delete();
        if ($delete)
            return response($msg);
    }
}
