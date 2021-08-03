<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductAddRequest;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductAddRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products =ProductAddRequest::with('Product')->latest('date')->latest('date')->get();
//        return  $products;->with('storeinfo')
        return view('dashbord.productaddrequest.index',['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $stores = Store::all();
        $products = Product::all();
        return view('dashbord.productaddrequest.add',['products'=>$products]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()){
            $data = $this->validate($request,[
                'product_id'=>'required',
                'amount'=>'required|min:1',
                "note.*"  => "nullable|string",
            ]);
            foreach ($data['product_id'] as $key=>$product){
                $order=[
                    'product_id'=>$product,
                    'amount'=>$data['amount'][$key],
                    'note'=>$data['note'][$key],
                    'date'=>date('Y-m-d')
                ];
                ProductAddRequest::create($order);
//                DB::table('product_add_requests')->insert([
//                    'product_id'=>$product,
//                    'amount'=>$data['amount'][$key],
//                    'note'=>$data['note'][$key],
//                    'date'=>date('Y-m-d')
//                ]);
                $item = Product::find($product);
                $item->update([
                    'qty'=>$item->qty + $order['amount']
                ]);
            }


            return response(['status'=>true]);

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
        $products = Product::all();
//        $stores = Store::all();
        $product_addrequest = ProductAddRequest::find($id);
//        return $product_addrequest;
        return view('dashbord.productaddrequest.edit',['products'=>$products,'product_addrequest'=>$product_addrequest]);
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
        $product_addrequest = ProductAddRequest::find($id);
        $product = Product::find($product_addrequest->product_id);
        $data = $this->validate($request,[
            'product_id'=>'required',
            'amount'=>'required|min:1',
            "note"  => "nullable|string",
        ]);
        $product->update([
            'qty'=>$product->qty - $product_addrequest->amount
        ]);
        if ($product_addrequest->update($data))
            Product::where('id',$data['product_id'])->update([
                'qty'=>$product->qty +$data['amount']
            ]);
            return  redirect(route('productaddrequest.index'))->with('done',trans('trans.done'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = ProductAddRequest::find($id);
        if ($product->delete()){
            $item = Product::find($product->product_id);
            $item->update([
                'qty'=>$item->qty - $product->amount
            ]);
            return response(['data'=>trans('trans.done')]);
        }

    }
}
