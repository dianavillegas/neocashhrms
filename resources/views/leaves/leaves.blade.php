@extends('layouts.app')

@section('content')

   <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="./index.html">Home</a>
          <span class="breadcrumb-item active">Positions</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="d-sm-flex align-items-center pd-t-15 pd-sm-t-25 pd-x-20 pd-sm-x-30">
        <i class="fas fa-user-circle tx-60 lh-0 tx-gray-800"></i>
        <div class="pd-sm-l-20 mg-t-10 mg-sm-t-0">
          <h4 class="tx-gray-800 mg-b-5">List of Leaves</h4>
        </div>
        <div class="col-md-7"></div>
        <div class="col-md-1">
                <a class="btn btn-primary pull-right" href="{{route('createposition')}}">Add New Leave</a>
              </div>
      </div><!-- d-flex -->
  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">List of Leave Applications</h6>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">ID No</th>
                  <th class="wd-15p">Employee</th>
                  <th class="wd-15p">Leave Type</th>
                  <th class="wd-15p">Date Applied</th>
                  <th class="wd-15p">Date Range</th>
                  <th class="wd-15p">Status</th>
                  <th class="wd-15p">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($leaves as $leave)
                <tr>
                    <td>{{$leave->id}}</td>
                    <td>{{$leave->first_name.' '.$leave->last_name}}</td>
                    <td>{{$leave->name}}</td>
                    <td>{{$leave->date_applied}}</td>
                    <td>{{$leave->date_start.'-'.$leave->date_end}}</td>
                    <td>{{$leave->status}}</td>
                    <td><div class="btn-group">
                      <button type="button"  data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-warning btn-flat" data-id="{{ $leave->id }}" onclick="edit({{$leave->id}})"><i class="icon ion-edit"></i></button>
                      <button type="button" data-id="{{ $leave->id }}" class="approve btn btn-success btn-flat" ><i class="icon ion-checkmark"></i></button>
                    </div></td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div><!-- table-wrapper -->
</div>
      <div id="loadMe" class="modal fade" data-effect="effect-just-me">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content bd-0 tx-14">
                <div class="modal-header pd-x-20">
                  <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">PLEASE WAIT..</h6>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body pd-20">
                  <div class="sk-rotating-plane bg-gray-800"></div>
                    <p class="mg-b-5">LOADING..</p><!-- d-flex -->
                 
                </div>
              </div>
            </div><!-- modal-dialog -->
          </div>
          <script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>

    function edit(id){
      window.location.href = '{{route ("editleave", ["id" => ''] )}}'+'/'+id
    }

    $(document).on('click', '.approve', function() {
          $("#loadMe").modal({
          backdrop: "static", //remove ability to close modal with click
          keyboard: false, //remove option to close with keyboard
          show: true //Display loader!
        });
        $.post("{{route('approveleave')}}",
        {
          _token: document.getElementById('token').value,
          id: $(this).data('id'),
        },
        function(data,status){
          $("#loadMe").modal("hide");
            location.reload();
          });
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
</script>
@endsection
