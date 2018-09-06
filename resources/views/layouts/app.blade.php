
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />


    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard." />
    <meta name="author" content="ThemePixels" />

    <title>Neocash Lending Inc.</title>

    <!-- vendor css -->
     <script src="{{asset('js/jquery.min.js')}}"></script>
    <link href="{{asset('bracket/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <link href="{{asset('bracket/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet" />
    <link href="{{asset('bracket/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />

     <link href="{{asset('bracket/lib/jquery-switchbutton/jquery.switchButton.css')}}" rel="stylesheet" />
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <link href="{{asset('bracket/lib/rickshaw/rickshaw.min.css')}}" rel="stylesheet" />
     <link href="{{asset('bracket/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet" />
    <link href="{{asset('bracket/lib/jquery.steps/jquery.steps.css')}}" rel="stylesheet" />
    <link href="{{asset('bracket/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet" />
    
      <link href="{{asset('bracket/lib/highlightjs/github.css')}}" rel="stylesheet" />
    <!-- Bracket CSS -->
    <link href="{{asset('bracket/lib/SpinKit/spinkit.css')}}" rel="stylesheet" />
    <link href="{{asset('css/accordion.css')}}" rel="stylesheet" />
    
    <link href="{{asset('bracket/lib/select2/css/select2.min.css')}}" rel="stylesheet" />
      <link href="{{asset('bracket/lib/jquery-toggles/toggles-full.css')}}" rel="stylesheet" />
   
    <link rel="stylesheet" href="{{asset('bracket/css/bracket.css')}}" />
      <link href="{{asset('toggles/css/jquery.mswitch.css')}}" rel="stylesheet" type="text/css">
    
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">


   <style type="text/css">
     .hidden { display: none; }
        .no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url("{{asset('Preloader_3.gif')}}") center no-repeat #fff;
}
td.details-control {
    background: url('{{asset('images/details_open.png')}}') no-repeat center center;
    background-size: 60px 30px;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('{{asset('images/details_close.png')}}') no-repeat center center;
     background-size: 40px 40px;
}

td.vcenter {
    vertical-align: middle;
}


   </style>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

  <body class="collapsed-menu with-subleft">


  @include('inc.headers')
  <div class="br-mainpanel">
    @include('inc.messages')
    @yield('content')

      <!-- br-pagebody -->
      <footer class="br-footer">
        <div class="footer-left">
          <div class="mg-b-2">Copyright &copy; 2018. DGRV. All Rights Reserved.</div>
        </div>
        <div class="footer-right d-flex align-items-center">
          <span class="tx-uppercase mg-r-10">Share:</span>
          <a target="_blank" class="pd-x-5" href="https://www.facebook.com/sharer/sharer.php?u=http%3A//themepixels.me/bracketplus/intro"><i class="fa fa-facebook tx-20"></i></a>
          <a target="_blank" class="pd-x-5" href="https://twitter.com/home?status=Bracket%20Plus,%20your%20best%20choice%20for%20premium%20quality%20admin%20template%20from%20Bootstrap.%20Get%20it%20now%20at%20http%3A//themepixels.me/bracketplus/intro"><i class="fa fa-twitter tx-20"></i></a>
        </div>
      </footer>
    </div><!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
    
    <script src="{{asset('bracket/lib/popper.js/popper.js')}}"></script>
    <script src="{{asset('bracket/lib/bootstrap/bootstrap.js')}}"></script>
    <script src="{{asset('bracket/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>
    <script src="{{asset('bracket/lib/moment/moment.js')}}"></script>
    <script src="{{asset('bracket/lib/jquery-ui/jquery-ui.js')}}"></script>
    <script src="{{asset('bracket/lib/jquery-switchbutton/jquery.switchButton.js')}}"></script>
    <script src="{{asset('bracket/lib/peity/jquery.peity.js')}}"></script>
    <script src="{{asset('bracket/lib/highlightjs/highlight.pack.js')}}"></script>
    <script src="{{asset('bracket/lib/select2/js/select2.min.js')}}"></script> 
    <script src="{{asset('bracket/lib/jquery-toggles/toggles.min.js')}}"></script>
    <script src="{{asset('bracket/lib/jt.timepicker/jquery.timepicker.js')}}"></script>
    <script src="{{asset('bracket/lib/spectrum/spectrum.js')}}"></script>
    <script src="{{asset('bracket/lib/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
    <script src="{{asset('bracket/lib/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('bracket/lib/ion.rangeSlider/js/ion.rangeSlider.min.js')}}"></script>
    <script src="{{asset('bracket/lib/jquery.steps/jquery.steps.js')}}"></script>
   <script src="{{asset('bracket/lib/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('bracket/lib/datatables-responsive/dataTables.responsive.js')}}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
     <script src="{{asset('bracket/lib/parsleyjs/parsley.js')}}"></script>
     <script src="{{asset('bracket/js/bracket.js')}}"></script>
     
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
 <script src="{{asset('toggles/js/jquery.mswitch.js')}}" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script>
      $(function(){
        'use strict'
 $('#select1').select2({
          containerCssClass: 'select2-for-dark',
          minimumResultsForSearch: Infinity // disabling search
        });
        // FOR DEMO ONLY
        // menu collapsed by default during first page load or refresh with screen
        // having a size between 992px and 1299px. This is intended on this page only
        // for better viewing of widgets demo.
        $(window).resize(function(){
          minimizeMenu();
        });
        $(window).load(function() {
    // Animate loader off screen
    $(".se-pre-con").fadeOut("slow");;
  });

        minimizeMenu();

        function minimizeMenu() {
          if(window.matchMedia('(min-width: 992px)').matches && window.matchMedia('(max-width: 1299px)').matches) {
            // show only the icons and hide left menu label by default
            $('.menu-item-label,.menu-item-arrow').addClass('op-lg-0-force d-lg-none');
            $('body').addClass('collapsed-menu');
            $('.show-sub + .br-menu-sub').slideUp();
          } else if(window.matchMedia('(min-width: 1300px)').matches && !$('body').hasClass('collapsed-menu')) {
            $('.menu-item-label,.menu-item-arrow').removeClass('op-lg-0-force d-lg-none');
            $('body').removeClass('collapsed-menu');
            $('.show-sub + .br-menu-sub').slideDown();
          }
        }


      });
    </script>
  </body>
  
</html>
