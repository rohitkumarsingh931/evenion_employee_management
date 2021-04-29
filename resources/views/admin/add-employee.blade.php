
@extends('admin.admin_layout')
@section('breadcrumb','Add Employee')
@section('employee_active','active')
@section('main_content')
<!-- ########## START: MAIN PANEL ########## -->
    
      <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40 mg-t-50">
            <div class="row mt-2  mb-4">
              <h6 class="card-body-title col-lg-9">Add Employee</h6>
              <div class="col-lg-3"><a href="{{url('admin/employee')}}"><button class="btn btn-success btn-block mg-b-10"><i class="fa fa-plus mg-r-10"></i>Back</button></a></div>
          </div>
          <form action="{{route('employee.add')}}" method="POST" enctype="multipart/form-data">
          	@csrf
          <div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">First Name: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="first_name" placeholder="Enter first name" value="{{old('first_name',$first_name)}}">
                </div>
                @error('first_name')
	                <div class="alert alert-danger m-t-10" role="alert">
	                    {{$message}}
	                </div> 
	        	@enderror	
              </div><!-- col-4 -->
             
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Last Name: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="last_name"  placeholder="Enter last name" value="{{old('email',$last_name)}}">
                </div>
                @error('last_name')
	                <div class="alert alert-danger m-t-10" role="alert">
	                    {{$message}}
	                </div> 
	        	    @enderror	
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Company: <span class="tx-danger">*</span></label>
                 <select id="category_id" name="company_id" class="form-control">
                       <option  value=""> Select Company</option>
                           @foreach($employee as $key=> $list)
                       @if($company_id==$list->id)
                       <option value="{{$list->id}}" selected>{{ $list->name }}</option>
                       @else
                       <option value="{{$list->id}}">{{ $list->name }}</option>
                       @endif
                      @endforeach
                  </select>
                </div>
               
              </div><!-- col-8 -->
              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Email: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="email"  placeholder="Website Link" value="{{old('email',$email)}}">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Phone: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="phone"  placeholder="Phone" value="{{old('phone',$phone)}}">
                </div>

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
