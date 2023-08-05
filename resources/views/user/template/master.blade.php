<!DOCTYPE html>
<html lang="en">

<head>
    @include('user.template.header')
    <title>@yield('title')</title>
</head>

<body>
    <!-- Topbar Start -->
    @include('user.template.topbar')
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
        @include('user.template.navbar')
        @yield('page_header')
        </div>
    </div>
    
    <!-- Navbar End -->


    @yield('content')


    <!-- Footer Start -->
    @include('user.template.footer')
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="{{url('https://code.jquery.com/jquery-3.4.1.min.js')}}"></script>
    <script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js')}}"></script>
    <script src="{{url('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('user/lib/easing/easing.min.js')}}"></script>
    <script src="{{url('user/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Contact Javascript File -->
    <script src="{{url('user/mail/jqBootstrapValidation.min.js')}}"></script>
    <script src="{{url('user/mail/contact.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{url('user/js/main.js')}}"></script>
</body>

</html>