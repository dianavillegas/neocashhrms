@extends('layouts.app')

@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{route('dashboard')}}">Home</a>
          <span class="breadcrumb-item active">Add Indicator</span>
        </nav>
      </div><!-- br-pageheader -->


      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-10">Payroll List</h6>
       
    <form action="{{route('submitpayroll')}}" method="POST" data-parsley-validate="">
       <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
         <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-5 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Branch: <span class="tx-danger">*</span></label>
                 <select class="form-control select2-show-search" id="emp" style="width: 100%;" name="employeeid">
                      @foreach($branches as $branch)
                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                      @endforeach
                  </select>
                </div>
              </div><!-- col-4 -->
             <div class="col-md-5 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Period of: <span class="tx-danger">*</span></label>
                <input type="text" class="form-control" id="daterange" name="daterange"  />
                </div>
              </div>
              <div class="col-md-2 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <button type="button" class="btn btn-success submitpr" >Submit</button>
                </div>
              </div>
            </div>
          </div>
          <!-- form-layout -->
          <nav class="navbar navbar-expand-lg navbar-light bg-white ">
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse align-items-center justify-content-center" id="navbarNavAltMarkup">
    <div class="navbar-nav">
     <ul class="nav nav-effect nav-effect-7 tx-uppercase tx-light tx-spacing-2 flex-column flex-md-row" role="tablist">
      <li class="nav-item"><button type="button" class="nav-link btn sub btn-info tx-white" role="tab">Submit Payslips</button></li>
      <li class="nav-item"><button type="button" class="nav-link btn btn-info tx-white" role="tab">Print Payslips</button></li>
      <li class="nav-item"><button type="button" class="nav-link btn btn-info tx-white" role="tab">Email Payslips</button></li>
      <li class="nav-item"><button type="button" class="nav-link btn btn-info tx-white" role="tab">Re-open Payslips</button></li>
      <li class="nav-item"><button type="button" class="nav-link btn btn-info tx-white" role="tab">More</button></li>
    </ul>
    </div>
  </div>
</nav>
          <div class="row pd-t-40 align-items-center" id="comps">
            
            <div class="col-md-12">
              <table class="table table-bordered" id="employees">
                  <thead class="thead-colored thead-dark">
                    <tr>
                      <th></th>
                      <th class="wd-15p">ID No</th>
                      <th class="wd-15p">Last Name</th>
                      <th class="wd-15p">First Name</th>
                      <th class="wd-15p">Gross Pay</th>
                      <th class="wd-15p">Deductions</th>
                      <th class="wd-15p">Net Pay</th>
                      
                    </tr>
                  </thead>
                   
                 </table>
            </div>
          </div>

          <div class="row pd-t-40 align-items-center" id="side">
           
          </div>
         
      </form>
    </div>
  </div>
  .row>.col-md-
   <script type="text/javascript">
     $(document).ready(function(){
      $('#buttons').hide();
       $('#comps').hide();

  /*var theMonths = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
  var btng = document.getElementById('periods');
  var btng2 = document.getElementById('period2');
    for (i=0; i<theMonths.length; i++) {
      var month = theMonths[Math.floor(i)];
      button ="<button type='button' class='btn btn-primary pd-x-30 bd-r-white tx-12 ht-20 pd-t-5'>"+month+' 15'+"</button>";
      btng.innerHTML+=button;
      btn ="<button type='button' class='btn btn-info pd-x-30 bd-r-white tx-12'>"+month+' 30'+"</button>";
      btng2.innerHTML+=btn;
    }*/

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
          console.log(data);
        
              data.forEach(function(key, value){
                    var net = key.gross - key.deductions;
                      var tr = "<tr>"+
                     '<td class="tx-black id">'+key.emp_id+'</td>'+
                     '<td class="tx-black">'+key.last_name+'</td>'+
                     '<td class="tx-black">'+key.first_name+'</td>'+
                     '<td class="tx-black">'+key.gross+'</td>'+
                     '<td class="tx-black">'+key.deductions+'</td>'+
                      '<td class="tx-black">'+net+'</td></tr>';
                     
                    tbody.innerHTML+=tr;
    
         
        });
          
           $( "#comps" ).slideDown( "slow", function() {
            });
         
         
        $('#employees tbody').on( 'click', 'tr', function () {
          var id = $(this).closest("tr").find(".id").text();
             window.location.href = '{{route ("getpayrolldata", ["id" => ''] )}}'+'/'+id
            
        } );
           
    });
  }

  

