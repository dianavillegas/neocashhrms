@extends('layouts.app')

@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
  <nav class="breadcrumb pd-0 mg-0 tx-12">
    <a class="breadcrumb-item" href="./index.html">Home</a>
    <a class="breadcrumb-item" >Employees</a>
    <span class="breadcrumb-item active">Add Employee</span>
  </nav>
</div><!-- br-pageheader -->


<div class="br-pagebody">
  <div class="br-section-wrapper">
    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-10">Add Employee</h6>
      <form action="{{route('submitemployee')}}" enctype="multipart/form-data" method="POST" data-parsley-validate="">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
          <div id="wizard2">
            <h3>Personal Information</h3>
            <section style="background-color: #fff">
             <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-12">
                <div class="form-group mg-md-1--1">
                  <label class="form-control-label">ID No: <span class="tx-danger">*</span></label>
                   <input type="text" name="idno" class="form-control" id="inputEmail3" placeholder="ID No." required="">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">First Name: <span class="tx-danger">*</span></label>
                 <input type="text" name="firstname" class="form-control" id="firstname" placeholder="First Name" required="">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Middle Name: <span class="tx-danger">*</span></label>
                 <input type="text" name="middlename" class="form-control" id="middlename" placeholder="Middle Name" required="">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Last Name: <span class="tx-danger">*</span></label>
                 <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" required="">
                </div>
              </div>
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Birthdate: <span class="tx-danger">*</span></label>
                    <input type="text" name="bdate" class="form-control fc-datepicker" id="bdate" placeholder="MM/DD/YYYY">

                </div>
              </div>
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Age: <span class="tx-danger">*</span></label>
                 <input type="text" readonly class="form-control" name="age" id="age" placeholder="Age" required="">
                </div>
              </div>
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Gender: <span class="tx-danger">*</span></label>
                 <select class="form-control select2" style="width: 100%;" name="gender">
                   <option value="Male">Male</option>
                   <option value="Female">Female</option>
                 </select>
                </div>
              </div>
              <!-- col-4 -->
              <!-- col-4 -->
            </div><!-- row -->
            <!-- form-group -->
          </div>
            </section>
            <h3>Employment Information</h3>
            <section style="background-color: #fff">
              <div class="form-layout form-layout-2">
                <div class="row no-gutters">
                  <div class="col-md-8">
                    <div class="form-group mg-md-1--1">
                      <label class="form-control-label">TIN <span class="tx-danger">*</span></label>
                       <input type="text" name="tin" class="form-control" id="tin" placeholder="Tax Identification Number" required="">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group mg-md-1--1">
                      <label class="form-control-label">Date Employed: <span class="tx-danger">*</span></label>
                       <input type="text" name="dateemployed" class="form-control fc-datepicker" id="dateemployed" placeholder="MM/DD/YYYY">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="form-control-label">Department: <span class="tx-danger">*</span></label>
                        <select class="form-control select2" placeholder="Select Department" id="dept" style="width: 100%;" name="deptid">
                          @foreach($departments as $department)
                            <option value="{{$department->id}}">{{$department->name}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div><!-- col-4 -->
                  <div class="col-md-4 mg-t--1 mg-md-t-0">
                    <div class="form-group mg-md-l--1">
                      <label class="form-control-label">Position: <span class="tx-danger">*</span></label>
                      <select class="form-control select2" id="position" style="width: 100%;" name="positionid">
                         
                      </select>
                    </div>
                  </div><!-- col-4 -->
                  <div class="col-md-4 mg-t--1 mg-md-t-0">
                    <div class="form-group mg-md-l--1">
                      <label class="form-control-label">Branch: <span class="tx-danger">*</span></label>
                        <select class="form-control select2" placeholder="Select Branch" id="dept" style="width: 100%;" name="branchid">
                          @foreach($branches as $branch)
                            <option value="{{$branch->id}}">{{$branch->name}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 mg-t--1 mg-md-t-0">
                    <div class="form-group mg-md-l--1">
                      <label class="form-control-label">SSS Number: <span class="tx-danger">*</span></label>
                         <input type="text" class="form-control" name="sss" id="sss" placeholder="Social Security Number" required="">

                    </div>
                  </div>
                  <div class="col-md-4 mg-t--1 mg-md-t-0">
                    <div class="form-group mg-md-l--1">
                      <label class="form-control-label">Philhealth Number: <span class="tx-danger">*</span></label>
                     <input type="text"  class="form-control" name="philhealth" id="philhealth" placeholder="Philhealth Number" required="">
                    </div>
                  </div>
                  <div class="col-md-4 mg-t--1 mg-md-t-0">
                    <div class="form-group mg-md-l--1">
                      <label class="form-control-label">Pag-ibig Number: <span class="tx-danger">*</span></label>
                     <input type="text"  class="form-control" name="pag-ibig" id="pagibig" placeholder="Pag-ibig Number" required="">
                    </div>
                  </div>
                  <div class="col-md-6 mg-t--1 mg-md-t-0">
                    <div class="form-group mg-md-l--1">
                      <label class="form-control-label">ID Picture: <span class="tx-danger">*</span></label>
                      <input id="pic" type="file" class="form-control" name="pic" onchange="readURL(this);">
                      <img id="idpic" src="http://placehold.it/180" alt="your image" style="max-width: 180px" />

                    </div>
                  </div>
                  <div class="col-md-6 mg-t--1 mg-md-t-0">
                    <div class="form-group mg-md-l--1">
                      <label class="form-control-label">Signature: <span class="tx-danger">*</span></label>
                      <input id="sign" type="file" class="form-control" name="sign" onchange="readURL2(this);">
                      <img id="picsign" src="http://placehold.it/180" alt="your image" style="max-width: 180px" />
                    </div>
                  </div><!-- col-4 -->
                  <!-- col-4 -->
                </div><!-- row -->
                <!-- form-group -->
              </div>
            </section>
            <h3>Contact Details</h3>
            <section style="background-color: #fff">
                <div class="form-layout form-layout-2">
                <div class="row no-gutters">
                  <div class="col-md-12">
                    <div class="form-group mg-md-1--1">
                      <label class="form-control-label">Home Address: <span class="tx-danger">*</span></label>
                       <input type="text" name="localadd" class="form-control" id="inputEmail3" placeholder="Local Address" required="">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="form-control-label">City/Municipality<span class="tx-danger">*</span></label>
                        <select class="form-control select2" placeholder="Select Department" id="area" style="width: 100%;" name="area_id">
                          @foreach($areas as $area)
                            <option value="{{$area->id}}">{{$area->name}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div><!-- col-4 -->
                  <div class="col-md-4 mg-t--1 mg-md-t-0">
                    <div class="form-group mg-md-l--1">
                      <label class="form-control-label">Province: <span class="tx-danger">*</span></label>
                         <select class="form-control select2" placeholder="Select Department" id="dept" style="width: 100%;" name="prov_id">
                          @foreach($provinces as $province)
                            <option value="{{$province->id}}">{{$province->name}}</option>
                          @endforeach
                      </select>
                   
                    </div>
                  </div><!-- col-4 -->
                  <div class="col-md-4 mg-t--1 mg-md-t-0">
                    <div class="form-group mg-md-l--1">
                      <label class="form-control-label">Zip Code: <span class="tx-danger">*</span></label>
                        <input type="text" class="form-control" name="zip" id="zip" placeholder="Zip Code" required="">
                    </div>
                  </div>
                 <!-- col-4 -->
                  <!-- col-4 -->
                </div><!-- row -->
                <!-- form-group -->
              </div>
            </section>
            <h3>Emergency Contact Details</h3>
            <section style="background-color: #fff">
                <div class="form-layout form-layout-2">
                <div class="row no-gutters">
                  <div class="col-md-12">
                    <div class="form-group mg-md-1--1">
                      <label class="form-control-label">Full Name: <span class="tx-danger">*</span></label>
                       <input type="text" name="efname" class="form-control" id="inputEmail3" placeholder="Local Address" required="">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="form-control-label">Contact Number: <span class="tx-danger">*</span></label>
                         <input type="text" name="econtact" class="form-control" id="inputEmail3" placeholder="Local Address" required="">
                    </div>
                  </div><!-- col-4 -->
                  <div class="col-md-8 mg-t--1 mg-md-t-0">
                    <div class="form-group mg-md-l--1">
                      <label class="form-control-label">Full Address: <span class="tx-danger">*</span></label>
                     <input type="text" name="eaddress" class="form-control" id="inputEmail3" placeholder="Local Address" required="">

                    </div>
                  </div><!-- col-4 -->
                  
                 <!-- col-4 -->
                  <!-- col-4 -->
                </div><!-- row -->
                <!-- form-group -->
              </div>
            </section>
          </div>
        </form>
      </div>
  </div>

   
  <!-- /.box-header -->
            <!-- form start -->
            
          <script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>

<script type="text/javascript">
function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#idpic')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
function readURL2(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#idpic')
                  .attr('src', e.target.result);
          };

          reader.readAsDataURL(input.files[0]);
      }
  }
  $(document).ready(function(){
        'use strict';
        
        $('#wizard1').steps({
          headerTag: 'h4',
          bodyTag: 'section',
          autoFocus: true,
          titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>'
        });

       $('#wizard2').steps({
          headerTag: 'h3',
          bodyTag: 'section',
          autoFocus: true,
          transitionEffect: "slideLeft",
          titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
          onStepChanging: function (event, currentIndex, newIndex) {
            if(currentIndex < newIndex) {
              // Step 1 form validation
              if(currentIndex === 0) {
                var fname = $('#firstname').parsley();
                var lname = $('#lastname').parsley();
                var mname = $('#middlename').parsley();
                var bdate = $('#bdate').parsley();
                var age = $('#age').parsley();

                if(fname.isValid() && lname.isValid() && mname.isValid() && bdate.isValid() && age.isValid()) {
                  return true;
                } else {
                  fname.validate();
                  lname.validate();
                  mname.validate();
                  bdate.validate();
                  age.validate();
                }
              }

              // Step 2 form validation
              if(currentIndex === 1) {
                var tin = $('#tin').parsley();
                var sss = $('#sss').parsley();
                var pagibig = $('#pagibig').parsley();
                var philhealth = $('#philhealth').parsley();
                if(tin.isValid() && sss.isValid() && philhealth.isValid() && pagibig.isValid()) {
                  return true;
                } else {
                  tin.validate();
                  sss.validate();
                  philhealth.validate();
                  pagibig.validate();
                }
              }

              if(currentIndex == 2){
                return true;
              }
              if(currentIndex == 3){
                return true;
              }
            // Always allow step back to the previous step even if the current step is not valid.
            } else { return true; }
          },
           onFinished: function (event, currentIndex)
            {
              $('form').submit();
            }
        });
      $('.fc-datepicker').datepicker({
              showOtherMonths: true,
              selectOtherMonths: true,
              changeYear: true,
              yearRange: "-80: -0",
              onSelect: function(dateText, inst) { 
              var date = $(this).datepicker('getDate'),          
                  year =  date.getFullYear();
              var dt = new Date();
              
              $('#age').val(dt.getFullYear()-year);    
                
            }
            });

    $('input').keyup(function(){
      $(this).val($(this).val().toUpperCase());
    }); 
    $('#dept').change(function() {
      console.log($('#dept').val());
        $.get("{{route('getpositions')}}",
        {
          _token: document.getElementById('token').value,
          id: $('#dept').val(),
        },
        function(data,status){
          $('#position').empty();
            for (var row in data) {
                  $('#position').append($('<option></option>').attr('value', data[row].id).text(data[row].name));
                }
          });
        });
    $('#area').change(function() {
        $.get("{{route('getzip')}}",
        {
          _token: document.getElementById('token').value,
          id: $('#area').val(),
        },
        function(data,status){
          $('#position').empty();
            for (var row in data) {
                 $('#zip').val(data[row].zipcode)
                }
          });
        });

      });
</script>
<script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
  <!--   /*
              }*/ -->
@endsection

