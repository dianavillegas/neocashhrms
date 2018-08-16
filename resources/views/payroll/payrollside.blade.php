@extends('layouts.app')

@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{route('dashboard')}}">Home</a>
          <span class="breadcrumb-item active">Add Indicator</span>
        </nav>
      </div><!-- br-pageheader -->


      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-10">Payroll Details</h6>
       
    <form action="{{route('submitempcom')}}" method="POST" data-parsley-validate="">
       <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
         
          <div class="row">
            <div class="col-lg-3" id="emps">
              <input class="search ht-40" placeholder="Search" />
                <button class="sort btn btn-primary" type="button" data-sort="name">
                  Sort by name
                </button>
                <div class="list-group pd-t-15">
                <ul class="list">
                <li class="list-group-item pd-y-15 pd-x-20 l--40 d-xs-flex align-items-center ">
                 <div class="mg-xs-l-15 mg-t-10 mg-xs-t-0 mg-r-auto">
                    <p class="mg-b-0 tx-inverse tx-medium name">Marilyn Tarter</p>
                    <span class="d-block tx-13 born">Clemson, CA</span>
                  </div>
                </li>
                <li class="list-group-item pd-y-15 pd-x-20 l--40 d-xs-flex align-items-center justify-content-start">
                 <div class="mg-xs-l-15 mg-t-10 mg-xs-t-0 mg-r-auto">
                    <p class="mg-b-0 tx-inverse tx-medium name">asdasdas Tarter</p>
                    <span class="d-block tx-13 born">asdasdasd, CA</span>
                  </div>
                </li>
              </ul>
              </div>
            </div>
          <div class="col-lg-6 bd-l" id="comps">
            <h5 class="tx-uppercase bd-b mg-b-30">Period of</h5>
            <h5 class="tx-semilight tx-success bd-b mg-b-0">Earnings</h5>
            <table class="table table-bordered tx-dark tx-semilight">
              <tr class="bd-b">
                <td class="wd-15p">Gross Pay</td>
                <td class="wd-5p">10000</td>
              </tr>
              <tr class="bd-b">
                <td class="wd-15p">Gross Pay</td>
                <td class="wd-5p">10000</td>
              </tr>
            </table>
          </div>
          <div class="col-lg-3 bd-l" id="comps">
            
            
          </div>
         </div>
      </form>
    </div>
  </div>
   <script type="text/javascript">
     $(document).ready(function(){
        var options = {
  valueNames: [ 'name', 'born' ]
};

var userList = new List('emps', options);
     });
   </script>

  @endsection