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
       
    <form action="{{route('submitset')}}" method="POST" data-parsley-validate="">
       <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <input type="hidden" name="positionid" value="{{$position_id}}">
       <div class="form-layout form-layout-7 mg-b-40">
          <div class="row no-gutters">
            <div class="col-3 col-sm-2">
               Designation:
            </div><!-- col-4 -->
            <div class="col-5 col-sm-4">
              <select class="form-control select2" disabled="" required="" name="positionid" data-placeholder="Select Designation">
                @foreach($positions as $position)
                <option value="{{$position->id}}" {{ ( $position->id == $position_id ) ? 'selected' : '' }}>{{$position->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-4 col-sm-2">
              Set competencies same with:
            </div>
            <div class="col-4 col-sm-4">
              <select class="form-control select2"  required="" id="setting" data-placeholder="Select Designation">
                <option value="-1">Select Setting</option>
                @foreach($ps as $p)
                <option value="{{$p->id}}">{{$p->name}}</option>
                @endforeach
              </select>
            </div>
            <!-- col-8 -->
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card bd-0">
              <div class="card-header bg-primary tx-white">
                Technical Competencies
              </div><!-- card-header -->
              <div class="card-body bd bd-t-0 rounded-bottom">
               <table class="table display responsive nowrap">
                 <tbody id="tech">
                  
                    @foreach($pc as $p)
                      @if($p->competencytype_id == 1)
                          @if($p->status == 1)
                          <tr>
                            <td>{{$p->name}}</td>
                            <td><select class="form-control select2" name="{{$p->name[0].$p->id}}" required="" data-placeholder="Choose Browser">
                                <option value="Yes" selected>Yes</option>
                                <option value="No">No</option>
                            </select>  
                              </td>  
                          </tr>
                          @else
                          <tr>
                            <td>{{$p->name}}</td>
                            <td><select class="form-control select2" name="{{$p->name[0].$p->id}}" id="{{$p->name[0].$p->id}}" required="" data-placeholder="Choose Browser">
                                <option value="Yes">Yes</option>
                                <option value="No" selected="">No</option>
                            </select>  
                              </td>  
                          </tr>
                          @endif
                      @endif
                      @endforeach
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
                    @foreach($pc as $p)
                      @if($p->competencytype_id == 2)
                          @if($p->status == 1)
                          <tr>
                            <td>{{$p->name}}</td>
                            <td><select class="form-control select2" name="{{$p->name[0].$p->id}}" id="{{$p->name[0].$p->id}}" required="" data-placeholder="Choose Browser">
                                <option value="Yes" selected>Yes</option>
                                <option value="No">No</option>
                            </select>  
                              </td>  
                          </tr>
                          @else
                          <tr>
                            <td>{{$p->name}}</td>
                            <td><select class="form-control select2" name="{{$p->name[0].$p->id}}" id="{{$p->name[0].$p->id}}" required="" data-placeholder="Choose Browser">
                                <option value="Yes">Yes</option>
                                <option value="No" selected="">No</option>
                            </select>  
                              </td>  
                          </tr>
                          @endif
                      @endif
                      @endforeach
                 </tbody>
               </table>
              </div><!-- card-body -->
            </div>
          </div>
        </div>
        <div class="d-flex align-items-center justify-content-end ht-md-80 bd pd-x-20 mg-t-10">
            <div class="d-md-flex pd-y-20 pd-md-y-0">
              <button class="btn btn-secondary pd-y-13 pd-x-20 bd-0 mg-md-l-10 mg-t-10 mg-md-t-0 tx-uppercase tx-11 tx-spacing-2">Cancel</button>
              <button class="btn btn-success pd-y-13 pd-x-20 bd-0 mg-md-l-10 mg-t-10 mg-md-t-0 tx-uppercase tx-11 tx-spacing-2">Save</button>
            </div>
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
  $(function(){
   $("#setting").change(function(){
    console.log('ok');
    console.log($(this).val());
        $.get("{{route('getlist')}}",
            {
              _token: document.getElementById('token').value,
              id: $(this).val(),
            },
            function(data,status){
              data.forEach(function(key, value){
                console.log(data);
                $("#"+key.name[0]+key.id).val("Yes").change();
              });
             
            });
   });

  });
</script>
@endsection

