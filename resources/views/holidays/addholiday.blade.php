@extends('layouts.app')

@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="./index.html">Home</a>
          <a class="breadcrumb-item" href="{{route('branches')}}">Departments</a>
          <span class="breadcrumb-item active">Add Department</span>
        </nav>
      </div><!-- br-pageheader -->


      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-10">Add New Holiday</h6>
       
    <form action="{{route('submitholiday')}}" method="POST" data-parsley-validate="">
       <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label">Name: <span class="tx-danger">*</span></label>
                 <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="Name of Holiday" required="">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-6 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Date: <span class="tx-danger">*</span></label>
                 <input type="text" name="date" class="form-control fc-datepicker" id="dateemployed" placeholder="MM/DD/YYYY">
                </div>
              </div>
               <div class="col-md-6 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Holiday Type: <span class="tx-danger">*</span></label>
                 <select class="form-control select2" style="width: 100%;" name="holidaytypeid">
                        @foreach($holidaytypes as $holidaytype)
                          <option value="{{$holidaytype->id}}">{{$holidaytype->name}}</option>
                        @endforeach
                    </select>
                </div>
              </div>
               <div class="col-md-6 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Level: <span class="tx-danger">*</span></label>
                 <select class="form-control select2" style="width: 100%;" id="level" name="level">
                       <option value="NATIONAL">NATIONAL</option>
                       <option value="REGIONAL">REGIONAL</option>
                       <option value="PROVINCIAL">PROVINCIAL</option>
                       <option value="LOCAL">LOCAL</option>
                  </select>
                  <div id="area" class="">
                     <label class="form-control-label">Area: <span class="tx-danger">*</span></label>
                      <input type="text" name="area" class="form-control" id="inputEmail3" placeholder="Area set for the holiday" required="">
                  </div>
                </div>

              </div>
              <!-- col-4 -->
             
            </div><!-- row -->
            <div class="form-layout-footer bd pd-20 bd-t-0">
              <button type="submit" class="btn btn-info">Submit</button>
               <a class="btn btn-secondary" href="{{route('branches')}}">Cancel</a>
            </div><!-- form-group -->
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
  $(document).ready(function(){
    $('#area').hide();
       $('.fc-datepicker').datepicker({
              showOtherMonths: true,
              selectOtherMonths: true,
              changeYear: true,
            
            });
       $('#level').change(function(){
          if($('#level').val() != 'NATIONAL'){
              $( "#area" ).show( "slow" );
          }
          else{
             $( "#area" ).hide( "slow" );
          }
       });
     });

</script>
@endsection

