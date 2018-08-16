@extends('layouts.app')

@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="./index.html">Home</a>
          <a class="breadcrumb-item" href="{{route('leaves')}}">Positions</a>
          <span class="breadcrumb-item active">Leave Application</span>
        </nav>
      </div><!-- br-pageheader -->


      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-10">Edit Leave Application</h6>
       
    <form action="{{route('updateleave')}}" method="POST" enctype="multipart/form-data" data-parsley-validate="">
       <input type="hidden" name="_token" value="{{ csrf_token() }}">
       <input type="hidden" id="custId" name="id" value="{{$leave['id']}}">
        <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-12 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Employee: <span class="tx-danger">*</span></label>
                    <select class="form-control select2" style="width: 100%;" name="employeeid">
                      @foreach($employees as $employee)
                            <option value="{{$employee->id}}" 
                              {{ ( $employee->id == $leave['employee_id'] ) ? 'selected' : '' }}>{{$employee->id_no.'-'.$employee->first_name.', '.$employee->last_name}}</option>
                        @endforeach
                  </select>
                </div>
              </div>
              <div id="leaves" class="col-md-12 mg-t--1 mg-md-t-0">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group mg-md-l--1">
                  <table>
                    <thead>
                        <th class="wd-15p">Total Leaves</th>
                        <th class="wd-15p">Consumed Leaves</th>
                        <th class="wd-15p">Leaves Left</th>
                    </thead>
                    <tbody>
                      <tr><td id="tl"></td>
                          <td id="cl"></td>
                          <td id="ll"></td></tr>
                    </tbody>
                  </table>
                </div>
                  </div>
                 
                </div>
                
              </div>
              <div class="col-md-6 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Date of Application: <span class="tx-danger">*</span></label>
                    <input type="text" name="applydate" value="{{$leave['date_applied']}}" class="form-control fc-datepicker" id="dateemployed" placeholder="MM/DD/YYYY">
                </div>
              </div><!-- col-4 -->
             <div class="col-md-6 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Date Range: <span class="tx-danger">*</span></label>
                  <input type="text" class="form-control"  value="{{$leave['date_start'].'-'.$leave['date_end']}}" id="daterange" name="daterange" />
                </div>
              </div>
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Type of Leave: <span class="tx-danger">*</span></label>
                    <select class="form-control select2" style="width: 100%;" name="leavetypeid">
                        @foreach($leavetypes as $leavetype)
                              <option value="{{$leavetype->id}}" 
                              {{ ( $leavetype->id == $leave['leavetype_id'] ) ? 'selected' : '' }}>{{$leavetype->name}}</option>
                        @endforeach
                    </select>
                </div>
              </div>
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Reason: <span class="tx-danger">*</span></label>
                   <input type="text" name="reason" value="{{$leave['reason']}}" class="form-control" id="inputEmail3" placeholder="Reason" required="">
                </div>
              </div>
               <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  
                  <label class="form-control-label">File Attachment: <span class="tx-danger">*</span></label>
                  <div class="row">
                    <div class="col-md-6"><input id="pic" type="file" class="form-control" name="pic"></div>
                    <div class="col-md-6"><a class="btn btn-secondary" href="{{ asset('files').'/'.$leave['file_attachment']}}">Download</a></div>
                  </div>
                     
                </div>
              </div>
            </div><!-- row -->
            <div class="form-layout-footer bd pd-20 bd-t-0 ">
              <button type="submit" class="btn btn-info">Submit</button>
               <a class="btn btn-secondary" href="{{route('leaves')}}">Cancel</a>
            </div><!-- form-group -->
          </div>
        </form>
      </div>
  </div>

   
  <!-- /.box-header -->
            <!-- form start -->
            
          <script>
     function datediff (start, end){
    var startDate = Date.parse(start);
            var endDate = Date.parse(end);
            var timeDiff = endDate - startDate;
            daysDiff = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
            return daysDiff+1;
  }
$(document).ready(function(){
  $( "#leaves" ).hide();
  $( "#warning" ).hide();
$('#emp').change(function() {

        $.get("{{route('getleave')}}",
        {
          _token: document.getElementById('token').value,
          id: $('#emp').val(),
        },
        function(data,status){
          var sum = 0;
          data.forEach(function(key, value){
                sum += datediff(key.date_start, key.date_end);
                
              });
          console.log(sum)
          $( "#leaves" ).show();
          $('#tl').html(5);
          $('#cl').html(sum);
          $('#ll').html(5-sum);
          $('#daysleft').val(5-sum);
          if(sum == 5){
             $(':input[type="submit"]').prop('disabled', true);
              $('#message').text('Sorry!');
              swal("Sorry!", "You have consumed all your leaves", "error");
          }
          else{
            $( "#warning" ).hide();
            $(':input[type="submit"]').prop('disabled', false);
          }
         
        });
   });
});  
</script>
<script type="text/javascript">
   $(document).ready(function(){
       $('.fc-datepicker').datepicker({
              showOtherMonths: true,
              selectOtherMonths: true,
              changeYear: true,
              yearRange: "-0: -10",
            
            });
   });
   $(function() {

  $('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });

  $('#daterange').on('apply.daterangepicker', function(ev, picker) {
      var daysleft = $('#daysleft').val();
      if(datediff(picker.startDate, picker.endDate) > daysleft){
       $('#daterange').data('daterangepicker').setStartDate(picker.startDate);
       $('#daterange').data('daterangepicker').setEndDate(picker.startDate);
        swal("Sorry!", "You are only allowed to leave for "+daysleft+" day(s)", "error");

      }
      else{

      }
  });
});


</script>
@endsection

