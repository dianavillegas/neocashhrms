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
                Employee:
              </div><!-- col-4 -->
              <div class="col-7 col-sm-8">
                <select class="form-control select2-show-search" id="emp" style="width: 100%;" name="employeeid">
                      @foreach($employees as $employee)
                        <option value="{{$employee->id}}">{{$employee->last_name.', '.$employee->first_name.' - '.$employee->id_no}}</option>
                      @endforeach
                  </select>
              </div><!-- col-8 -->
            </div><!-- row -->
            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
                For the Month of:
              </div><!-- col-4 -->
              <div class="col-7 col-sm-4">
                <input type="text" name="summarydate" class="monthPicker" id="dateemployed" placeholder="MM/DD/YYYY">
              </div>
              <div class="col-7 col-sm-4">
               <button class="btn btn-primary" type="button" onclick="show()">Submit</button>
              </div><!-- col-8 -->
            </div><!-- row -->
          </div>
          <!-- form-layout -->
          <div class="row pd-t-40" id="comps">
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
         <div id="buttons" class="d-flex align-items-center justify-content-end ht-md-80 bd pd-x-20 mg-t-10">
            <div class="d-md-flex pd-y-20 pd-md-y-0">
              <button class="btn btn-secondary pd-y-13 pd-x-20 bd-0 mg-md-l-10 mg-t-10 mg-md-t-0 tx-uppercase tx-11 tx-spacing-2">Cancel</button>
              <button class="btn btn-success pd-y-13 pd-x-20 bd-0 mg-md-l-10 mg-t-10 mg-md-t-0 tx-uppercase tx-11 tx-spacing-2">Save</button>
            </div>
          </div>
      </form>
    </div>
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
      $.get("{{route('getemployee')}}",
        {
          _token: document.getElementById('token').value,
          id: $('#emp').val(),
        },
        function(data,status){
          var tech = document.getElementById('tech');
          var behavioral = document.getElementById('behavioral');
           $("#tech tr").remove();
           $("#behavioral tr").remove();
           var t =[];
           var b = [];
          data['pc'].forEach(function(key, value){
                if(key.competencytype_id == 1){
                  var tr = "<tr>"+
                 '<td>'+key.name+'</td>'+
                 
                 '<td><select class="form-control select2" id='+key.name[0]+key.id+' name='+key.name[0]+key.id+' required="" data-placeholder="Choose Browser"></select> </td></tr>';
                 var id = '#'+key.name[0]+key.id; 
                t.push(id);
                tech.innerHTML+=tr;
                }

                if(key.competencytype_id == 2){
                  var tr = "<tr>"+
                 '<td>'+key.name+'</td>'+
                 
                 '<td><select class="form-control select2"  id='+key.name[0]+key.id+' name='+key.name[0]+key.id+' required="" data-placeholder="Choose Browser"></select> </td></tr>';
                  
                  var id = '#'+key.name[0]+key.id;
                  b.push(id);
                behavioral.innerHTML+=tr;
                }
                 
              });

            data['ind'].forEach(function(s, value){
              b.forEach(function(item){
                console.log(item);
                  $(item).append($('<option></option>').attr('value', s.id).text(s.name));
              });
              t.forEach(function(item){
                  $(item).append($('<option></option>').attr('value', s.id).text(s.name));
              });
              
                   
                 });

           $( "#comps" ).slideDown( "slow", function() {
            });
            $( "#buttons" ).slideDown( "slow", function() {
            });
          });
       
      }
  </script>
    @endsection