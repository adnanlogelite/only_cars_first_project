<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.template.header')
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="dashboard dashboard_1">
    <div class="full_container">
        <div class="inner_container">
            <!-- Sidebar  -->
            @include('admin.template.sidebar')
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
                <!-- navbar -->
                <!-- dashboard inner -->
                @include('admin.template.navbar')
                <div class="midde_cont">
                    @yield('content')                
                <!-- end navbar -->
                <!-- end dashboard inner -->
                @include('admin.template.footer')                
               </div>
            </div>
        </div>
    </div>
        <!-- jQuery -->
        <!-- <script src="{{url('js/jquery.min.js')}}"></script> -->
        <script src="{{url('js/popper.min.js')}}"></script>
        <script src="{{url('js/bootstrap.min.js')}}"></script>
        <!-- wow animation -->
        <script src="{{url('js/animate.js')}}"></script>
        <!-- select country -->
        <script src="{{url('js/bootstrap-select.js')}}"></script>
        <!-- owl carousel -->
        <script src="{{url('js/owl.carousel.js')}}"></script>
        <!-- chart js -->
        <script src="{{url('js/Chart.min.js')}}"></script>
        <script src="{{url('js/Chart.bundle.min.js')}}"></script>
        <script src="{{url('js/utils.js')}}"></script>
        <script src="{{url('js/analyser.js')}}"></script>
        <!-- nice scrollbar -->
        <script src="{{url('js/perfect-scrollbar.min.js')}}"></script>
        <script>
            var ps = new PerfectScrollbar('#sidebar');
        </script>
        <!-- custom js -->
        <script src="{{url('js/custom.js')}}"></script>
        <script src="{{url('js/chart_custom_style1.js')}}"></script>
</body>

</html>