<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies=Company::all();
        return view('admin.index',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_company($id='')
    {
        if($id>0){
            $arr=Company::find($id);
            
            $result['name']=$arr->name;
            $result['email']=$arr->email;
            $result['logo']=$arr->logo;
            $result['website']=$arr->website;
            
            $result['id']=$arr->id;
            $result['company']=DB::table('companies')->where('id','!=',$id)->get();
        }
        else {
            $result['name']='';
            $result['email']='';
            $result['logo']='';
            $result['website']='';
            $result['id']=0;
            $result['company']=DB::table('companies')->get();

        }
        return view('admin.add-company',$result);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function company_save(Request $request)
    {
        if($request->id>0){
            $image_validate='mimes:jpeg,jpg,png';
        }
        else {
           $image_validate='required|mimes:jpeg,jpg,png';
        }

        $request->validate([
            'name'=>'required|unique:companies,name,'.$request->id,
            'email'=>'required',
            'logo'=>$image_validate
        ]);

        if($request->id>0){
            $company=Company::find($request->id);
            $msg='Company Updated';
        }
        else {
            $company= new Company();
            $msg='Company Inserted';
        }

        if($request->hasfile('logo')){
            if($request->id>0){
                $arrImage=DB::table('companies')->where(['id'=>$request->id])->get();
            //dd($arrImage);
                if(Storage::exists('public/media/company/'.$arrImage[0]->logo)){
                    Storage::delete('public/media/company/'.$arrImage[0]->logo);
                }
              }
        $logo_image=$request->file('logo');
        $rand=rand('11111111','99999999');
        $ext=$logo_image->extension();
        $image_name=$rand.'.'.$ext;
        $logo_image->storeAs('public/media/company/',$image_name);
        $company->logo=$image_name;
        }

        $company->name=$request->post('name');
        $company->email=$request->post('email');
        //$company->logo=$request->post('Company_Name');
        $company->website=$request->post('website_link');

        $company->save();
        $request->session()->flash('message',$msg);
        return redirect('admin/dashboard');   

    }

    public function company_delete(Request $request,$id) {

        $model=Company::find($id);
        $model->delete();
        $request->session()->flash('message','Company deleted');
        return redirect('admin/dashboard'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
