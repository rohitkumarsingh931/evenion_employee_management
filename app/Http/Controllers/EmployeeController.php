<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee=DB::table('employees')
                ->join('companies','companies.id', '=', 'employees.company_id')
                ->select('employees.id','employees.first_name','employees.last_name','employees.email', 'employees.phone', 'companies.name')
                ->simplePaginate(10);
        return view('admin.employee',compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_employee($id='')
    {
        if($id>0){
            $arr=Employee::find($id);
            $result['first_name']=$arr->first_name;
            $result['last_name']=$arr->last_name;
            $result['company_id']=$arr->company_id;
            $result['phone']=$arr->phone;
            $result['email']=$arr->email;
            $result['id']=$arr->id;
            $result['employee']=DB::table('employees')->where('id','!=',$id)->get();
        }
        else {
            $result['first_name']='';
            $result['last_name']='';
            $result['company_id']='';
            $result['phone']='';
            $result['email']='';
            $result['id']=0;
            $result['employee']=DB::table('employees')->get();
        }

        $result['employee']=DB::table('companies')->get();


        return view('admin.add-employee',$result);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function employee_save(Request $request)
    {
        

        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            
        ]);

        if($request->id>0){
            $employee=Employee::find($request->id);
            $msg='Employee Updated';
        }
        else {
            $employee= new Employee();
            $msg='Employee Inserted';
        }

        

        $employee->first_name=$request->post('first_name');
         $employee->last_name=$request->post('last_name');
        $employee->company_id=$request->post('company_id');
        $employee->email=$request->post('email');
        $employee->phone=$request->post('phone');
        $employee->save();
        $request->session()->flash('message',$msg);
        return redirect('admin/employee');   

    }

    public function employee_delete(Request $request,$id) {

        $model=Employee::find($id);
        $model->delete();
        $request->session()->flash('message','Employee deleted');
        return redirect('admin/employee'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    
}
