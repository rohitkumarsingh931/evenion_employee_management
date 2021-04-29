

@extends('admin.admin_layout')
@section('breadcrumb','Empleyees')
@section('employee_active','active')
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
              <h6 class="card-body-title col-lg-9">Employees List</h6>
              <div class="col-lg-3"><a href="{{url('admin/add-employee')}}"><button class="btn btn-success btn-block mg-b-10"><i class="fa fa-plus mg-r-10"></i>Add Employee</button></a></div>
          </div>
          <div class="table-wrapper">
            <table id="datatable2" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">S.no.</th>
                  <th class="wd-15p">First Name</th>
                  <th class="wd-20p">Last Name</th>
                  <th class="wd-15p">Company</th>
                  <th class="wd-10p">Email</th>
                  <th class="wd-10p">Phone</th>
                  <th class="wd-25p">Action</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $i=1;
                @endphp
                @foreach($employee as $list)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{$list->first_name}}</td>
                  <td>{{$list->last_name}}</td>
                  <td>
                   {{$list->name}}
                </td>
                  <td>{{$list->email}}</td>
                   <td>{{$list->phone}}</td>
                  <td>
                    <a href="{{route('employee.update',$list->id)}}">
                      <button class="btn btn-success mg-b-10"><i class="fa fa-pencil mg-r-10"></i> Edit</button></a> <a href="{{ route('employee.delete',$list->id) }}"><button class="btn btn-danger mg-b-10"><i class="fa fa-trash mg-r-10"></i> Delete</button></a></td>
                </tr>
                @php
                $i++;
                @endphp
                @endforeach


                
              </tbody>

            </table>
            <div class="dataTables_paginate paging_simple_numbers" id="datatable1_paginate">{{ $employee->links() }}</div>
             
          </div><!-- table-wrapper -->

        </div><!-- card -->

        </div>
        
      @include('admin.footer_inc')
      

      @endsection
