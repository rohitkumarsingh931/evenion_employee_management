

@extends('admin.admin_layout')
@section('breadcrumb','Company')
@section('company_active','active')
@section('main_content')
<!-- ########## START: MAIN PANEL ########## -->
    

      <div class="sl-pagebody">
        @if(session('message'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <strong class="d-block d-sm-inline-block-force">Well done!</strong> {{session('message')}}
          </div>
        @endif

        <div class="card pd-20 pd-sm-40 mg-t-50">
            <div class="row mt-2  mb-4">
              <h6 class="card-body-title col-lg-9">Compaines List</h6>
              <div class="col-lg-3"><a href="{{url('admin/add-company')}}"><button class="btn btn-success btn-block mg-b-10"><i class="fa fa-plus mg-r-10"></i>Add Company</button></a></div>
          </div>
          <div class="table-wrapper">
            <table id="datatable2" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">S.no.</th>
                  <th class="wd-15p">Name</th>
                  <th class="wd-20p">Email</th>
                  <th class="wd-15p">Logo</th>
                  <th class="wd-10p">Website</th>
                  <th class="wd-25p">Action</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $i=1;
                @endphp
                @foreach($companies as $company)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{$company->name}}</td>
                  <td>{{$company->email}}</td>
                  <td>
                    @if($company->logo)
                      <img src="{{asset('storage/media/company/'.$company->logo)}}" width="100" height="50">
                    @else

                    @endif
                </td>
                  <td>{{$company->website}}</td>
                  <td>
                    <a href="{{route('company.update',$company->id)}}">
                      <button class="btn btn-success mg-b-10"><i class="fa fa-pencil mg-r-10"></i> Edit</button></a> <a href="{{ route('company.delete',$company->id) }}"><button class="btn btn-danger mg-b-10"><i class="fa fa-trash mg-r-10"></i> Delete</button></a></td>
                </tr>
                @php
                $i++;
                @endphp
                @endforeach
                
              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->

        </div>
        
      @include('admin.footer_inc')
      

      @endsection
