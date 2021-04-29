
@extends('admin.admin_layout')
@section('breadcrumb','Add Company')
@section('company_active','active')
@section('main_content')
<!-- ########## START: MAIN PANEL ########## -->
    

      <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40 mg-t-50">
            <div class="row mt-2  mb-4">
              <h6 class="card-body-title col-lg-9">Add Company</h6>
              <div class="col-lg-3"><a href="{{url('admin/dashboard')}}"><button class="btn btn-success btn-block mg-b-10"><i class="fa fa-plus mg-r-10"></i>Back</button></a></div>
          </div>
          <form action="{{route('compay.add')}}" method="POST" enctype="multipart/form-data">
          	@csrf
          <div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Name: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="name" placeholder="Enter company name" value="{{old('name',$name)}}">
                </div>
                @error('name')
	                <div class="alert alert-danger m-t-10" role="alert">
	                    {{$message}}
	                </div> 
	        	@enderror	
              </div><!-- col-4 -->
             
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Email address: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="email" name="email"  placeholder="Enter email address" value="{{old('email',$email)}}">
                </div>
                @error('email')
	                <div class="alert alert-danger m-t-10" role="alert">
	                    {{$message}}
	                </div> 
	        	@enderror	
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Company Logo <span class="tx-danger">*</span></label>
                  <input class="form-control" type="file" name="logo" >
                </div>
                @error('logo')
	                <div class="alert alert-danger m-t-10" role="alert">
	                    {{$message}}
	                </div> 
	        	@enderror	
              </div><!-- col-8 -->
              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Website Link: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="website_link"  placeholder="Website Link" value="{{old('website_link',$website)}}">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4"></div>
              <div class="col-lg-4">
              	@if($logo!='')
              		<img src="{{asset('storage/media/company/'.$logo)}}" width="100">
              	@endif

              </div>
            </div><!-- row -->
            <input type="hidden" name="id" value="{{$id}}">
 
            <div class="form-layout-footer">
              <button type="submit" class="btn btn-info mg-r-5">Submit Form</button>
            </div><!-- form-layout-footer -->
          </div></form>
        </div><!-- card -->
        </div>
      @include('admin.footer_inc')
      @endsection
