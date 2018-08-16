@extends('layouts.app')

@section('content')
<div class="bd-y bd-gray-500 bg-light" id="employeeoptions">
  <div class="ht-md-60 wd-200 wd-md-auto pd-y-20 pd-md-y-0 d-md-flex align-items-center justify-content-center tx-poppins" >
      <ul class="nav nav-effect nav-effect-5 tx-uppercase tx-bold tx-spacing-2 flex-column flex-md-row" role="tablist">
        <li class="nav-item">
          <a href="{{route('employees')}}" >
          <div class="br-menu-item nav-link">
            <i class="menu-item-icon fas fa-user tx-20"></i>
            <span class="menu-item-label">Employees</span>
          </div><!-- menu-item -->
        </a>
        </li>
       <li class="nav-item">
          <a href="{{route('employees')}}" >
          <div class="br-menu-item nav-link">
            <i class="menu-item-icon fas fa-user tx-20"></i>
            <span class="menu-item-label">Employees</span>
          </div><!-- menu-item -->
        </a>
        </li>
    <li class="nav-item">
          <a href="{{route('employees')}}" >
          <div class="br-menu-item nav-link">
            <i class="menu-item-icon fas fa-user tx-20"></i>
            <span class="menu-item-label">Employees</span>
          </div><!-- menu-item -->
        </a>
        </li>
    <li class="nav-item">
          <a href="{{route('employees')}}" >
          <div class="br-menu-item nav-link">
            <i class="menu-item-icon fas fa-user tx-20"></i>
            <span class="menu-item-label">Employees</span>
          </div><!-- menu-item -->
        </a>
        </li>

      </ul>
    </div>
    </div>
<!-- br-pageheader -->
      <div class="d-sm-flex align-items-center pd-t-15 pd-sm-t-15 pd-x-20 pd-sm-x-30">
        <i class="icon icon ion-ios-people tx-50 lh-0 tx-gray-800"></i>
        <div class="pd-sm-l-20 mg-t-10 mg-sm-t-0">
          <h4 class="tx-gray-800 mg-b-5">Employees</h4>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4">
           <form action="{{route('importemployee')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-md-8"><input type="file" name="import_file" /></div>
            <div class="col-md-4"><button class="btn btn-primary">Import File</button></div>
          </div>
          </form>
        </div>
        <div class="col-md-1">
         
                <a class="btn btn-primary pull-right" href="{{route('createemployee')}}">Add Employee</a>
       
              </div>
      </div><!-- d-flex -->

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">List of Employees</h6>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">ID No</th>
                  <th class="wd-15p">Last Name</th>
                  <th class="wd-15p">First Name</th>
                  <th class="wd-15p">Middle Name</th>
                  <th class="wd-20p">Branch</th>
                  <th class="wd-15p">Position</th>
                  <th class="wd-15p">Action</th>
                </tr>
              </thead>
              <tbody>
                 @foreach($employees as $employee)
                      <tr>
                          <td class="tx-black tx-normal">{{$employee['id_no']}}</td>
                          <td class="tx-black tx-normal">{{$employee['last_name']}}</td>
                          <td class="tx-black tx-normal">{{$employee['first_name']}}</td>
                          <td class="tx-black tx-normal">{{$employee['middle_name']}}</td>
                          <td class="tx-black tx-normal">{{$employee['name']}}</td>
                          <td class="tx-black tx-normal">{{$employee['position']}}</td>
                          <td class="tx-black tx-normal"><button type="submit" class="btn btn-success" onclick="getemployee('{{$employee['id']}}')">Edit</button></td>
                      </tr>
                    @endforeach
              </tbody>
            </table>
          </div> 
</div>
</div>
          <script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>

  $(document).ready(function() {
   var options = {
  valueNames: [ 'name', 'born' ]
};

var userList = new List('users', options);
  });
 $(function(){
        'use strict';

        $('#datatable1').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
          }
        });

});
   function getemployee(id){
      window.location.href = '{{route ("editemployee", ["id" => ''] )}}'+'/'+id
    }
</script>
<script src=""></script>
@endsection


 
              