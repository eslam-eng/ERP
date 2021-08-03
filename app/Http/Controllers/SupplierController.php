<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('dashbord.supplier.index',['suppliers'=>$suppliers]);
    }

    public function create()
    {
        return view('dashbord.supplier.add');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'name'=>'required',
            'responsible'=>'required',
            'mobile'=>'required',
            'email'=>'email|nullable',
            'balance'=>'required|integer',
            'address'=>'string|nullable',
        ]);
        $data['isactive']=$request->isactive==null?0:1;
        $data['address']=$request->address==''?null : $request->address;
        $count = Supplier::where('name',$data['name'])->where('responsible',$data['responsible'])->where('email',$data['email'])->get()->count();
        if ($count>0){
            return back()->with('fail',trans('trans.fail'));
        }else{
            Supplier::create($data);
            return redirect(route('supplier.index'))->with('done',trans('trans.done'),['status'=>'danger']);

        }
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view('dashbord.supplier.edit',['supplier'=>$supplier]);
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::where('id',$id)->first();
        $data = $this->validate($request,[
            'name'=>'required',
            'responsible'=>'required',
            'mobile'=>'required',
            'email'=>'email|nullable',
//            'balance'=>'required',
            'address'=>'string|nullable',
        ]);
        $data['isactive']=$request->isactive==null?0:1;
        $data['address']=$request->address==''?null : $request->address;
        if ($supplier->update($data)){
            return redirect()->route('supplier.index')->with('done',trans('trans.done'));
        }
    }

    public function destroy($id)
    {
        $msg = trans('trans.done');
        if(Supplier::find($id)->delete($id))
            return response()->json(array('status'=>$msg));

    }
}
