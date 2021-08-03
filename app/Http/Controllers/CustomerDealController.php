<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerDealHeader;
use App\CustomerPaid;
use App\DealAttachment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerDealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $customers = CustomerDealHeader::with('customer')->orderBy('date','asc')->get();
        return view('dashbord.customers.customer_deal.index',['customers'=>$customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all(['id','name']);
        return view('dashbord.customers.customer_deal.add',['customers'=>$customers]);
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
            'customer_id'=>'required|integer',
            'descdeal'      =>'required|string',
            'dealtotal'     =>'required|integer',
            'pay_type'      =>'required|integer',
            'somepaid'      =>'nullable|integer',
            'note'          =>'string|nullable'
        ]);
        $deal_id=CustomerDealHeader::create($data)->id;
        if ($deal_id )
        {
            $isnert_somemony = CustomerPaid::create([
                'date'          =>Carbon::now()->format('y-m-d')
                ,'customer_id'  =>$data['customer_id']
                ,'deal_id'      =>$deal_id
                ,'receiver'     =>trans('trans.somemony')
                ,'note'         =>$data['note']
                ,'value'        =>$data['somepaid']
            ]);
            $customer = Customer::find($data['customer_id']);
            if ($data['pay_type']==-1 || $data['pay_type']==1)
                $customer->update(['dept'=>$customer->dept+$data['dealtotal']-$data['somepaid']]);

            if ($request->has('file')){
                $files = $request->file('file');
                foreach ($files as $file){
                    $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME).time();
                    $extention=$file->getClientOriginalExtension();
                    $filename = $name.".".$extention;
                    $file->move(public_path('upload'),$filename);
                    DealAttachment::create([
                        'deal_id'=>$deal_id,
                        'file_name'=>$name,
                        'extention'=>$extention
                    ]);
                }
            }

            return redirect(route('customer-Deal.index'))->with('done',trans('trans.done'));
        }
        return back()->with('fail',trans('trans.fail'));

    }

    public function show($id)
    {
        $extensions = array('jpg', 'JPG', 'png' ,'PNG' ,'jpeg' ,'JPEG');
        $customerimages = DealAttachment::where("deal_id",$id)->whereIn('extention',$extensions)->get();
        $customerfiles = DealAttachment::where("deal_id",$id)->whereNotIn('extention',$extensions)->get();
        return  view('dashbord.customers.customer_deal.show',['customerimages'=>$customerimages,'customerfiles'=>$customerfiles]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer_deal = CustomerDealHeader::with('customer')->with('dealAttachments')->find($id);
//       return $customer_deal;
        return view('dashbord.customers.customer_deal.edit',['customer_deal'=>$customer_deal]);
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
            'customer_id'=>'required|integer',
            'descdeal'      =>'required|string',
            'dealtotal'     =>'required|integer',
            'pay_type'      =>'required|integer',
            'somepaid'      =>'nullable|integer',
            'note'          =>'string|nullable'
        ]);
        $customer_deal = CustomerDealHeader::where('id',$id)->first();
        $customer = Customer::find($data['customer_id']);
        $customer_deal->pay_type==0? $old_dept = $customer->dept: $old_dept = $customer->dept - ($customer_deal->dealtotal-$customer_deal->somepaid);
        if (CustomerDealHeader::where('id',$id)->update($data))
        {
            if ($data['pay_type']==-1 || $data['pay_type']==1)
            {
                $data['somepaid']==''?0:$data['somepaid'];
                $customer->update([
                    'dept'=>$old_dept+$data['dealtotal']-$data['somepaid']
                ]);
            }else{
                $customer->update([
                    'dept'=>$old_dept
                ]);
            }


            if ($request->has('file')){
                $files = $request->file('file');
                $old_deal_attachments = DealAttachment::where('deal_id',$id)->get();
                foreach ($old_deal_attachments as $old_deal_attachment)
                {
                    $img_path = public_path().'\upload\\'.$old_deal_attachment->file_name.".".$old_deal_attachment->extention;
                    unlink($img_path);
                }
                DealAttachment::where('deal_id',$id)->delete($id);
                foreach ($files as $file){
                    $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME).time();
                    $extention=$file->getClientOriginalExtension();
                    $filename = $name.".".$extention;
                    $file->move(public_path('upload'),$filename);
                    DealAttachment::create([
                        'deal_id'=>$id,
                        'file_name'=>$name,
                        'extention'=>$extention
                    ]);
                }
            }
            return redirect(route('customer-Deal.index'))->with('done',trans('trans.done'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer_deal = CustomerDealHeader::where('id',$id)->first();
        $customer = Customer::where('id',$customer_deal->customer_id)->first();
       if ($customer_deal->pay_type!=0)
       {
           $customer->update([
               'dept'=>$customer->dept-($customer_deal->dealtotal-$customer_deal->sompaid)
           ]);
       }
        if ($customer_deal->delete($id)){
            return response(['data'=>trans('trans.done')]);
        }
    }
}


//[
//    'customer_id'=>$data['customer_id'],
//    'descdeal'      =>$data['descdeal'],
//    'dealtotal'     =>$data['dealtotal'],
//    'pay_type'      =>$data['pay_type'],
//    'somepaid'      =>$data['somepaid'],
//    'note'          =>$data['note']
//])
