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
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-10">Assessment Records</h6>
       
       <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="form-layout form-layout-7">
            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
                Employee:
              </div><!-- col-4 -->
              <div class="col-7 col-sm-6">
                <select class="form-control select2-show-search" id="emp" style="width: 100%;" name="employeeid">
                      @foreach($employees as $employee)
                        <option value="{{$employee->id}}">{{$employee->id_no.' - '.$employee->last_name.', '.$employee->first_name}}</option>
                      @endforeach
                  </select>
              </div>
              <div class="col-7 col-sm-2">
               <button class="btn btn-primary" type="button" onclick="show()">Submit</button>
              </div><!-- col-8 -->
            </div><!-- row -->
            <!-- row -->
          </div>
          <!-- form-layout -->
          <div class="row pd-t-40" id="comps">
            <table class="table display responsive nowrap">
             <thead>
                <tr>
                  <th class="wd-15p">ID No</th>
                  <th class="wd-15p">Employee</th>
                  <th class="wd-15p">Evaluated By</th>
                  <th class="wd-15p">For the Month of</th>
                  <th class="wd-15p">Action</th>
                </tr>
              </thead>
                 <tbody id="assessment">
                 
                 </tbody>
               </table>
          </div>
     
    </div>
  </div>
<div id="modaldemo3" class="modal fade">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                  <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold" id="title"></h6>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body pd-20">
                     <h6 class=" lh-3 mg-b-20" id="month"></h6>
                 <div class="row">
                   <div class="col-md-2"><p class="tx-14">Evaluated By:</p></div>
                   <div class="col-md-4"><p class="tx-14" id="evl"></p></div>
                   <div class="col-md-3"><p class="tx-14">Date of Evaluation</p></div>
                   <div class="col-md-3"><p class="tx-14" id="date"></p></div>
                 </div>
                  <div class="row pd-t-30 mg-b-5" id="comps">
                    <div class="col-md-6">
                      <div class="card bd-0">
                        <div class="card-header bg-primary tx-white">
                          Technical Competencies
                        </div><!-- card-header -->
                        <div class="card-body bd bd-t-0 rounded-bottom">
                         <table class="table display responsive nowrap">
                           <tbody id="tech">
                            
                            
                           </tbody>
                         </table>
                        </div><!-- card-body -->
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="card bd-0">
                        <div class="card-header bg-primary tx-white">
                          Behavioral Competencies
                        </div><!-- card-header -->
                        <div class="card-body bd bd-t-0 rounded-bottom">
                         <table class="table display responsive nowrap">
                           <tbody id="behavioral">
                             
                           </tbody>
                         </table>
                        </div><!-- card-body -->
                      </div>
                    </div>
                  </div>
                </div><!-- modal-body -->
                <div class="modal-footer">
                   <button type="button" class="btn btn-secondary tx-size-xs" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div><!-- modal-dialog -->
          </div>

  <script type="text/javascript">
     $(document).ready(function(){
      $('#buttons').hide();
      $('#comps').hide();
  
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
     function show(){
       $( "#comps" ).slideUp( "slow", function() {
            });
        $( "#buttons" ).slideUp( "slow", function() {
            });
      $.get("{{route('getempcom')}}",
        {
          _token: document.getElementById('token').value,
          id: $('#emp').val(),
        },
        function(data,status){
          var tbody = document.getElementById('assessment');
          $("#assessment tr").remove();
          data.forEach(function(key, value){
               var arr = key.summary_date.split("-");
            var months = [ "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December" ];
             var tr = "<tr>"+
             '<td>'+key.id+'</td>'+
             '<td>'+key.emp_last+', '+key.emp_first+' '+key.emp_mid+'</td>'+
             '<td>'+key.evl+', '+key.evf+' '+key.evm+'</td>'+
             '<td>'+months[parseInt(arr[1]-1,10)]+'</td>'+
             '<td><button type="submit" type="button" class="btn btn-info" data-target="#modaldemo3" data-toggle="modal" data-month='+key.summary_date+' onclick="getid('+key.id+',\''+key.evl+', '+key.evf+' '+key.evm+'\')">View</button></td></tr>';
            tbody.innerHTML+=tr;
          });
          
           $( "#comps" ).slideDown( "slow", function() {
            });
            $( "#buttons" ).slideDown( "slow", function() {
            });
          });
       
      }
      function getid(id,name){
        $.get("{{route('getcom')}}",
        {
          _token: document.getElementById('token').value,
          id: id,
        },
        function(data,status){
          $('#title').text('Assessment Record #'+id)
          $('#evl').text(name);

          var tech = document.getElementById('tech');
          var behavioral = document.getElementById('behavioral');
           $("#tech tr").remove();
           $("#behavioral tr").remove();
          data.forEach(function(key, value){
            $('#date').text(key.created_at)
            var arr = key.summary_date.split("-");
            var months = [ "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December" ];
           
            $('#month').text('For the Month of '+months[parseInt(arr[1]-1,10)])
             if(key.competencytype_id == 1){
               var tr = "<tr>"+
               '<td>'+key.comp+'</td>'+
               '<td>'+key.ind+'</td>';
              tech.innerHTML+=tr;
            }
            if(key.competencytype_id == 2){
               var tr = "<tr>"+
               '<td>'+key.comp+'</td>'+
               '<td>'+key.ind+'</td>';;
              behavioral.innerHTML+=tr;
            }

          });
          
          });
      }
  </script>
    @endsection