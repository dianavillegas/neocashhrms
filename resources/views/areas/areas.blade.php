@extends('layouts.app')

@section('content')

   <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="./index.html">Home</a>
          <span class="breadcrumb-item active">Areas</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="d-sm-flex align-items-center pd-t-15 pd-sm-t-25 pd-x-20 pd-sm-x-30">
        <i class="fas fa-building tx-60 lh-0 tx-gray-800"></i>
        <div class="pd-sm-l-20 mg-t-10 mg-sm-t-0">
          <h4 class="tx-gray-800 mg-b-5">List of Areas</h4>
        </div>
       <div class="col-md-4"></div>
        <div class="col-md-4">
           <form action="{{route('importarea')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-md-8"><input type="file" name="import_file" /></div>
            <div class="col-md-4"><button class="btn btn-primary">Import File</button></div>
          </div>
          </form>
        </div>
        <div class="col-md-1">
                <a class="btn btn-primary pull-right" href="{{route('createarea')}}">Add New Area</a>
              </div>
      </div><!-- d-flex -->

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">List of Areas</h6>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">Zip Code</th>
                  <th class="wd-15p">Name</th>
                  <th class="wd-15p">Province</th>
                   <th class="wd-15p">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($areas as $area)
                <tr>
                    <td>{{$area->zipcode}}</td>
                    <td>{{$area->name}}</td>
                    <td>{{$area->province}}</td>
                    <td><button type="submit" class="btn btn-success" onclick="getarea('{{$area->id}}')">Edit</button></td>
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

    function getarea(id){
      window.location.href = '{{route ("editarea", ["id" => ''] )}}'+'/'+id
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
