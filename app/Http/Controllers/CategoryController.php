<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashbord.category.index',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashbord.category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data= $this->validate($request,[
            'name'=>'required|unique:categories',
            'desc'=>'string|nullable|max:199',
        ]);
        $data['isactive']=$request->isactive==''?0 : 1;
       if (Category::create($data))
            return redirect(route('category.index'))->with('done',trans('trans.done'));

        return redirect(route('category.index'))->with('fail',trans('trans.fail'));
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
        $category = Category::find($id);
        return view('dashbord.category.edit',compact('category'));
    }

    public function update(Request $request, $id)
    {
        $data= $this->validate($request,[
            'name'=>'required|unique:categories,id,'.$id,
            'desc'=>'string|nullable|max:199',
        ]);
        $data['isactive']=$request->isactive==''?0 : 1;
        if (Category::where('id',$id)->update($data))
            return redirect(route('category.index'))->with('done',trans('trans.done'));

        return redirect(route('category.index'))->with('fail',trans('trans.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $msg = trans('trans.done');
        $delete = Category::find($id)->delete();
        if ($delete)
            return response($msg);
    }
}
