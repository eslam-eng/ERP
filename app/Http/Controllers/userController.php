<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class userController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only('update');
        $this->middleware(['permission:delete_users'])->only('delete');
    }

    public function index()
    {

        $users = User::all();
        return view('dashbord.user.index',['users'=>$users]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashbord.user.add');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'role'=>'required',
        ]);
        $data['isactive']=$request->isactive==''?0 : 1;
        $data['password']=bcrypt($data['password']);
        $user = User::create($data);

        if ($request->role=='super_admin')
        {
            $user->attachRole($request->role);
            return redirect()->route('users.index')->with('done',trans('trans.done'));
        }
        $user->attachRole($request->role);
        $user->syncPermissions($request->permissions);
        return redirect()->route('users.index')->with('done',trans('trans.done'));


        return redirect()->route('users.index')->with('faild',trans('trans.fail'));

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
    public function edit(User $user)
    {
        return view('dashbord.user.edit',compact('user'));
    }

    public function update(Request $request,User $user)
    {
        $data = $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'nullable|min:3',
            'role'=>'required',
        ]);
        $data['isactive']=$request->isactive==''?0 : 1;
        $request->password==''?$data['password']=$user->password:$data['password']=bcrypt($data['password']);
//        $data['password']=bcrypt($data['password']);

        $user->detachRole($user->role);

        $user->update($data);

        if ($request->role=='super_admin')
        {
            $user->attachRole($request->role);
            return redirect()->route('users.index')->with('done',trans('trans.done'));
        }
        $user->attachRole($request->role);
        $user->syncPermissions($request->permissions);
        return redirect()->route('users.index')->with('done',trans('trans.done'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $msg = trans('trans.done');
        $user->detachRole($user->role);
        $user->detachPermissions($user->permissions);
        if ($user->delete())
            return response($msg);
    }
}
