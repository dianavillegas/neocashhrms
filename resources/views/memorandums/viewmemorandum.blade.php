@extends('layouts.app')
@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
  <nav class="breadcrumb pd-0 mg-0 tx-12">
    <a class="breadcrumb-item" href="./index.html">Home</a>
    <a class="breadcrumb-item" >Memorandum List</a>
    <span class="breadcrumb-item active">Create Memorandum</span>
  </nav>
</div><!-- br-pageheader -->
 <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">List of Memorandums</h6>
 <div class="row">
  <!-- First row -->
  <div class="col-12 col-sm-12 col-md-3 col-lg-2">
   <!-- Left column (First row) -->
   <a href="{{route('creatememo')}}" class="btn btn-success btn-block">
    <i class="fa fa-edit"></i> Compose
   </a>
  </div>
 </div>
 <!-- END: first row -->
 <hr>
 <div class="row">
  <!-- Sencond row -->
  <div class="col-12 col-sm-12 col-md-3 col-lg-2">
   <!-- LEFT COLUMN Menu (Sencond row) -->
   <ul class="list-group">
    <!-- Menu -->
     <a class="btn btn-primary btn-block">
    <li class="fa fa-edit">
    </li>
     Edit Memo
  </a>
    <li class="list-group-item justify-content-between">
     Drafts
     <span class="badge badge-default badge-pill">2</span>
    </li>
   </ul>
   <!-- End left menu -->
  </div>
  <!-- END: Left column (Second row) -->
  <div class="col-12 col-sm-12 col-md-9 col-lg-10">
   <!-- Tabs -->
   <ul class="nav nav-tabs">
    <li class="nav-item">
     <a class="nav-link active" href="#"><i class="fa fa-inbox"></i>&nbsp;&nbsp;Inbox</a>
    </li>
    <li class="nav-item">
     <a class="nav-link" href="#"><i class="fa fa-tags"></i>&nbsp;&nbsp;Notifications</a>
    </li>
   </ul>
   <!-- END: Tabs -->
   <div class="list-group">
      @foreach($rawquery as $memo)
    <li class="list-group-item d-flex justify-content-start" onclick="getemployee('{{$memo->id}}')">
     <div class="checkbox">
      <input type="checkbox" class="chk">
     </div>
     &nbsp;&nbsp;<span class="fa fa-star-o">{{$memo->id}}</span>&nbsp;&nbsp;
     <span class="name fullname">{{$memo->subject}}</span>
     <span class="">{{$memo->description.'...'}}</span>
     <span class="ml-auto p-2">
            <span class="fa fa-paperclip"></span>
     <span class="badge badge-secondary">{{$memo->datecreated}}</span>
     </span>
    </li>
    @endforeach
   </div>
  </div>
 <!-- END: Second row -->
          </div>
        </div>
  </div>
<script>
  function getemployee(id){
      window.location.href = '{{route ("editmemo", ["id" => ''] )}}'+'/'+id
    }

$(document).ready(function(){
window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>

        $('input.chk').on('change', function() {
            $('input.chk').not(this).prop('checked', false);  
              });

});
</script>
@endsection