function insertRow(){
    var id = 1;
      var s = document.getElementById("earns").rows.length;
      id = s;
      var table=document.getElementById("earns");
      var row=table.insertRow(table.rows.length);
      row.id = id;
      var cell1=row.insertCell(0);
      var t1=document.createElement("input");
          t1.id = "ic"+id;
          t1.name = "itemcode"+id;
          t1.classList.add('form-control');
          cell1.appendChild(t1);

      var cell2=row.insertCell(1);
      var t2=document.createElement("input");
          t2.id = "desc"+id;
          t2.name = "description"+id;
          t2.classList.add('form-control');
          cell2.appendChild(t2);
}
 $(function() {
  var liste = [];
      $(document).on("click", ".submitpr", function(){
         var dt = $('#employees').DataTable( {
           "destroy": true,
            "ajax": {
              "url": "{{route('employeelist')}}",
              "type": "GET",
              "dataSrc":"",
              "data": {
                    "_token": document.getElementById('token').value,
                    "id": $('#emp').val(),
                    "daterange": $('#daterange').val()
              }
            },
             "columns": [
                      {
                          "class":          "details-control wd-5p",
                          "orderable":      false,
                          "data":           null,
                          "defaultContent": ""
                      },
                      { "data": "emp_id" },
                      { "data": "last_name" },
                      { "data": "first_name" },
                      { "data": "gross" },
                      { "data": "deductions" },
                      { "data": "net"},
                  ],

            
          });
          var detailRows = [];
       $("#employees").find('tbody').off('click', 'tr td.details-control'); 
          $('#employees tbody').on( 'click', 'tr td.details-control', function () {
              var tr = $(this).closest('tr');
              var row = dt.row( tr );
              var idx = $.inArray( tr.attr('id'), detailRows );
              if ( row.child.isShown() ) {
                  tr.removeClass( 'details' );
                 
                  row.child.hide();
                 
                 $(".amount", row.child()).each(function(){
                    liste.push({
                      "id":row.data().emp_id,
                      "description": $(this).closest('td').prev('.desc2').text(),
                      "amount": $(this).val()
                    })
                     //<-- Should return all input elements in that specific form.
                  });
                  
                  detailRows.splice( idx, 1 );
              }
              else {
               
                  tr.addClass( 'details' );
                  var html ='';
                   $.get("{{route('getpayrolldata')}}",
                    {
                      _token: document.getElementById('token').value,
                      id: row.data().emp_id,
                      daterange: $('#daterange').val()
                    },
                    function(data,status){
                      
                      row.child( format( data, row.data().emp_id )).show();
                       var cell = dt.cell(row, 0,'{ data: "gross" }');
                       var table = document.getElementById('earns')
                       liste.forEach(function(key){
                        if(key.id == row.data().emp_id){
                            $(".add").remove();
                           html += "<tr class='add'>"+
                           '<td class="wd-15p">'+key.description+'</td>'+
                           '<td class="wd-5p"><input class="form-control wd-30p" placeholder="" type="text" value='+key.amount+'></td></tr>';
                           var total = parseFloat($('#earns'+row.data().emp_id+'.totale').text())+ parseFloat(key.amount);

                          $('#earns > tbody > tr').eq(table.rows.length-4).after(html);
                        }
                         
                       });
                       console.log(html);
                      $(row.child()).slideDown();
                    });
                 
       
                  // Add to the 'open' array
                  if ( idx === -1 ) {
                      detailRows.push( tr.attr('id') );
                  }
              }
          } );
         
  
       
          // On each draw, loop over the `detailRows` array and show any child rows
          dt.on( 'draw', function () {
              $.each( detailRows, function ( i, id ) {
                  $('#'+id+' td.details-control').trigger( 'click' );
              } );
          } );
           

           $( "#comps" ).slideDown( "slow", function() {
            });

      });
      $(document).on("click", ".item", function () {
        var s = document.getElementById("earns").rows.length;
        id = s;
        var table=document.getElementById("earns");
        var row=table.insertRow(table.rows.length-3);
        row.id = id;
        var cell1=row.insertCell(0);
       cell1.innerHTML=$(this).text();
       cell1.classList.add('desc2');
            

        var cell2=row.insertCell(1);
        var t2=document.createElement("input");
            t2.id = "desc"+id;
            t2.name = "description"+id;
            t2.classList.add('form-control', 'amount', 'wd-30p');
            cell2.appendChild(t2);

      });

      $(document).on("keyup",".amount",function(){
          var total=0;
             $(".amount").each(function() {
                  total += parseFloat($(this).val());
            });
             
            $('.totale').text(total+parseFloat( $('.totale').text()));
        });

      $('.sub').on('click', function(){
        $('form').submit();
      })
    });
