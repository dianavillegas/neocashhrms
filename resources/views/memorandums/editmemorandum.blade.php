@extends('layouts.app')
@section('content')
<div class="d-sm-flex align-items-center pd-t-15 pd-sm-t-15 pd-x-20 pd-sm-x-30">
        <i class="icon icon ion-ios-people tx-50 lh-0 tx-gray-800"></i>
        <div class="pd-sm-l-20 mg-t-10 mg-sm-t-0">
          <h4 class="tx-gray-800 mg-b-5">Memorandums</h4>
        </div>
        <div class="col-md-4">
          
        </div>
        <div class="col-md-4">
          
        </div>
        <div class="col-md-1 tx-white">
                <a id="btnedit" class="btn btn-success pull-right tx-white">Edit Memorandum</a>
              </div>
      </div><!-- d-flex -->
<div class="br-pagebody">
<form action="{{route('updatememo')}}" method="POST">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-10">Edit Memorandum</h6>
          <div id="wizard2">
             <h3>Edit Memorandum</h3>
                <section>
            {{ csrf_field() }}
             <input type="hidden" name="_token" id="token" value="{{csrf_token()}}"/>

               <input type="hidden" name="id" id="id" value="{{$editmemoid['id']}}"/>

            <div class="row">
              <div class="col-md-4">
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Date: <span class="tx-danger">*</span></label>
               <div class="wd-200 mg-b-30">
            <div class="input-group">
              <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
              <input type="text" id="memodate" value="{{$editmemoid->dates}}" name="memodate" class="form-control fc-datepicker" placeholder="MM/DD/YYYY" />
            </div>
          </div><!-- wd-200 -->
              </div><!-- form-group -->
               <div class="form-group wd-xs-300">
                <label class="form-control-label">Memorandum Type: <span class="tx-danger">*</span></label>
               <div class="wd-200 mg-b-30">
            <div class="input-group">
             <select id="memotypecmb" name="memotypecmb" class="form-control">
                 @foreach($list as $var)
                   <option value="{{$var->id}}">{{$var->memotype}}</option>   
                @endforeach
              </select>
            </div>
          </div><!-- wd-200 -->
              </div><!-- form-group -->
              <div class="form-group wd-xs-300">
                <label class="form-control-label">Subject: <span class="tx-danger">*</span></label>
               <textarea id="subjecttext" name="subjecttext" value="" class="form-control wd-xs-350 ht-100" placeholder="Input Subject">{{$editmemoid['subject']}}</textarea>
              </div><!-- form-group -->
            </div>
             <div class="col-md-5">
                <div class="form-group wd-xs-750">
                <label class="form-control-label">Description: <span class="tx-danger">*</span></label>
               <textarea id="description" name="description" value="" class="form-control ht-300" placeholder="Input Description">{{$editmemoid['description']}}</textarea>
              </div><!-- form-group -->
             </div>
           </div>
          <div class="col-lg-3 mg-t-40 mg-lg-t-0">
              <label class="custom-file">
                <input class="custom-file-input" id="attachment" name="attachment" type="file">
                <span class="custom-file-control custom-file-control-inverse"></span>
              </label>
            </div>
            </section>
              <h3>Edit Branch</h3>
              <section>
      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">List of Branches</h6>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-5p">ID No</th>
                  <th class="wd-5p">Branch</th>
                  <th class="wd-5p">Action</th>
                </tr>
              </thead>
              <tbody>
                   @foreach($branch as $branches)
                <tr>
                     <td>{{$branches->id}}</td>
                     <td>{{$branches->name}}</td>
                     <td class="vcenter"><input value="{{$branches->id}}" class="checkmark cbid" type="checkbox"/></td>
                </tr>
                   @endforeach
              </tbody>
            </table>
          </div><!-- table-wrapper -->
            </div>
            </div>
              </section>
               <h3>Edit Recipients</h3>
              <section>
             <div class="br-pagebody">
                    <div class="br-section-wrapper">
                      <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">List of Employees</h6>
                      <div class="table-wrapper">
                        <table id="datatable2" class="table display responsive nowrap">
                          <thead>
                            <tr>
                               <th class="wd-5p">No</th>
                              <th class="wd-5p">ID No</th>
                              <th class="wd-5p">First Name</th>
                              <th class="wd-5p">Last Name</th>
                               <th class="wd-5p">Position</th>
                                <th class="wd-5p">Department</th>
                                  <th class="wd-5p">Action</th>
                            </tr>
                          </thead>
                          <tbody id="tbody">
                          </tbody>
                        </table>
                      </div><!-- table-wrapper -->
                      </div>
                      </div>
              </section>
          </div>
        </div>
