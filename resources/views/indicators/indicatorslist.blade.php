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
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-10">Competencies Per Position</h6>
       
    
       <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
  
        <div class="row">
          @foreach($departments as $department)
          <div class="col-md-6 mg-b-20">
            <div class="card bd-0">
              <div class="card-header bg-primary tx-white">
                {{$department['name']}}
              </div><!-- card-header -->
              <div class="card-body bd bd-t-0 rounded-bottom">
               <table class="table display responsive nowrap">
                 <thead>
                <tr>
                  <th class="wd-15p">ID No</th>
                  <th class="wd-15p">Name</th>
                  <th class="wd-15p">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($positions as $position)
                @if($position['department_id'] == $department['id'])
                <tr>
                    <td>{{$position['id']}}</td>
                    <td>{{$position['name']}}</td>
                    <td><button class="btn btn-info btn-icon"  onclick="edit({{$position['id']}})">
                        <div><i class="icon ion-more"></i></div>
                      </button></td>
                </tr>
                @endif
              @endforeach
               </table>
              </div><!-- card-body -->
            </div>
          </div>
          @endforeach
        </div>
        <div class="d-flex align-items-center justify-content-end ht-md-80 bd pd-x-20 mg-t-10">
            <div class="d-md-flex pd-y-20 pd-md-y-0">
              <button class="btn btn-secondary pd-y-13 pd-x-20 bd-0 mg-md-l-10 mg-t-10 mg-md-t-0 tx-uppercase tx-11 tx-spacing-2">Cancel</button>
              <button class="btn btn-success pd-y-13 pd-x-20 bd-0 mg-md-l-10 mg-t-10 mg-md-t-0 tx-uppercase tx-11 tx-spacing-2">Save</button>
            </div>
          </div>
      
      </div>
  </div>

   <div id="modaldemo3" class="modal fade">
            <div class="modal-dialog modal-lg wd-1000" role="document">
              <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                  <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Competencies</h6>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body pd-20">
                 <div class="row">
                  <div class="col-md-6">
                    <div class="card bd-0">
                      <div class="card-header bg-primary tx-white">
                        Technical Competencies
                      </div><!-- card-header -->
                      <div class="card-body bd bd-t-0 rounded-bottom">
                       <table class="table display responsive nowrap">
                        <thead>
                          <th class="wd-15p">ID No</th>
                          <th class="wd-15p">Name</th>
                        </thead>
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
                       <table>
                         <tbody id="behavioral">
                           
                         </tbody>
                       </table>
                      </div><!-- card-body -->
                    </div>
                  </div>
                </div>
                </div><!-- modal-body -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary tx-size-xs" id="edit">Edit</button>
                  <button type="button" class="btn btn-secondary tx-size-xs" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div><!-- modal-dialog -->
          </div>
  <!-- /.box-header -->
            <!-- form start -->
            
          <script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>
<script type="text/javascript">
  function edit(id){
    window.location.href = '{{route ("editlist", ["id" => ''] )}}'+'/'+id
  }
  function getlist(id){
    $("#edit").click(function(){ 
      window.location.href = '{{route ("editlist", ["id" => ''] )}}'+'/'+id
    });
    $.get("{{route('getlist')}}",
            {
              _token: document.getElementById('token').value,
              id: id,
            },
            function(data,status){
              
              var tbody = document.getElementById('tech');
               $("#tech tr").remove();
              data.forEach(function(key, value){
                 var tr = "<tr>"+
                 '<td>'+key.id+'</td>'+
                 '<td>'+key.name+'</td>';
                tbody.innerHTML+=tr;
              });
             
            });
  }
  $(function(){
   

  });
</script>
@endsection

