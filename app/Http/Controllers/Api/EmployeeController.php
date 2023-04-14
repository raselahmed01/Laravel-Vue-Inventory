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
        $singleEmployee=DB::table('employees')->where('id',$id)->first();
        return response()->json($singleEmployee);
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
            
            $data=array();

            $data['emp_name']=$request->emp_name;
            $data['emp_email']=$request->emp_email;
            $data['emp_phone']=$request->emp_phone;
            $data['emp_salary']=$request->emp_salary;
            $data['emp_address']=$request->emp_address;
            $data['emp_nid']=$request->emp_nid;
            $data['emp_join_date']=$request->emp_join_date;
            


            $newphoto = $request->emp_new_photo;


            // $position=strpos($request->emp_photo,';');
            // $sub=substr($request->emp_photo,0,$position);
            // $extension=explode('/',$sub)[1];
            // $img_name=time().".".$extension;

            // $img=Image::make($request->emp_photo)->resize(320,280);

            // $upload='backend/employee/';
            // $imgurl=$upload.$img_name;
 
            if($newphoto){
                $position=strpos($newphoto,';');
                $sub=substr($newphoto,0,$position);                
                $ext=explode('/',$sub)[1];
                $name=time().'.'.$ext;

                $img=Image::make($newphoto)->resize(320,280);
                $uploadpath='backend/employee/';
                $imgUrl=$uploadpath.$name;
                $success=$img->save($imgUrl);
                if($success){
                    $data['emp_photo']=$imgUrl;
                    $img = DB::table('employees')->where('id',$id)->first();
                    
                    $done= unlink($img->emp_photo);

                   $employee = DB::table('employees')->where('id',$id)->update($data);
                }
            }
            else{

            
            $old_photo=$request->emp_photo;
            $data['emp_photo']=$old_photo;

            $employee= DB::table('employees')->where('id',$id)->update($data);

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
        $employee = DB::table('employees')->where('id',$id)->first();
        $photo=$employee->emp_photo;

        if($photo){
            unlink($photo);
            DB::table('employees')->where('id',$id)->delete();
        }else{
            DB::table('employees')->where('id',$id)->delete();
        }
    }
}