</form>
      </div>

<script>
   $(document).ready(function(){
        var array = [];
        var array1 = [];

        $('#memodate').datepicker({
          showOtherMonths: true,
          selectOtherMonths: true
        });

    $( "#memodate" ).prop( "disabled", true );
    $( "#memotypecmb" ).prop( "disabled", true );
    $( "#subjecttext" ).prop( "disabled", true );
    $( "#description" ).prop( "disabled", true );
    $( "#attachment" ).prop( "disabled", true );

        $( "#btnedit" ).click(function() {
         $( "#memodate" ).prop( "disabled", false );
          $( "#memotypecmb" ).prop( "disabled", false );
          $( "#subjecttext" ).prop( "disabled", false );
          $( "#description" ).prop( "disabled", false );
          $( "#attachment" ).prop( "disabled", false );
        });
 
  $('#datatable1').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
          }
        });
        $('#wizard2').steps({
          headerTag: 'h3',
          bodyTag: 'section',
          autoFocus: true,
          titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
          onStepChanging: function (event, currentIndex, newIndex) {
            if(currentIndex < newIndex) {
              // Step 1 form validation
              if(currentIndex === 0) {
                var memodate = $('#memodate').parsley();
                var subjecttext = $('#subjecttext').parsley();
                var description = $('#description').parsley();
                if(memodate.isValid() && subjecttext.isValid() && description.isValid()) {
                  return true;
                } else {
                  memodate.validate();
                  subjecttext.validate();
                  description.validate();
                }
              }
              // Step 2 form validation
              if(currentIndex === 1){
                  return true;
              }
            // Always allow step back to the previous step even if the current step is not valid.
            }
             else { return true; }
          },
           onFinished: function (event, currentIndex)
            {
             /* $.post("{{route('updatememo')}}",
                 {
               _token: $('#token').val(),
              id: $('#id').val(),
              subject : $('#subjecttext').val(),
              dates: $('#memodate').val(),
              memotype: $('#memotypecmb').val(),
              description: $('#description').val(),
              attachment: $('#attachment').val(),
                    array1: array1
                   },
          function(data, status){
            console.log(data);
                  });*/

                    $('form').submit();

               }
        });
        //table ni sya hehe
  $(document).on('change','.cbid', function(){
                if($(this).is(":checked")) {
                        array = [];
                        array.push($(this).val())
                        $('#tbody tr').remove();
                        $.get("{{route('getemployeeseditmemo')}}",
                        {
                            _token:document.getElementById('token').value,
                            array: array
                        },
                        function(data,status){
            data.forEach(function(key){
            var tbody = document.getElementById('tbody');
            var tr = "<tr>"+
            '<td>'+key.No+'</td>'+
            '<td>'+key.ID_No+'</td>'+
            '<td>'+key.first_name+'</td>'+
            '<td>'+key.last_name+'</td>'+
            '<td>'+key.Position+'</td>'+
            '<td>'+key.Department+'</td>'+
            '<td class="vcenter"><input value="'+key.No+'" class="cbid1" name="recipients[]" type="checkbox"/></td>';
            tbody.innerHTML +=tr;
          })
                        })
                }
              });
   });
</script>



@endsection
      