<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function index()
    {
        $stocks = DB::table('stores')->get();
        return view('dashbord.store.index',['stocks'=>$stocks]);
    }

    public function create()
    {
        return view('dashbord.store.add');
    }

    public function store(Request $request)
    {
        $data= $this->validate($request,[
            'name'=>'required|unique:stores',
            'desc'=>'string|nullable|max:199',
        ]);
        $data['isactive']=$request->isactive==''?0 : 1;
        DB::table('stores')->insert([
            'name'=>$data['name'],
            'desc'=>$data['desc'],
            'isactive'=>$data['isactive']
        ]);
        return redirect(route('stock.index'))->with('done',trans('trans.done'));


    }

    public function show($id)
    {
        $products = DB::table('products')->where('store',$id)->get();
//        return $products;
        return view('dashbord.store.show',['products'=>$products]);
    }

    public function edit($id)
    {
        $stock = DB::table('stores')->where('id', $id)->first();
        return view('dashbord.store.edit',['stock'=>$stock]);
    }
    public function update(Request $request, $id)
    {
        $data= $this->validate($request,[
            'name'=>'required|unique:stores,id,'.$id,
            'desc'=>'string|nullable|max:199',
        ]);
        $data['isactive']=$request->isactive==''?0 : 1;
        $update = DB::table('stores')->where('id',$id)->update([
            'name'=>$data['name'],
            'desc'=>$data['desc'],
            'isactive'=>$data['isactive']
        ]);
        if ($update)
            return redirect()->route('stock.index')->with('done',trans('trans.done'));
        return back()->with('fail',trans('trans.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = DB::table('stores')->delete($id);
        if ($delete){
            return response(['data'=>trans('trans.done')]);
        }

    }
}
