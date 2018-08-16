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
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-10">Add New Department</h6>
       
    <form action="{{route('submitdept')}}" method="POST" data-parsley-validate="">
       <input type="hidden" name="_token" value="{{ csrf_token() }}">
       <input type="hidden" name="id" value="{{$contribution->id}}">
        <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-10">
                <div class="form-group">
                  <label class="form-control-label">Name: <span class="tx-danger">*</span></label>
                 <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="Name of Department" required="" value="{{$contribution->name}}">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <button type="btn btn-info" type="button">Set Rate</button>
                </div>
              </div><!-- col-4 -->
            </div><!-- row -->
            <!-- form-group -->
          </div>
          <div class="row pd-t-20" id="rates">
          <div class="col-md-12">
            <div class="card bd-0">
              <div class="card-header bg-primary tx-white">
                Rate per Position
              </div><!-- card-header -->
              <div class="card-body bd bd-t-0 rounded-bottom">
               <table class="table">
                <thead>
                  <tr>
                    <th class="wd-15p">Rate From</th>
                    <th class="wd-15p">Rate To</th>
                    <th class="wd-15p">EE</th>
                    <th class="wd-15p">ER</th>
                    <th class="wd-15p">Total</th>
                  </tr>
                </thead>
                 <tbody id="tech">
                   @foreach($conr as $cr)
                      <tr>
                        <th class="wd-15p">{{$cr->rate_from}}</th>
                        <th class="wd-15p">{{$cr->rate_to}}</th>
                        <th class="wd-15p">{{$cr->ee}}</th>
                        <th class="wd-15p">{{$cr->er}}</th>
                        <th class="wd-15p">{{$cr->total}}</th>
                      </tr>
                   @endforeach
                 </tbody>
               </table>
              </div><!-- card-body -->
            </div>
          </div>
        </div>
        <div class="form-layout-footer bd pd-20 bd-t-0">
              <button type="submit" class="btn btn-info">Submit</button>
               <a class="btn btn-secondary" href="{{route('branches')}}">Cancel</a>
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

