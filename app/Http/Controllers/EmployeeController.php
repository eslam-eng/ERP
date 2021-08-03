<?php

namespace App\Http\Controllers;

use App\Employee;
use Faker\Provider\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return view('dashbord.employee.index',['employees'=>$employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashbord.employee.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$this->validate($request,[
            'name'=>'required',
            'salary'=>'required',
            'numDays'=>'required|integer|min:1',
            'numHours'=>'required|integer|min:1',
            'S_perDay'=>'required',
            'S_perHour'=>'required',
            'status'=>'required',
            'qualification'=>'required',
            'nationalId'=>'required|unique:employees',
            'job'=>'required',
            'address'=>'nullable|max:120',
            'note'=>'nullable|max:155',
            'balance'=>'required|min:1',
            'avatar'=>'image|mimes:jpj,png,jpeg|max:2024|nullable',
        ]);

        $data['isactive']=$request->isactive==''?0 : 1;
        $data['mobile']=$request->mobile;
        if ($request->has('avatar')){
            $file = $request->file('avatar');
            $data['avatar']=$img_name = time().".".$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$img_name);
        }

        if (Employee::create($data)){
            return redirect(route('employee.index'))->with('done',trans('trans.emp_success'));
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
        $employee = Employee::where("id",$id)->get()->first();
        return response()->json($employee);

    }

    public function edit($id)
    {
        $employee = Employee::find($id);
        return view('dashbord.employee.edit',['employee'=>$employee]);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::where('id',$id)->get()->first();
        $data=$this->validate($request,[
            'name'=>'required',
            'salary'=>'required',
            'numDays'=>'required|integer|min:1',
            'numHours'=>'required|integer|min:1',
            'S_perDay'=>'required',
            'S_perHour'=>'required',
            'status'=>'required',
            'mobile'=>'required',
            'qualification'=>'required',
            'nationalId'=>'required',
            'job'=>'required',
            'address'=>'nullable|max:120',
            'note'=>'nullable|max:155',
            'balance'=>'required|nullable',
            'avatar'=>'image|mimes:jpj,png,jpeg|nullable',
        ]);

        $data['isactive']=$request->isactive==''?0 : 1;
        $data['mobile']=$request->mobile;
        $data['balance']=$request->balance==''?0:$request->balance;
        $data['note']=$request->note==''?null : $request->note;

        if ($request->has('avatar')){
            $employee->avatar!=''?unlink(public_path().'\upload\\'.$employee->avatar):'';
            $file = $request->file('avatar');
            $data['avatar']=$img_name = time().".".$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$img_name);
        }
        $employee->update($data);
        return redirect()->route('employee.index')->with('done',trans('trans.emp_update'));


    }

    public function destroy($id){
        $employee = Employee::find($id);
        $msg = trans('trans.emp_delete');
        if($employee->delete()){
            if ($employee->avatar!=''){
                $img_path = public_path().'\upload\\'.$employee->avatar;
                unlink($img_path);
            }
//            DB::table('receipts')->where('type','=','1')->where('name',$id)->delete();
//            DB::table('catch_receipts')->where('type','=','1')->where('name',$id)->delete();
            return response(['status'=>$msg]);
        }

    }
}
