<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Employee;
use DB;
use Image;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allEmployee=Employee::all();
        return response()->json($allEmployee);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData=$request->validate([

            'emp_name' => 'required | max:255',
            'emp_email' => 'required | unique:employees',
            'emp_phone' => 'required|unique:employees',
            // 'emp_salary'=>'required',
            // 'emp_address'=>'required | max:255',
            // 'emp_nid'=>'required | min:6',
            // 'emp_join_date'=>'required',
            
        ]);

        if($request->emp_photo){

            $position=strpos($request->emp_photo,';');
            $sub=substr($request->emp_photo,0,$position);
            $extension=explode('/',$sub)[1];
            $img_name=time().".".$extension;

            $img=Image::make($request->emp_photo)->resize(320,280);

            $upload='backend/employee/';
            $imgurl=$upload.$img_name;

            $img->save($imgurl);


            $employee=new Employee();

            $employee->emp_name=$request->emp_name;
            $employee->emp_email=$request->emp_email;
            $employee->emp_phone=$request->emp_phone;
            $employee->emp_salary=$request->emp_salary;
            $employee->emp_address=$request->emp_address;
            $employee->emp_nid=$request->emp_nid;
            $employee->emp_join_date=$request->emp_join_date;
            $employee->emp_photo= $imgurl;
            $employee->save();

            
        }else{

            $employee=new Employee();

            $employee->emp_name=$request->emp_name;
            $employee->emp_email=$request->emp_email;
            $employee->emp_phone=$request->emp_phone;
            $employee->emp_salary=$request->emp_salary;
            $employee->emp_address=$request->emp_address;
            $employee->emp_nid=$request->emp_nid;
            $employee->emp_join_date=$request->emp_join_date;

            $employee->save();

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
