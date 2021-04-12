<!DOCTYPE html>
<html>
<head>
	<title></title>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') Listty</title>

    <!-- PLUGINS CSS STYLE -->
    <link href="{{ asset('college_assets/assets/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('college_assets/assets/plugins/listtyicons/style.css')}}" rel="stylesheet">
    <link href="{{ asset('college_assets/assets/plugins/menuzord/css/menuzord.css')}}" rel="stylesheet">
    <link href="{{ asset('college_assets/assets/plugins/map/css/map.css')}}" rel="stylesheet">
    <link href="{{ asset('college_assets/assets/plugins/selectric/selectric.css')}}" rel="stylesheet">
    <link href="{{ asset('college_assets/assets/plugins/dzsparallaxer/dzsparallaxer.css')}}" rel="stylesheet">
    <link href="{{ asset('college_assets/assets/plugins/owl-carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{ asset('college_assets/assets/plugins/owl-carousel/assets/owl.theme.default.min.css')}}" rel="stylesheet">
    <link href="{{ asset('college_assets/assets/plugins/revolution/css/settings.css')}}" rel="stylesheet">
    <link href="{{ asset('college_assets/assets/plugins/map/css/map.css')}}" rel="stylesheet">
    <link href="{{ asset('college_assets/assets/plugins/rateyo/jquery.rateyo.min.css')}}" rel="stylesheet">
    <link href="{{ asset('college_assets/assets/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ asset('college_assets/assets/plugins/DataTables/Responsive-2.2.2/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ asset('college_assets/assets/plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet">
    <link href="{{ asset('college_assets/assets/plugins/fancybox/jquery.fancybox.min.css')}}" rel="stylesheet">
    <link href="{{ asset('college_assets/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Muli:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- CUSTOM CSS -->
    <link href="{{ asset('college_assets/assets/css/style.css')}}" rel="stylesheet" id="option_style">

    <!-- FAVICON -->
    <link href="{{ asset('college_assets/assets/img/favicon.png')}}" rel="shortcut icon">
    @yield('style')
</head>
<body>

	@include('layout.collegeLayout.header_layout')

    @include('helpers.toast')
    
    @yield('content')
    

    @include('layout.collegeLayout.footer_layout')
    <script src="{{ asset('college_assets/assets/plugins/jquery/jquery-3.4.1.min.js')}}"></script>
    <script src="{{ asset('college_assets/assets/plugins/bootstrap/js/bootstrap.bundle.js')}}"></script>
    <script src="{{ asset('college_assets/assets/plugins/menuzord/js/menuzord.js')}}"></script>
    <script src="{{ asset('college_assets/assets/plugins/selectric/jquery.selectric.min.js')}}"></script>
    <script src="{{ asset('college_assets/assets/plugins/dzsparallaxer/dzsparallaxer.js')}}"></script>
    <script src="{{ asset('college_assets/assets/plugins/isotope/isotope.pkgd.min.js')}}"></script>

    <script src="{{ asset('college_assets/assets/plugins/daterangepicker/moment.min.js')}}"></script>
    <script src="{{ asset('college_assets/assets/plugins/daterangepicker/daterangepicker.js')}}"></script>

    <script src="{{ asset('college_assets/assets/plugins/revolution/js/jquery.themepunch.tools.min.js')}}"></script>
    <script src="assets/plugins/revolution/js/jquery.themepunch.revolution.min.js')}}"></script>

    <script src="{{ asset('college_assets/assets/plugins/smoothscroll/SmoothScroll.js')}}"></script>
    <script src="{{ asset('college_assets/assets/plugins/owl-carousel/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('college_assets/assets/plugins/rateyo/jquery.rateyo.min.js')}}"></script>
    <script src="{{ asset('college_assets/assets/plugins/apexcharts/apexcharts.js')}}"></script>

    <script src="{{ asset('college_assets/assets/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('college_assets/assets/plugins/DataTables/Responsive-2.2.2/js/dataTables.responsive.min.js')}}"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDU79W1lu5f6PIiuMqNfT1C6M0e_lq1ECY"></script>
    <script src="{{ asset('college_assets/plugins/map/js/markerclusterer.js')}}"></script>
    <script src="{{ asset('college_assets/assets/plugins/map/js/rich-marker.js')}}"></script>
    <script src="{{ asset('college_assets/assets/plugins/map/js/infobox_packed.js')}}"></script>
    <script src="{{ asset('college_assets/assets/js/map.js')}}"></script>
    <script src="{{ asset('college_assets/assets/plugins/fancybox/jquery.fancybox.min.js')}}"></script>
    <!-- Flot -->
    <script src="{{ asset('college_assets/assets/plugins/flot/jquery.flot.js')}}"></script>
    <script src="{{ asset('college_assets/assets/plugins/flot/jquery.flot.time.js')}}"></script>
    <script src="{{ asset('college_assets/assets/js/chart.js')}}"></script>

    <script src="{{ asset('college_assets/assets/plugins/perfect-scrollbar/dist/perfect-scrollbar.js')}}"></script>



    <script src="{{ asset('college_assets/assets/js/listty.js')}}"></script>
    
    
    @yield('script')
    <script type="text/javascript">
        $(document).ready(function(e){
           $('.admission-process').on('change', function(e){
               console.log(typeof $(this).val())
               if($(this).val() == 'true'){
                    console.log('hide other admission process')
                    $('.own-admission-process').show();
                    $('.other-admission-process').hide();
               }else{
                   console.log('hide own admission process')
                   console.log($('.own-admission-process'))
                    $('.own-admission-process').hide();
                    $('.other-admission-process').show();
               }
           })

           $('#facilities_id').on('change', function(e){
               var facility = $(this).val();
               if(facility){
                   if(facility == 'Area'){
                        
                   }else if(facility == 'Faculty'){

                   } else if(facility == 'Established'){

                   }
                   $('#facility_hidden').val(facility);
               }
           })
        });
    </script>
</body>
</html>