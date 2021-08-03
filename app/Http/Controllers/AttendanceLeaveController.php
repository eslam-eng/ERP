<?php

namespace App\Http\Controllers;

use App\Employee;
use App\EmployeeMove;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceLeaveController extends Controller
{

    public function index(){
        $data = EmployeeMove::with('employee')->orderBy('date','asc')->get(['id','empId','date','attendanceTime','leaveTime','attnote','leavenote','absentnote']);
        return view('dashbord.employee.emptime.index',['times'=>$data]);
    }

    public function create(){
        $employees = Employee::all(['id','name']);
        return view('dashbord.employee.emptime.atten_And_leave',['employees'=>$employees]);
    }


    public function storeAttendance(Request $request){
        $data = $this->validate($request,[
           'empId'=>'required',
           'date'=>'required',
           'attendanceTime'=>'required',
           'attnote'=>'string|nullable|max:190'
        ]);
        $count =DB::table('employee_moves')->where('empId',$data['empId'])->where('date',$data['date'])->count();
        if ($count==0){
            DB::table('employee_moves')->insert([
                'empId'=>$data['empId'],
                'date'=>$data['date'],
                'attendanceTime'=>$data['attendanceTime'],
                'attnote'=>$data['attnote'],
            ]);
            return back()->with('done',trans('trans.done'));
        }else{
            $check =DB::table('employee_moves')->where('empId',$data['empId'])->where('date',$data['date'])->where('attendanceTime','=',null)->count();
            if ($check){
               DB::table('employee_moves')->update([
                   'attendanceTime'=>$data['attendanceTime'],
                   'attnote'=>$data['attnote'],
               ]);
               return back()->with('done',trans('trans.done'));
           }
            return back()->with('fail',trans('trans.fail_add_attendance'));
        }

    }

    public function storeLeave(Request $request){
        $data = $this->validate($request,[
            'empId'=>'required',
            'date'=>'required',
            'leaveTime'=>'required',
            'leavenote'=>'string|nullable|max:190'
        ]);
        $att = DB::table('employee_moves')->where('date',$request->date)->where('empId',$request->empId)->first();
       if($att!=null){
           $TimeStart = DateTime::createFromFormat( 'g:i A', $att->attendanceTime );
           $TimeEnd = DateTime::createFromFormat( 'g:i A', $data['leaveTime'] );
           $Interval = $TimeStart->diff( $TimeEnd );
           $hours   = $Interval->format('%h');
           $minutes = $Interval->format('%i');
           $time_left = $hours . '.' . $minutes;
           $check =DB::table('employee_moves')->where('empId',$data['empId'])->where('date',$data['date'])->where('leaveTime','=',null)->count();
           if ($check){
               DB::table('employee_moves')->where('empId',$data['empId'])->where('date',$data['date'])->update([
                   'leaveTime'=>$data['leaveTime'],
                   'leavenote'=>$data['leavenote'],
                   'work_hour'=>$time_left
               ]);
               return back()->with('done',trans('trans.done'));
           }
           return back()->with('fail',trans('trans.fail_add_leave'));

        }
       else
       {
           return back()->with('fail',trans('trans.regTime'));
       }

    }



//    public function storeabsent(Request $request){
//        $data = $this->validate($request,[
//            'empId'=>'required',
//            'date'=>'required',
//            'absentnote'=>'string|nullable|max:255'
//        ]);
//        $count =DB::table('employee_moves')->where('empId',$data['empId'])->where('date',$data['date'])->count();
//        if ($count==0){
//            DB::table('employee_moves')->insert([
//                'empId'=>$data['empId'],
//                'date'=>$data['date'],
//                'absentnote'=>'غياب'
//            ]);
//            return redirect(route('all.AttendanceAndLeave'))->with('done',trans('trans.done'));
//        }else{
//            $check =DB::table('employee_moves')->where('empId',$data['empId'])->where('date',$data['date'])->count();
//            if ($check){
//                DB::table('employee_moves')->where('empId',$data['empId'])->update([
//                    'attendanceTime'=>'',
//                    'leaveTime'=>'',
//                    'attnote'=>'',
//                    'leavenote'=>'',
//                    'work_hour'=>''
//                ]);
//                return redirect(route('all.AttendanceAndLeave'))->with('done',trans('trans.done'));
//            }
//            return redirect(route('all.AttendanceAndLeave'))->with('fail',trans('trans.fail_add_leave'));
//        }
//    }



    public function edit($id)
    {
        $timedata = EmployeeMove::find($id);
        $employees = DB::table('employees')->get(['id','name']);
        return view('dashbord.employee.emptime.edit',['timedata'=>$timedata,'employees'=>$employees]);

    }

    public function update(Request $request,$id)
    {
        $empmove = EmployeeMove::find($id);

        $data = $this->validate($request,[
            'empId'=>'required',
            'date'=>'required',
            'leaveTime'=>'required',
            'attendanceTime'=>'required',
            'attnote'=>'string|nullable|max:190',
            'leavenote'=>'string|nullable|max:190'
        ]);
        $TimeStart = DateTime::createFromFormat( 'g:i A', $data['attendanceTime']  );
        $TimeEnd = DateTime::createFromFormat( 'g:i A', $data['leaveTime'] );
        $Interval = $TimeStart->diff( $TimeEnd );
        $hours   = $Interval->format('%h');
        $minutes = $Interval->format('%i');
        $time_left = $hours . '.' . $minutes;
        $data['work_hour']=$time_left;
        if (EmployeeMove::where('id',$id)->update($data))
          return redirect(route('all.AttendanceAndLeave'))->with('done',trans('trans.done'));
      return redirect(route('all.AttendanceAndLeave'))->with('fail',trans('trans.fail'));


    }

    public function destory($id)
    {
        $time = EmployeeMove::find($id);
        $msg = trans('trans.done');

        if($time->delete())
          return response(['status'=>$msg]);


    }
}

