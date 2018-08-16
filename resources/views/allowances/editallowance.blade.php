@extends('layouts.app')

@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
       <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="./index.html">Home</a>
          <a class="breadcrumb-item" href="{{route('allowancetypes')}}">Allowance Types</a>
          <span class="breadcrumb-item active">Add Allowance Type</span>
        </nav>
      </div><!-- br-pageheader -->


      <div class="br-pagebody">
       
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-10">Edit Allowance Type</h6>
    <form action="{{route('updateallowancetype')}}" method="POST" data-parsley-validate="">
       <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="custId" name="id" value="{{$allowancetype->id}}">
        <div class="form-layout form-layout-2">
            <div class="row no-gutters"><!-- col-4 -->
              <div class="col-md-10 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Name: <span class="tx-danger">*</span></label>
                 <input type="text" name="name" value="{{$allowancetype->name}}" class="form-control" id="inputEmail3" placeholder="Name of Allowance" required="">
                </div>
              </div>
               <div class="col-md-2">
                <div class="form-group mg-md-l--1">
                  <button type="button" class="btn btn-info" onclick="show()">Set Rate</button>
                </div>
              </div><!-- col-4 -->
             
            </div><!-- row --><!-- form-group -->
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
                    <th class="wd-15p">Position</th>
                    <th class="wd-15p">Entitled</th>
                    <th class="wd-15p">Rate</th>
                  </tr>
                </thead>
                 <tbody id="tech">
                   @foreach($data as $da)
                      <tr>
                        <td>{{$da['name']}}</td>
                        <td><input type="checkbox" class="m_switch_check" value="{{$da['status']}}" ></td>
                        <td><input class="form-control {{$da['status']}}" id="{{$da['name']}}" name="{{$da['name']}}" value="{{$da['rate']}}" required  pattern="^[0-9]*\.[0-9]{2}$" data-parsley-pattern-message="Invalid input" placeholder="Rate" type="text"></td>
                      </tr>
                    @endforeach  
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

   
  <!-- /.box-header -->
            <!-- form start -->
            
          <script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>
<script type="text/javascript">
$(document).ready(function(){
  $('#rates').hide();

  
});

function show(){
  $( "#rates" ).slideDown( "slow", function() {
            });
}

$(document).ready(function(){
  $(".0").prop('readonly', true);
     $(".m_switch_check:checkbox").mSwitch({
                onRender:function(elem){
                    if (elem.val() == 0){
                      
                        $.mSwitch.turnOff(elem);
                     }else{
                      
                         $.mSwitch.turnOn(elem);
                    }
                },
                onRendered:function(elem){
                   
                },
                onTurnOn:function(elem){
                  var id = elem.closest("td").next().find("input").attr('id');
                
                     if (elem.val() == "0"){
                    
                      elem.closest("td").next().find("input").removeAttr('readonly');
                       elem.val("1");
                        console.log('Enable')
                      
                    }else{
                      
                    }
                },
                onTurnOff:function(elem){
                  var id = elem.closest("td").next().find("input").attr('id');
                      if (elem.val() == 1){
                        elem.closest("td").next().find("input").prop('readonly', true);
                        elem.closest("td").next().find("input").val('0.00');
                        
                        elem.val("0");
                        console.log('Disable')
                     }else{
                        }
                }
            });
 
            
        });
</script>
@endsection

