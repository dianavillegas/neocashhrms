@extends('layouts.app')

@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="./index.html">Home</a>
          <a class="breadcrumb-item" href="{{route('holidays')}}">Holidays</a>
          <span class="breadcrumb-item active">Edit Holiday</span>
        </nav>
      </div><!-- br-pageheader -->


      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-10">Add New Holiday</h6>
       
    <form action="{{route('updateholiday')}}" method="POST" data-parsley-validate="">
       <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="custId" name="id" value="{{$holiday->id}}">
        <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label">Name: <span class="tx-danger">*</span></label>
                 <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="Name of Department" required="" value="{{$holiday->name}}">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-6 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Date: <span class="tx-danger">*</span></label>
                 <input type="text" name="date" class="form-control fc-datepicker" id="dateemployed" placeholder="MM/DD/YYYY" value="{{$holiday->date}}">
                </div>
              </div>
               <div class="col-md-6 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Holiday Type: <span class="tx-danger">*</span></label>
                 <select class="form-control select2" style="width: 100%;" name="holidaytypeid">
                        @foreach($holidaytypes as $holidaytype)
                          <option value="{{$holidaytype->id}}" 
                              {{ ( $holidaytype->id == $holiday->holidaytype_id ) ? 'selected' : '' }}>{{ $holidaytype->name }}</option>
                        @endforeach
                    </select>
                </div>
              </div>
               <div class="col-md-6 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Level: <span class="tx-danger">*</span></label>
                 <select class="form-control select2" id="level" style="width: 100%;" name="level">
                       <option value="NATIONAL" {{ ( $holiday->scope == "NATIONAL" ) ? 'selected' : '' }}>NATIONAL</option>
                       <option value="REGIONAL" {{ ( $holiday->scope == "REGIONAL" ) ? 'selected' : '' }}>REGIONAL</option>
                       <option value="PROVINCIAL" {{ ( $holiday->scope == "PROVINCIAL" ) ? 'selected' : '' }}>PROVINCIAL</option>
                       <option value="LOCAL" {{ ( $holiday->scope == "LOCAL" ) ? 'selected' : '' }}>LOCAL</option>
                  </select>
                   <div id="area" class="">
                     <label class="form-control-label">Area: <span class="tx-danger">*</span></label>
                 
                      <input type="text" name="area" class="form-control" id="inputEmail3" placeholder="Area set for the holiday" value="{{$holiday->area}}" required="">
                 
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

