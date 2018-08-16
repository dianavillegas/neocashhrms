@extends('layouts.app')

@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="./index.html">Home</a>
          <a class="breadcrumb-item" href="{{route('positions')}}">Positions</a>
          <span class="breadcrumb-item active">Loan Application</span>
        </nav>
      </div><!-- br-pageheader -->


      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-10">Add New Loan Application</h6>
       
    <form action="{{route('updateloan')}}" method="POST" enctype="multipart/form-data" data-parsley-validate="">
       <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
       <input type="hidden" name="id" id="id" value="{{ $loan['id'] }}">
       <input type="hidden" name="daysleft" id="daysleft">
        <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-7 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Employee: <span class="tx-danger">*</span></label>
                    <select class="form-control select2-show-search" id="emp" style="width: 100%;" name="employeeid">
                      @foreach($employees as $employee)
                        <option value="{{$employee->id}}" {{ ( $employee->id == $loan['employee_id'] ) ? 'selected' : '' }}>{{$employee->last_name.', '.$employee->first_name.' - '.$employee->id_no}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <!-- col-4 -->
              <div class="col-md-5 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Type of Loan: <span class="tx-danger">*</span></label>
                    <select class="form-control select2" style="width: 100%;" name="loantypeid">
                        @foreach($loantypes as $loantype)
                          <option value="{{$loantype->id}}" {{ ( $employee->id == $loan['loantype_id'] ) ? 'selected' : '' }}>{{$loantype->name}}</option>
                        @endforeach
                    </select>
                </div>
              </div>
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">No. of Terms: <span class="tx-danger">*</span></label>
                   <input type="text" name="terms" class="form-control" id="inputEmail3" placeholder="No. of terms payable" required="" value="{{$loan['terms_payable']}}">
                </div>
              </div>
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Amount: <span class="tx-danger">*</span></label>
                   <input type="text" name="amount" class="form-control" id="inputEmail3" placeholder="Amount of Loan" required="" value="{{$loan['amount']}}">
                </div>
              </div>
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Reason: <span class="tx-danger">*</span></label>
                   <input type="text" name="reason" class="form-control" id="inputEmail3" placeholder="Reason For Loan" required="" value="{{$loan['reason']}}">
                </div>
              </div>
             
            </div><!-- row -->
            <div class="form-layout-footer bd pd-20 bd-t-0 ">
              <button type="submit" class="btn btn-info">Submit</button>
               <a class="btn btn-secondary" href="{{route('loans')}}">Cancel</a>
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
  var date = new Date();
   var newdate = new Date(date);

    newdate.setDate(newdate.getDate() + 3);
    
    var dd = newdate.getDate();
    var mm = newdate.getMonth() + 1;
    var y = newdate.getFullYear();
   $('#daterange').data('daterangepicker').setStartDate(date);
   $('#daterange').data('daterangepicker').setEndDate(mm+'/'+dd+'/'+y);
  
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

