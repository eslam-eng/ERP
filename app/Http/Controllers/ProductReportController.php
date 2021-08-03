<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;

class ProductReportController extends Controller
{

    public function productReportindex()
    {

        $products = Product::all();
        return view('dashbord.product.productreport.index',['products'=>$products]);

    }

    public function report(Request $request)
    {
        $data =$this->validate($request,[
            'product_id' =>'required',
            'fromdate' =>'required',
            'todate' =>'required',
        ]);
        if ($request->product_id==0)
        {
            //report all product
            $product_with_itsorders = Product::with([
                'productorder'=>function($query) use ($request){
                $query->whereBetween('date',[$request->fromdate,$request->todate]);
            },
                'productAdded'=>function($query) use ($request){
                    $query->whereBetween('date',[$request->fromdate,$request->todate]);
                }
            ])->whereBetween('date',[$request->fromdate,$request->todate])->get();
            return view('dashbord.product.productreport.reportallproduct',['products_data'=>$product_with_itsorders,'data'=>$data]);

        }else
        {

            $product_with_itsorders = Product::with([
                'productorder'=>function($query) use ($request){
                    $query->whereBetween('date',[$request->fromdate,$request->todate]);
                },
                'productAdded'=>function($query)use($request){
                    $query->whereBetween('date',[$request->fromdate,$request->todate]);
                }])->where('id',$request->product_id)->first();
            return view('dashbord.product.productreport.reportoneproduct',['products_data'=>$product_with_itsorders,'data'=>$data]);
        }

    }
}
