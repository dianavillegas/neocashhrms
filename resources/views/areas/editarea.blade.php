@extends('layouts.app')

@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="./index.html">Home</a>
          <a class="breadcrumb-item" href="{{route('branches')}}">Branches</a>
          <span class="breadcrumb-item active">Edit Branch</span>
        </nav>
      </div><!-- br-pageheader -->


      <div class="br-pagebody">
       
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-10">Edit Branch</h6>
    <form action="{{route('updateprovince')}}" method="POST" data-parsley-validate="">
       <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="custId" name="id" value="{{$province->id}}">
        <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              
              <div class="col-md-12">
                <div class="form-group">
                  <label class="form-control-label">Zip Code: <span class="tx-danger">*</span></label>
                 <input type="text" name="iso" value="{{$province->iso}}" class="form-control" id="inputEmail3" placeholder="ISO Number of Province" required="">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-12 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Name: <span class="tx-danger">*</span></label>
                 <input type="text" name="name" value="{{$province->name}}" class="form-control" id="inputEmail3" placeholder="Name of Province" required="">
                </div>
              </div>
               <div class="col-md-12">
                <div class="form-group">
                  <label class="form-control-label">Province: <span class="tx-danger">*</span></label>
               <select class="form-control select2" style="width: 100%;" name="deptid">
                   @foreach($provinces as $province)
                            <option value="{{$province->id}}" 
                              {{ ( $province->id == $area->province_id ) ? 'selected' : '' }}>{{ $province->name }}</option>
                        @endforeach
                      </select>
                  </div>
                </div><!-- col-4 -->
             
            </div><!-- row -->
            <div class="form-layout-footer bd pd-20 bd-t-0">
              <button type="submit" class="btn btn-info">Submit</button>
               <a class="btn btn-secondary" href="{{route('provinces')}}">Cancel</a>
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
  
</script>
@endsection

