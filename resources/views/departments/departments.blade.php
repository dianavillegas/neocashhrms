@extends('layouts.app')

@section('content')

   <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="./index.html">Home</a>
          <span class="breadcrumb-item active">Departments</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="d-sm-flex align-items-center pd-t-15 pd-sm-t-25 pd-x-20 pd-sm-x-30">
        <i class="fas fa-building tx-60 lh-0 tx-gray-800"></i>
        <div class="pd-sm-l-20 mg-t-10 mg-sm-t-0">
          <h4 class="tx-gray-800 mg-b-5">List of Departments</h4>
        </div>
        <div class="col-md-7"></div>
        <div class="col-md-1">
                <a class="btn btn-primary pull-right" href="{{route('createdept')}}">Add New Department</a>
              </div>
      </div><!-- d-flex -->

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">List of Branches</h6>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">ID No</th>
                  <th class="wd-15p">Name</th>
                 
                   <th class="wd-15p">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($departments as $department)
                <tr>
                    <td>{{$department['id']}}</td>
                    <td>{{$department['name']}}</td>
                   
                    <td><button type="submit" class="btn btn-success" onclick="getdepartment('{{$department['id']}}')">Edit</button></td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div><!-- table-wrapper -->
</div>

          <script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>

    function getdepartment(id){
      window.location.href = '{{route ("editdept", ["id" => ''] )}}'+'/'+id
    }

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
</script>
@endsection
