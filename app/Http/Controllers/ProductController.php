<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('dashbord.product.index',['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $categories = DB::table('categories')->get(['id','name']);
        $stores = DB::table('stores')->get(['id','name']);
        return view('dashbord.product.add',compact('stores'));
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
            'name' =>'required|string|unique:products',
            'qty' =>'required|integer',
            'store' =>'required|integer',
//            'category' =>'required|integer',
            'note' =>'nullable|string',
        ]);
        $data['isactive']=$request->isactive==''?0 : 1;
        $data['date']=date('Y-m-d');
       if (Product::create($data))
            return redirect(route('product.index'))->with('done',trans('trans.done'));
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
        $products = Product::all();
        return view('dashbord.product.printproducts',['products'=>$products]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $stores = DB::table('stores')->get();
//        $categories = DB::table('categories')->get();
        return view('dashbord.product.edit',compact('product','stores'));
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
            'name' =>'required|string|unique:products,id,'.$id,
            'qty' =>'required|integer',
            'store' =>'required|integer',
//            'category' =>'required|integer',
            'note' =>'nullable|string',
        ]);
        $data['isactive']=$request->isactive==''?0 : 1;
        if (Product::where('id',$id)->update($data))
            return redirect(route('product.index'))->with('done',trans('trans.done'));
        return redirect(route('product.index'))->with('fail',trans('trans.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product->delete()){
            return response(['data'=>trans('trans.done')]);
        }
    }
}
