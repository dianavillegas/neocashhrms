@extends('layouts.app')

@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="./index.html">Home</a>
          <a class="breadcrumb-item" href="{{route('positions')}}">Positions</a>
          <span class="breadcrumb-item active">Add Position</span>
        </nav>
      </div><!-- br-pageheader -->


      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-10">Add New Position</h6>
       
    <form action="{{route('submitposition')}}" method="POST" data-parsley-validate="">
       <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-12 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Name: <span class="tx-danger">*</span></label>
                 <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="Name of Position" required="">
                </div>
              </div>
              <div class="col-md-12 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Description: <span class="tx-danger">*</span></label>
                 <input type="text" name="description" class="form-control" id="inputEmail3" placeholder="Description" required="">
                </div>
              </div><!-- col-4 -->
             <div class="col-md-6 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Department: <span class="tx-danger">*</span></label>
                <select class="form-control select2" style="width: 100%;" name="deptid">
                   @foreach($departments as $department)
                            <option value="{{$department->id}}">{{$department->name}}</option>
                        @endforeach
                      </select>
                </div>
              </div>
              <div class="col-md-6 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Rate: <span class="tx-danger">*</span></label>
                 <input type="text" name="rate" class="form-control" id="inputEmail3" placeholder="Description" required="">
                </div>
              </div><!-- col-4 -->
            </div><!-- row -->
            <div class="form-layout-footer bd pd-20 bd-t-0 ">
              <button type="submit" class="btn btn-info">Submit</button>
               <a class="btn btn-secondary" href="{{route('positions')}}">Cancel</a>
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

