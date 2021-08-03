<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductOrder;
use Illuminate\Http\Request;

class productordercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products =ProductOrder::with('Product')->get();
//        return  $products;
        return view('dashbord.productorder.index',['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('qty','!=',0)->get();
        return view('dashbord.productorder.add',compact('products'));
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
            $message = [
              'note.*.required'=>trans('trans.errormessage')
            ];
            $data = $this->validate($request,[
                'product_id'=>'required',
                'amount'=>'required|min:1',
//                'note'=>'required|array|min:1',
                "note.*"  => "required|string",
//                "note.*"  => "required|string|distinct|max:100",
            ],$message);

            foreach ($data['product_id'] as $key=>$product){
                $order=[
                    'product_id'=>$product,
                    'amount'=>$data['amount'][$key],
                    'note'=>$data['note'][$key],
                    'date'=>date('Y-m-d')
                ];
                ProductOrder::create($order);
                $item = Product::find($product);
                Product::where('id',$product)->update([
                    'qty'=>$item->qty - $order['amount']
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
        $product_payrequest = ProductOrder::find($id);
        return view('dashbord.productorder.edit',['products'=>$products,'product_payrequest'=>$product_payrequest]);

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
        $product_payrequest = ProductOrder::find($id);
        $product = Product::find($product_payrequest->product_id);
        $data = $this->validate($request,[
            'product_id'=>'required',
            'amount'=>'required|min:1',
            "note"  => "nullable|string",
        ]);
        $product->update([
            'qty'=>$product->qty + $product_payrequest->amount
        ]);
        if ($product_payrequest->update($data))
            Product::where('id',$data['product_id'])->update([
                'qty'=>$product->qty - $data['amount']
            ]);
            return  redirect(route('productorder.index'))->with('done',trans('trans.done'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = ProductOrder::find($id);
        if ($product->delete()){
            $item = Product::find($product->product_id);
            $item->update([
                'qty'=>$item->qty + $product->amount
            ]);
            return response(['data'=>trans('trans.done')]);
        }
    }
}
