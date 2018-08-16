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
       <div class="col-md-6"></div>
        <div class="col-md-2">
           <a href="./modal.html" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-toggle="modal" data-target="#modaldemo1">Import Excel</a>

        </div>
        <div class="col-md-1">
                <a class="btn btn-primary pull-right" href="{{route('createarea')}}">Add New Contribution</a>
              </div>
      </div><!-- d-flex -->

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">List of Contributions</h6>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">ID No.</th>
                  <th class="wd-15p">Name</th>
                  <th class="wd-15p">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($contributions as $contribution)
                  <tr>
                      <td>{{$contribution->id}}</td>
                      <td>{{$contribution->name}}</td>
                      <td><button class="btn btn-primary" onclick="getcon('{{$contribution->id}}')" type="button">View</button></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div><!-- table-wrapper -->
</div>
<div id="modaldemo1" class="modal fade">
  <div class="modal-dialog modal-dialog-vertical-center  modal-lg" role="document">
    <div class="modal-content bd-0 tx-14">
      <div class="modal-header pd-y-20 pd-x-25">
        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Import Excel File</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pd-25">
        <form action="{{route('importcon')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="row wd-800">
          <div class="col-md-4">
            <h5 class="">Select Contribution</h5>
          </div>
          <div class="col-md-4">
            <div class="form-group mg-md-l--1">
               <select class="form-control" style="width: 100%;" name="contributionid">
                  @foreach($contributions as $contribution)
                            <option value="{{$contribution->id}}">{{$contribution->name}}</option>
                        @endforeach
                      </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            {{ csrf_field() }}
          <div class="row">
            <div class="col-md-8"><input type="file" name="import_file" /></div>
          </div>
          </div>
        </div>
        <p class="mg-b-5"></p>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Import File</button>
        <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>
      </div>

          </form>
    </div>
  </div><!-- modal-dialog -->
</div>
          <script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>

    function getcon(id){
      window.location.href = '{{route ("editcontribution", ["id" => ''] )}}'+'/'+id
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
