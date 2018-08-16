@extends('layouts.app')

@section('content')

   <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="./index.html">Home</a>
          <span class="breadcrumb-item active">Employees</span>
        </nav>
      </div>

      <div class="d-sm-flex align-items-center pd-y-20 pd-x-30 bg-gray-200">
        <i class="icon ion-ios-home-outline tx-70 lh-0 tx-gray-800"></i>
        <div class="pd-sm-l-20 pd-t-2 mg-t-10 mg-sm-t-0">
          <h4 class="tx-gray-800 mg-b-5">Dashboard</h4>
          <p class="mg-b-0">Do bigger things with Bracket plus, the responsive bootstrap 4 admin template.</p>
        </div>
      </div><!-- br-pageheader -->
      <div class="br-pagebody mg-t-5 pd-x-30">
        <div class="row row-sm">
          <div class="col-sm-6 col-xl-3">
            <div class="bg-info rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                <i class="ion ion-earth tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-12 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">EMPLOYEES</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">{{$employees_count}}</p>
                </div>
              </div>
              <div id="ch1" class="ht-50 tr-y-1"></div>
            </div>
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
            <div class="bg-purple rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                <i class="ion ion-bag tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">DEPARTMENTS</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">{{$departments_count}}</p>
                </div>
              </div>
              <div id="ch3" class="ht-50 tr-y-1"></div>
            </div>
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="bg-teal rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                <i class="ion ion-monitor tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">POSITIONS</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">{{$positions_count}}</p>
                </div>
              </div>
              <div id="ch2" class="ht-50 tr-y-1"></div>
            </div>
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="bg-primary rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                <i class="ion ion-clock tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">BRANCHES</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">{{$branches_count}}</p>
                </div>
              </div>
              <div id="ch4" class="ht-50 tr-y-1"></div>
            </div>
          </div><!-- col-3 -->
        </div>
        <div class="row row-sm mg-t-20">
          <div class="col-lg-12">
            <div class="widget-2">
              <div class="card shadow-base overflow-hidden">
                <div class="card-header">
                  <h6 class="card-title">Employee Statistics</h6>
                </div><!-- card-header -->
                <div class="card-body pd-0 bd-color-gray-lighter">
                    <div class="table-wrapper">
                      <table class="table display responsive nowrap">
                      <thead>
                        <tr>
                          <th class="wd-15p">Branches</th>
                          <th class="wd-15p">Loans Officer</th>
                          <th class="wd-15p">Cashier</th>
                           <th class="wd-15p">CI/Collector</th>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                   </div>
                  </div><!-- row -->
                </div><!-- card-body -->
              </div><!-- card -->
            </div><!-- widget-2 -->
          </div><!-- col-6 -->
        <div class="row row-sm mg-t-20">
          <div class="col-lg-6">
            <div class="card bd-0">
              <div class="card-header bg-emerald tx-white tx-lato tx-bold">
                Incoming Birthdays this Month
              </div><!-- card-header -->
              <div class="card-body bd bd-t-0 rounded-bottom">
                <!-- list-group -->
                <div class="list-group" style="overflow-y:scroll; height: 300px">
                  @foreach($bdays as $bday)
                  <div class="list-group-item pd-y-20 rounded-top-0">
                    <div class="media">
                      <div class="d-flex mg-r-10 wd-50">
                          <i class="fas fa-birthday-cake tx-50" style="color: green"></i>
                      </div><!-- d-flex -->
                      <div class="media-body">
                        <h6 class="tx-inverse tx-uppercase">{{$bday->first_name.' '.$bday->middle_name.' '.$bday->last_name}}</h6>
                        <p class="mg-b-0 tx-semibold tx-success">{{Carbon\Carbon::parse($bday->birthdate)->toFormattedDateString()}}</p>
                        <p class="mg-b-0 tx-gray-600">{{Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse($bday->birthdate)->year(date('Y'))) +1}} days more to go</p>
                      </div><!-- media-body -->
                    </div><!-- media -->
                  </div><!-- list-group-item -->
                  @endforeach
                </div>
              </div><!-- card-body -->
            </div><!-- widget-2 -->
          </div><!-- col-6 -->
        </div>
      <!-- row -->
      </div>

          <script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>

   
 $(function(){
        'use strict';

        $('#datatable1').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
          }
        });

        $('.tx-24').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 2000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
});
   function getemployee(id){
      window.location.href = '{{route ("editemployee", ["id" => ''] )}}'+'/'+id
    }
</script>
<script src=""></script>
@endsection


 
              