 
<!--   <div class="br-header d-flex align-items-center mg-t-0">
<h4 class="mg-b-0 tx-uppercase tx-bold tx-20 pd-r-20 tx-inverse tx-poppins mg-r-0">Neocash Lending Inc.</h4>
<ul class="nav nav-effect nav-effect-7 tx-uppercase tx-bold tx-spacing-2 flex-column flex-sm-row " role="tablist">
  <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#" role="tab">Home</a></li>
  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#" role="tab">Employees</a></li>
  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#" role="tab">Services</a></li>
  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#" role="tab">Blog</a></li>
  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#" role="tab">Contact</a></li>
</ul>
 -->
 <div class="navbar bg-dark">
   <a class="navbar-brand tx-bold tx-uppercase tx-white" href="#">Neocash Lending Inc.</a>
 </div>
<nav class="navbar navbar-expand-lg navbar-light bg-white ">
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse align-items-center justify-content-center" id="navbarNavAltMarkup">
    <div class="navbar-nav">
     <ul class="nav nav-effect nav-effect-7 tx-uppercase tx-light tx-spacing-2 flex-column flex-md-row" role="tablist">
      <li class="nav-item"><a class="nav-link active"  href="#" role="tab">Dashboard</a></li>
      <li class="nav-item"><a class="nav-link"  href="{{route('employees')}}" role="tab">Employees</a></li>
      <li class="nav-item"><a class="nav-link"  href="{{route('employees')}}" role="tab">Payroll</a></li>
      <li class="nav-item"><a class="nav-link"   href="" role="tab">Assessment</a></li>
      <li class="nav-item"><a class="nav-link" onclick="show()" role="tab">Libraries</a></li>
    </ul>
    </div>
  </div>
</nav>
<div class="bd-y bd-gray-500 bg-light" id="employeroptions">
  <button type="button" class="close" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <div class="ht-md-60 wd-200 wd-md-auto pd-y-20 pd-md-y-0 d-md-flex align-items-center justify-content-center" >
      <ul class="nav nav-effect nav-effect-5 tx-uppercase tx-bold tx-spacing-2 flex-column flex-md-row" role="tablist">
        <li class="nav-item"><a href="{{route('branches')}}" class="nav-link">Branches</a></li>
    <li class="nav-item"><a href="{{route('departments')}}"" class="nav-link">Departments</a></li>
    <li class="nav-item"><a href="{{route('positions')}}"" class="nav-link">Positions</a></li>
    <li class="nav-item"><a href="{{route('provinces')}}"" class="nav-link">Provinces</a></li>
     <li class="nav-item"><a href="{{route('areas')}}"" class="nav-link">Areas</a></li>

      </ul>
    </div>
    </div>

    

    
      <!-- <div class="br-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href="#"><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href="#"><i class="icon ion-navicon-round"></i></a></div>input-group
      </div> --><!-- br-header-left -->

      <!-- br-header-right -->
    </div><!-- br-header -->

    <script type="text/javascript">
       $(document).ready(function(){
       $('#employeroptions').hide();
     });

      function show(){
        $( "#employeroptions" ).slideDown( "slow", function() {
            });
      }
     $(document).on('click', ".close", function(){
         $( "#employeroptions" ).slideUp( "slow", function() {
            });
   });

    </script>