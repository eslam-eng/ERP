<?php

namespace App\Http\Controllers;

use App\MonyMovement;
use Illuminate\Http\Request;

class MonyMoveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $charges = MonyMovement::all();
        return view('dashbord.mony.index',['charges'=>$charges]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashbord.mony.add');
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
        $data= $this->validate($request,[
            'from'   =>'required|string',
            'to'     =>'required|string',
            'value'  =>'required|integer',
            'note'   =>'string|nullable'
        ]);

        if (MonyMovement::create($data))
            return back()->with('done',trans("trans.done"));
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
        $mony = MonyMovement::find($id);
        return view('dashbord.mony.edit',['mony'=>$mony]);
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
        $data= $this->validate($request,[
            'from'   =>'required|string',
            'to'     =>'required|string',
            'value'  =>'required|integer',
            'note'   =>'string|nullable'
        ]);

        if (MonyMovement::where('id',$id)->update($data))
            return back()->with('done',trans("trans.done"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $money = MonyMovement::find($id);
        $msg = trans('trans.done');
        if($money->delete())
            return response(['status'=>$msg]);
    }
}