function format (array, id) {
    
     var tr ='';
     var dr ='';
     var totale=0;
     var totaled=0;
     var net = 0;
  array.earns.forEach(function(key){
             tr += "<tr>"+
             '<td class="wd-15p">'+key.name+'</td>'+
             '<td class="wd-5p tamount">'+key.amount+'</td></tr>';
            totale +=key.amount; 
    });
  array.cons.forEach(function(key, value){

             dr += "<tr>"+
             '<td class="wd-15p">'+key.name+'</td>'+
             '<td class="wd-5p">'+key.rate+'</td></tr>';
             totaled += parseFloat(key.rate);
    });
  net = parseFloat(totale)-parseFloat(totaled);
  var table =  '<table class="table table-bordered tx-dark tx-semilight" id="earns">'+
            "<tbody>"+
              tr+
              '<tr class="ht-15"><td colspan="2"><div class="dropdown adddropdown">'+
              '<a href="" class="tx-gray-800 d-inline-block" data-toggle="dropdown">'+
                '<div class="ht-15 tx-12 pd-y-5 pd-x-10 bd d-flex align-items-center justify-content-center">'+
                  '<span class="mg-r-10 tx-13 tx-medium">Add</span>'+
                  '<img src="../img/img7.jpg" class="wd-25 rounded-circle" alt="">'+
                  '<i class="fa fa-angle-down mg-l-10"></i>'+
                '</div></a>'+
  
              '<div class="dropdown-menu pd-10 wd-200">'+
                '<nav class="nav nav-style-1 flex-column">'+
                  '<a class="nav-link item"><i class="icon ion-ios-person"></i>Bonus</a>'+
                  '<a class="nav-link item"><i class="icon ion-ios-gear"></i>Allowance</a>'+
                  '<a class="nav-link item"><i class="icon ion-ios-download"></i>Benefits</a>'+
                '</nav>'+
              '</div>'+
              '</div></td></tr>'+
              "<tr>"+
             '<td class="wd-15p tx-bold tx-uppercase">Total</td>'+
             '<td class="wd-5p totale">'+totale+'</td></tr>'+
             
               '<tr class="pd-t-10"></tr>'+
            '</tbody></table>'+
            '<h5 class="tx-semilight tx-danger bd-b mg-b-0">Deductions</h5>'+
            '<table class="table table-bordered tx-dark tx-semilight" id="earns"'+id+'>'+
             "<tbody>"+
              dr+
              '<tr class="ht-15"><td colspan="2"><div class="dropdown adddropdown">'+
              '<a href="" class="tx-gray-800 d-inline-block" data-toggle="dropdown">'+
                '<div class="ht-15 tx-12 pd-y-5 pd-x-10 bd d-flex align-items-center justify-content-center">'+
                  '<span class="mg-r-10 tx-13 tx-medium">Add</span>'+
                  '<img src="../img/img7.jpg" class="wd-25 rounded-circle" alt="">'+
                  '<i class="fa fa-angle-down mg-l-10"></i>'+
                '</div></a>'+
                '<div class="dropdown-menu pd-10 wd-200">'+
                  '<nav class="nav nav-style-1 flex-column">'+
                    '<a class="nav-link item"><i class="icon ion-ios-person"></i>Bonus</a>'+
                    '<a class="nav-link item"><i class="icon ion-ios-gear"></i>Allowance</a>'+
                    '<a class="nav-link item"><i class="icon ion-ios-download"></i>Benefits</a>'+
                  '</nav>'+
                '</div>'+
              '</div></td></tr>'+
              "<tr>"+
             '<td class="wd-15p tx-bold tx-uppercase">Total</td>'+
             '<td class="wd-5p total">'+totaled+'</td></tr>'+
               '<tr class="pd-t-10"></tr>'+
            '</tbody></table>';
    var tab = '<div class="row">'+
            '<div class="col-lg-2" id="emps">'+
             '<table class="table responsive">'+
        '<tr>'+
            '<td >Number of Days Present:</td>'+
        '</tr>'+
        '<tr>'+
            '<td >'+array.attendance['present']+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Absences:</td>'+
        '</tr>'+
        '<tr>'+
            '<td>'+''+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Lates:</td>'+
        '</tr>'+
        '<tr>'+
            '<td>'+''+'</td>'+
        '</tr>'+
    '</table> </div>'+
                
            
          '<div class="col-lg-6 bd-l" id="comps">'+
            '<h5 class="tx-uppercase bd-b mg-b-30">Period of</h5>'+
            '<h5 class="tx-semilight tx-success bd-b mg-b-0">Earnings</h5>'+
           table+
          '</div>'+
         '<div class="col-lg-3" id="summary">'+
          '<h5 class="tx-uppercase bd-b mg-b-30">Summary</h5>'+
            '<table>'+
             "<tr>"+
             '<td class="wd-5p">Gross Pay</td>'+
             '<td class="wd-5p tamount">'+totale+'</td></tr>'+
              "<tr>"+
             '<td class="wd-5p">Deductions</td>'+
             '<td class="wd-5p tamount">'+totaled+'</td></tr>'+
              "<tr>"+
             '<td class="wd-5p">Net Pay</td>'+
             '<td class="wd-5p tamount">'+net+'</td></tr>'+
            '</table>'+
            '</div>'+
         '</div>';

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
      
    
    return tab;
}
   </script>

  @endsection