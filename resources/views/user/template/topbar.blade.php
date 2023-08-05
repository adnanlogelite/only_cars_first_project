 <style>
         .high.is_active {
             color: black;
         }
 </style>
 <div class="container-fluid">
     <div class="row bg-secondary py-2 px-xl-5">
         <div class="col-lg-6 d-none d-lg-block">
             <div class="d-inline-flex align-items-center">
                 <a class="text-dark" href="/faq">FAQs</a>
                 <span class="text-muted px-2">|</span>
                 <a class="text-dark" href="/contact">Help</a>
                 <span class="text-muted px-2">|</span>
                 <a class="text-dark" href="privacy-policy">Privacy Policy</a>
             </div>
         </div>
         <div class="col-lg-6 text-center text-lg-right">
             <div class="d-inline-flex align-items-center" id="social">
                 <!-- <a class="text-dark px-2" href="">
                     <i class="fab fa-facebook-f"></i>
                 </a>
                 <a class="text-dark px-2" href="">
                     <i class="fab fa-twitter"></i>
                 </a>
                 <a class="text-dark px-2" href="">
                     <i class="fab fa-linkedin-in"></i>
                 </a>
                 <a class="text-dark px-2" href="">
                     <i class="fab fa-instagram"></i>
                 </a>
                 <a class="text-dark pl-2" href="">
                     <i class="fab fa-youtube"></i>
                 </a> -->
             </div>
         </div>
     </div>
     @if(Session::has('message'))
     <div class="d-flex justify-content-center text-center pt-2">
         <div class="col-3">
             <div class="alert alert-success">
                 <strong>Congratulations!</strong> {{ Session::get('message') }}
             </div>
         </div>
     </div>
     @endif
     <div class="row align-items-center py-3 px-xl-5">
         <div class="col-lg-3 d-none d-lg-block">
             <a href="/home" class="text-decoration-none">
                 <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">Only</span>Cars</h1>
             </a>
         </div>
         <div class="col-lg-6 col-6 text-left">
             <div style="position: relative;">
                 <form action="/search">
                     <div class="input-group">
                         <input type="text" class="form-control ser" name="search" placeholder="Search for cars">
                         <div class="input-group-append">
                             <div class="form-control text-primary">
                                 <i class="fa fa-search"></i><button class="bg-transparent text-primary border-0">Search</button>
                             </div>
                         </div>
                     </div>
                 </form>
                 <ul class="list-group search_list" style="position: absolute; width: 100%; z-index: 9; right: 0; left:auto; ">
                     <!-- <a href=""><li class="list-group-item d-flex justify-content-between align-items-center">
                     Cras justo odio
                     <span class="badge badge-primary badge-pill">Brand</span>
                 </li></a>
                 <li class="list-group-item d-flex justify-content-between align-items-center">
                     Dapibus ac facilisis in
                     <span class="badge badge-primary badge-pill">Car</span>
                 </li> -->
                 </ul>
             </div>
         </div>
         <div class="col-lg-3 col-6 text-right">
             <a class="btn btn-nav dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 @if( request()->city )
                 {{request()->city}}
                 @else
                 Location
                 @endif
             </a>
             <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" id="city">
             </div>
             <!-- <a href="" class="btn border">
                 <i class="fas fa-heart text-primary"></i>
                 <span class="badge">0</span>
             </a> -->
             <a href="/my-enquiry" class="btn border">
             <i class="fa fa-envelope text-primary"></i>
                 <span class="badge enquiry">0</span>
             </a>
         </div>
     </div>
 </div>
 <script>
     $(document).ready(function() {
         $.ajax({
             type: "GET",
             url: "{{url('cities')}}",
             success: function(res) {
                 $.each(res, function(key, value) {
                     $('#city').append('<a class="dropdown-item" href="/city/' + value['city'] + '">' + value['city'] + '</a>');
                 });
             }
         });
         $.ajax({
             type: "GET",
             url: "{{url('social')}}",
             success: function(respond) {
                    if(respond['facebook']){
                        $('#social').append('<a class="text-dark px-2" href="'+respond['facebook']+'">\
                        <i class="fab fa-facebook-f"></i>\
                    </a>');
                    }
                    if(respond['twitter']){
                        $('#social').append('<a class="text-dark px-2" href="'+respond['twitter']+'">\
                        <i class="fab fa-twitter"></i>\
                    </a>');
                    }
                    if(respond['linkedin']){
                        $('#social').append('<a class="text-dark px-2" href="'+respond['linkedin']+'">\
                        <i class="fab fa-linkedin-in"></i>\
                    </a>');
                    }
                    if(respond['instagram']){
                        $('#social').append('<a class="text-dark px-2" href="'+respond['instagram']+'">\
                        <i class="fab fa-instagram"></i>\
                    </a>');
                    }
                    if(respond['youtube']){
                        $('#social').append('<a class="text-dark px-2" href="'+respond['youtube']+'">\
                        <i class="fab fa-youtube"></i>\
                    </a>');
                    }
                    if(respond['reddit']){
                        $('#social').append('<a class="text-dark px-2" href="'+respond['reddit']+'">\
                        <i class="fab fa-reddit-alien"></i>\
                    </a>');
                    }
                    if(respond['telegram']){
                        $('#social').append('<a class="text-dark px-2" href="'+respond['telegram']+'">\
                        <i class="fab fa-telegram"></i>\
                    </a>');
                    }
                    if(respond['pinterest']){
                        $('#social').append('<a class="text-dark px-2" href="'+respond['pinterest']+'">\
                        <i class="fab fa-pinterest"></i>\
                    </a>');
                    }
             }
         });
         $(document).on('keyup', '.ser', function() {
             var keyword = $(this).val();
             console.log(keyword);
             $.ajax({
                 type: "GET",
                 url: "{{url('search-list')}}",
                 data: {
                     keyword: keyword
                 },
                 success: function(res) {
                     var data = '';
                     console.log(typeof keyword);
                     $.each(res, function(key, value) {
                         data += '<a href="/product-detail/'+value['id']+'" class="text-decoration-none ahigh"><li class="list-group-item d-flex justify-content-between align-items-center high">\
                         ' + value['car_name'] + '\
                         <span class="badge badge-primary badge-pill">' + value['brand_name'] + '</span>\
                     </li></a>'
                     });
                     $('.search_list').html(data);
                 }
             });
             
         });
         $(document).on('mouseenter','.high',function(){
            $('.ahigh').removeClass('text-decoration-none');
            $(this).addClass('is_active');
         })
         $(document).on('mouseleave','.high',function(){
            $(this).removeClass('is_active');
         })
         $.ajax({
            type: "GET",
            url: "{{url('top')}}",
            success: function(res){
                $('.enquiry').text(res);
            }
         });
     });
 </script>