@extends('layouts.app')

@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="./index.html">Home</a>
          <span class="breadcrumb-item active">Holidays</span>
        </nav>
      </div><!-- br-pageheader -->

 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="month" id="month" >
 <div class="d-sm-flex align-items-center pd-t-15 pd-sm-t-25 pd-x-20 pd-sm-x-30">
        <i class="fas fa-user-circle tx-60 lh-0 tx-gray-800"></i>
        <div class="pd-sm-l-20 mg-t-10 mg-sm-t-0">
          <h4 class="tx-gray-800 mg-b-5">List of Holidays</h4>
        </div>
        <div class="col-md-7"></div>
        <div class="col-md-1">
                <a class="btn btn-primary pull-right" href="{{route('createholiday')}}">Add New Holiday</a>
              </div>
      </div>
  <div class="br-pagebody">
    <div class="br-section-wrapper">
      <div class="row"> 
          <div class="col-sm-4 col-lg-3 mg-t-30 mg-lg-t-0">
            <div class="input-group">
               <span class="input-group-addon"><i class="icon ion-person tx-16 lh-0 op-6"></i></span>
              <select class="form-control select2" id="years" data-placeholder="Choose Browser">
                <option value="-1">Select Year</option>
              </select>
              <br/>
            </div>
              <div class="bg-br-primary pd-30">
                <ul class="nav nav-effect nav-effect-4 flex-column" id="list" role="tablist">
                 
                 
                </ul>
              </div><!-- ht-65 -->
            </div>
     
        <div class="col-md-8" >
          <div class="tab-content" id="months">
           
            <!-- tab-pane -->
      <!-- tab-pane -->
          </div> 
        </div>
      </div>
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
       var selectBox = document.getElementById('years');
        // loop through years
         var newdate = new Date();
        for (var i = newdate.getFullYear(); i >= 2000; i--) {
            // create option element
            var option = document.createElement('option');
            // add value and text name
            option.value = i;
            option.innerHTML = i;
            // add the option element to the selectbox
            selectBox.appendChild(option);
        }
        $('#years').change(function() {
            $.get("{{route('getholiday')}}",
            {
              _token: document.getElementById('token').value,
              month: $('#month').val(),
              year: $('#years').val(),
            },
            function(data,status){
              var tbody = document.getElementById('tbody'+ $('#month').val());
               $("#tbody"+ $('#month').val()+" tr").remove();
              data.forEach(function(key, value){
                 var tr = "<tr>"+
                 '<td>'+key.id+'</td>'+
                 '<td>'+key.name+'</td>'+
                 '<td>'+key.date+'</td>'+
                 '<td>'+key.type+'</td>'+
                 '<td>'+key.scope+'</td>'+
                 '<td><button type="submit" class="btn btn-success" onclick="getid('+key.id+')">Edit</button></td></td></tr>';
                tbody.innerHTML+=tr;
              });
             
            });
        });
     });
  $(document).on('click', '.nav-link', function() {
      var id = $(this).attr('id');
      $('#month').val(id);
        $.get("{{route('getholiday')}}",
        {
          _token: document.getElementById('token').value,
          month: $(this).attr('id'),
          year: $('#years').val(),
        },
        function(data,status){
          var tbody = document.getElementById('tbody'+id);
          data.forEach(function(key, value){
             $("#tbody"+id+" tr").remove();
             var tr = "<tr>"+
             '<td>'+key.id+'</td>'+
             '<td>'+key.name+'</td>'+
             '<td>'+key.date+'</td>'+
             '<td>'+key.type+'</td>'+
             '<td>'+key.scope+'</td>'+
             '<td><button type="submit" class="btn btn-success" onclick="getid('+key.id+')">Edit</button></td></tr>';
            tbody.innerHTML+=tr;
          });
         
        });
       });

    $(function(){
        'use strict';

        $('.nav-effect .nav-item').on('click', function () {
          var navItem = $(this).parent().find('.nav-item');
           
          var thisItem = $(this);
          navItem.each(function(){
            $(this).removeClass('current');
          });
          thisItem.addClass('cusrrent');
         
        });
      
         
          
    
        var months = ['January','February','March', 'April', 'May', 'June', 'July', 'August', 'September','October', 'November', 'December'];
        var colors =['mantle','reef','transfile','success','info','emerald','mojito','dance','teal-love','crystal-clear','grandeur','flickr','royal','firewatch'];
        for(var a =0; a<months.length; a++){
          var b = a+1;
          var li = '<li class="nav-item mg-x-0-force"><a class="nav-link pd-y-12 tx-left-force"'+'data-toggle="tab" href=#'+b+' role="tab"  id='+months[a]+'>'+months[a]+'</a></li>';
          var newdiv =  '<div class="tab-pane fade" id='+b+'>'+
              '<div class="row">'+
               '<div class="col-md-12">'+
                  '<div class="card bd-0">'+
                    '<div class="card-header bg-'+colors[a]+' tx-white"> '+months[a]+
                     
                    '</div>'+
                    '<div class="card-body bd bd-t-0 rounded-bottom">'+
                     '<table class="datatable table display">'+
                     '<thead>'+
                        '<tr>'+
                          '<th class="wd-15p">ID No</th>'+
                          '<th class="wd-15p">Name</th>'+
                          '<th class="wd-15p">Date</th>'+
                          '<th class="wd-15p">Type</th>'+
                          '<th class="wd-15p">Level</th>'+
                          '<th class="wd-15p">Action</th>'+
                        '</tr> </thead>'+
                        '<tbody id=tbody'+months[a]+'></tbody></table>'+
                    '</div>'+
                  '</div>'+
                '</div>'+
              '</div>'+
            '</div>';
            $('#months').append(newdiv);
            $('#list').append(li);
        } 
        
         $('.datatable1').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
          }
        });

      });

</script>
<script>
    function getid(id){
       window.location.href = '{{route ("editholiday", ["id" => ''] )}}'+'/'+id
    }
    </script>
@endsection

