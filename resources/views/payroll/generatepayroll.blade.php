@extends('layouts.app')

@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="./index.html">Home</a>
          <a class="breadcrumb-item" href="{{route('branches')}}">Indicators</a>
          <span class="breadcrumb-item active">Add Indicator</span>
        </nav>
      </div><!-- br-pageheader -->


      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-10">Set Indicators</h6>
       
    <form action="{{route('submitempcom')}}" method="POST" data-parsley-validate="">
       <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="form-layout form-layout-7">
            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
                Branch:
              </div><!-- col-4 -->
              <div class="col-7 col-sm-4">
                <select class="form-control select2-show-search" id="emp" style="width: 100%;" name="employeeid">
                      @foreach($branches as $branch)
                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                      @endforeach
                  </select>
              </div>
              <!-- col-8 -->
            </div><!-- row -->
            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
                For the Period of:
              </div><!-- col-4 -->
              <div class="col-7 col-sm-4">
                 <div class="form-group mg-md-l--1">
                 <input type="text" class="form-control" id="daterange" name="daterange"  />
               </div>
              </div>
              <div class="col-7 col-sm-4">
               <button class="btn btn-primary" type="button" onclick="show()">Submit</button>
              </div><!-- col-8 -->
            </div><!-- row -->
          </div>
          <!-- form-layout -->
          <div class="row pd-t-40" id="comps">
            <div class="col-md-12">
              <div class="card bd-0">
                <div class="card-header bg-primary tx-white">
                  List of Employees
                </div><!-- card-header -->
                <div class="card-body bd bd-t-0 rounded-bottom">
                 <table class="table display responsive nowrap" id="employees">
                  <thead>
                    <tr>
                      <th class="wd-5p"></th>
                      <th class="wd-15p">ID No</th>
                      <th class="wd-15p">Last Name</th>
                      <th class="wd-15p">First Name</th>
                      <th class="wd-15p">Middle Name</th>
                      <th class="wd-15p">Position</th>
                    </tr>
                  </thead>
                   
                 </table>
                </div><!-- card-body -->
              </div>
            </div>
          </div>
         
      </form>
    </div>
  </div>
   <script type="text/javascript">
     $(document).ready(function(){
      $('#buttons').hide();
       $('#comps').hide();

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
  
        $(".monthPicker").datepicker({ 
          dateFormat: 'mm-yy',
          changeMonth: true,
            changeYear: true,
            showButtonPanel: true,

          onClose: function(dateText, inst) {  
                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val(); 
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val(); 
                $(this).datepicker('setDate', new Date(year, month, 1)); 
            }
      });
  
        $(".monthPicker").focus(function () {
          $(".ui-datepicker-calendar").hide();
          $("#ui-datepicker-div").position({
              my: "center top",
              at: "center bottom",
              of: $(this)
            });
          
        });



        
     });
     $('#comps').ready(function(){

     });
    function show(){
       $.get("{{route('employeelist')}}",
        {
          _token: document.getElementById('token').value,
          id: $('#emp').val(),
        },
        function(data,status){
          var tbody = document.getElementById('employees');
          data.forEach(function(key, value){
                
                  var tr = "<tr>"+
                  '<td><button type="button" class="btn btn-primary view">View</button></td>'+
                 '<td>'+key.id_no+'</td>'+
                 '<td>'+key.last_name+'</td>'+
                 '<td>'+key.first_name+'</td>'+
                 '<td>'+key.middle_name+'</td>'+
                 '<td>'+key.position_id+'</td>';
                 
                tbody.innerHTML+=tr;

        });
          
           $( "#comps" ).slideDown( "slow", function() {
            });
           var table = $('#employees').DataTable({
          responsive: true,
          "bSearchable":true,
                "bFilter": true,
        });
      
        table.rows().every( function () {
            this.child( 'Row details for row: '+this.index() );
        } );
         
        $('#employees tbody').on( 'click', '.view', function () {
            var child = table.row( $(this).parents('tr') ).child;
            console.log(table.row( $(this).parents('tr') ).index())
            var data = table.row(table.row( this ).index()).data();
            var array = [];
            console.log(data);
            if ( child.isShown() ) {
                child.hide();
            }
            else {
              var array;
              /* $.get("{{route('getpayrolldata')}}",
                {
                  _token: document.getElementById('token').value,
                  id: data[1],
                },
                function(data,status){
                  data.forEach(function(key, value){
                    array.push({name:key.name});
                  });
                });
                console.log(array);
                child(format(array, data[1])).show();*/
            }
        } );
           
    });
  }

 

  function format (array, id) {
    console.log(array);
     var tbody = document.getElementById(id);
    array.forEach(function(key, value){
      $(id+" tr").remove();
             var tr = "<tr>"+
             '<td>'+key.name+'</td>'+
             '<td><input class="form-control" placeholder="" type="text"></td></tr>';
            tbody.innerHTML+=tr;
    });
    var table = '<table class="table responsive wd-95p">'+
        '<tr>'+
            '<td >Number of Days Present:</td>'+
            '<td >'+'<input class="form-control" placeholder="" type="text">'+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Absences:</td>'+
            '<td>'+'<input class="form-control" placeholder="" type="text">'+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Lates:</td>'+
            '<td>'+'<input class="form-control" placeholder="" type="text">'+'</td>'+
        '</tr>'+
    '</table>';
    var newdiv = '<div class="row">'+
                '<div class="col-md-5">'+
                  '<div class="card bd-0">'+
                    '<div class="card-header bg-success tx-white style="padding-left:20px;""> '+"Earnings"+
                     
                    '</div>'+
                    '<div class="card-body bd bd-t-0 rounded-bottom">'+
                      '<table class="datatable table display">'+
                       '<tbody id='+id+'></tbody></table>'+
                    '</div>'+
                  '</div>'+
                '</div>'+
               '<div class="col-md-6">'+
                  '<div class="card bd-0">'+
                    '<div class="card-header bg-danger tx-white style="padding-left:20px;""> '+"Deductions"+
                     
                    '</div>'+
                    '<div class="card-body bd bd-t-0 rounded-bottom">'+
                    
                    '</div>'+
                  '</div>'+
                '</div>'+
            '</div>';
    return table+newdiv;
}
 
   </script>

  @endsection