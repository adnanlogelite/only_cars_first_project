@extends('.user.template.master')
@section('title', 'Shop')
@section('page_header')
<div class="col-lg-12">
    <div class="container-fluid bg-image mb-5" style="background-image: url('images/banner.png');">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">All Cars</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="/home">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">All Cars</p>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-12">
            <!-- Price Start -->
            <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Filter by price</h5>
                <form>
                    <select class="custom-select" id="price_filter">
                        <option value="0" selected>All Price</option>
                        <option value="1">₹4 lacs - ₹10 lacs</option>
                        <option value="2">₹10 lacs - ₹20 lacs</option>
                        <option value="3">₹20 lacs - ₹50 lacs</option>
                        <option value="4">₹50 lacs - ₹1 cr</option>
                        <option value="5">More than ₹1 cr</option>
                    </select>
                </form>
            </div>
            <!-- Price End -->

            <!-- Model Start -->
            <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Filter by year</h5>
                <form id="checks">
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3 all_year">
                        <input type="checkbox" class="custom-control-input syear" value="2000-2023" checked id="year_all">
                        <label class="custom-control-label" for="year_all">All Year</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                    <div class="try">
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input syear" value="2010-2015" id="year_1">
                            <label class="custom-control-label" for="year_1">2010 - 2015</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input syear" value="2015-2020" id="year_2">
                            <label class="custom-control-label" for="year_2">2015 - 2020</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input syear" value="2020-2023" id="year_3">
                            <label class="custom-control-label" for="year_3">2020 - 2023</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Model End -->
        </div>
        <!-- Shop Sidebar End -->

        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-12">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="input-group">
                            <input type="text" class="form-control" id="searchbar" placeholder="Search by name">
                            <div class="input-group-append">
                                <span class="input-group-text bg-transparent text-primary">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>
                        <div class="dropdown ml-4">
                            <button class="btn border dropdown-toggle allbrand" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All Brands</button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                @foreach($records as $data)
                                <span class="dropdown-item brand">{{$data->brand_name}}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Loop -->
                <div class="row col-12" id="fprice">
                    <!-- append product  -->
                    @if(!empty($brands))
                    @foreach($brands as $brand)
                    <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                        <div class="card product-item border-0 mb-4">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid w-100" src="{{asset('/images')}}/{{$brand->image}}" alt="">
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3">({{$brand->brand_name}}) {{$brand->car_name}}</h6>
                                <div class="d-flex justify-content-center">
                                    <h6>₹ {{$brand->price}}</h6>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a href="product-detail/{{$brand->id}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                <a href="/enquire-now/{{$brand->id}}" class="btn btn-sm text-dark p-0"><i class="fa fa-envelope text-primary mr-1"></i>Enquire Now</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
                <!-- Loop End  -->
            </div>
            <div class="pagination justify-content-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item prev">
                            <a class="page-link" href="javascript:void(0)" aria-label="Previous"><i class="fa fa-arrow-left" aria-hidden="true"></i><span class="sr-only prevp">0</span></a>
                        </li>
                        <input type="hidden" value="{{$total_page}}" id="max_page">
                        <!-- <span aria-hidden="true">&laquo;</span> -->
                        @for($i = 1; $i <= $total_page; $i++) <li class="page-item"><a class="page-link" href="javascript:void(0)">{{$i}}</a></li>
                            @endfor
                            <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li> -->
                            <li class="page-item next">
                                <a class="page-link" href="javascript:void(0)" aria-label="Next"><i class="fa fa-arrow-right" aria-hidden="true"></i><span class="sr-only nextp">2</span></a>
                                <!-- <span aria-hidden="true">&raquo;</span> -->
                            </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Shop Product End -->
        <!-- Shop End -->
    </div>
</div>
<script>
    $(document).ready(function() {
        var pathname = $(location).attr('pathname');
        // $('.allbrand').text(name);
        if(pathname == '/shop'){
            get_data();
        }
        $('.prev').hide();

        // fetch data from DB start

        function get_data() {
            $.ajax({
                type: "GET",
                url: "{{url('price-filter')}}",
                success: function(response) {
                    let img = "{{url('/images')}}";
                    $.each(response, function(key, value) {
                        $('#fprice').append('<div class="col-lg-4 col-md-6 col-sm-12 pb-1" >\
                            <div class="card product-item border-0 mb-4">\
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">\
                                    <img class="img-fluid w-100" src="' + img + '/' + value['image'] + '" alt="">\
                                </div>\
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">\
                                    <h6 class="text-truncate mb-3">(' + value['brand_name'] + ') ' + value['car_name'] + '</h6>\
                                    <div class="d-flex justify-content-center">\
                                        <h6>₹ ' + value['price'] + '</h6>\
                                    </div>\
                                </div>\
                                <div class="card-footer d-flex justify-content-between bg-light border">\
                                    <a href="product-detail/' + value['id'] + '" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>\
                                    <a href="/enquire-now/' + value['id'] + '" class="btn btn-sm text-dark p-0"><i class="fa fa-envelope text-primary mr-1"></i>Enquire Now</a>\
                                </div>\
                            </div>\
                        </div>');
                    });
                }
            });
        }
        // fetch data from DB end

        // price filter function on select box start

        $(document).on('change', '#price_filter', function() {
            var val = $(this).val();

            // for reset other filters start
            $("#searchbar").val('');
            $('.allbrand').text('All Brands');
            $('#year_all').prop('checked', true);
            $('#year_1').prop('checked', false);
            $('#year_2').prop('checked', false);
            $('#year_3').prop('checked', false);
            // for reset other filters end
            $.ajax({
                type: "POST",
                url: "{{url('price-filter')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    val: val,
                },
                success: function(res) {
                    console.log(res);
                    let img = "{{url('/images')}}";
                    $('#fprice').empty();
                    $.each(res, function(key, value) {
                        $('#fprice').append('<div class="col-lg-4 col-md-6 col-sm-12 pb-1" >\
                            <div class="card product-item border-0 mb-4">\
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">\
                                    <img class="img-fluid w-100" src="' + img + '/' + value['image'] + '" alt="">\
                                </div>\
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">\
                                    <h6 class="text-truncate mb-3">(' + value['brand_name'] + ') ' + value['car_name'] + '</h6>\
                                    <div class="d-flex justify-content-center">\
                                        <h6>₹ ' + value['price'] + '</h6>\
                                    </div>\
                                </div>\
                                <div class="card-footer d-flex justify-content-between bg-light border">\
                                    <a href="product-detail/' + value['id'] + '" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>\
                                    <a href="/enquire-now/' + value['id'] + '" class="btn btn-sm text-dark p-0"><i class="fa fa-envelope text-primary mr-1"></i>Enquire Now</a>\
                                </div>\
                            </div>\
                        </div>');
                    });
                }
            });
        });
        // price filter function on select box end

        // year filter function on checkbox start

        $(document).on('click', '.try', function() {
            $('#year_all').prop('checked', false);
        })
        $(document).on('click', '.all_year', function() {
            $('#year_all').prop('checked', true);
            $('#year_1').prop('checked', false);
            $('#year_2').prop('checked', false);
            $('#year_3').prop('checked', false);
        });
        $(document).on('click', '.try', function() {
            if (!$("#year_1").is(":checked") && !$("#year_2").is(":checked") && !$("#year_3").is(":checked")) {
                $('#year_all').prop('checked', true);
            }
        });
        $(document).on('change', '#checks', function() {

            // for reset other filters start
            $("#searchbar").val('');
            $('#price_filter option[value="0"]').prop('selected', true);
            $('.allbrand').text('All Brands');
            // for reset other filters end
            var arr = [];
            $(".syear:checked").each(function() {
                arr.push($(this).val());
            });
            $.ajax({
                type: "POST",
                url: "{{url('price-filter')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    arr: arr
                },
                success: function(ress) {
                    console.log(ress);
                    let img = "{{url('/images')}}";
                    $('#fprice').empty();
                    $.each(ress, function(key, value) {
                        $('#fprice').append('<div class="col-lg-4 col-md-6 col-sm-12 pb-1" >\
                            <div class="card product-item border-0 mb-4">\
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">\
                                    <img class="img-fluid w-100" src="' + img + '/' + value['image'] + '" alt="">\
                                </div>\
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">\
                                    <h6 class="text-truncate mb-3">(' + value['brand_name'] + ') ' + value['car_name'] + '</h6>\
                                    <div class="d-flex justify-content-center">\
                                        <h6>₹ ' + value['price'] + '</h6>\
                                    </div>\
                                </div>\
                                <div class="card-footer d-flex justify-content-between bg-light border">\
                                    <a href="product-detail/' + value['id'] + '" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>\
                                    <a href="/enquire-now/' + value['id'] + '" class="btn btn-sm text-dark p-0"><i class="fa fa-envelope text-primary mr-1"></i>Enquire Now</a>\
                                </div>\
                            </div>\
                        </div>');
                    });
                }
            });
        });
        // year filter function on checkbox end

        // custom pagination function start 

        $(document).on('click', '.page-link', function() {
            $('.prev').show();
            var page = $(this).text();
            var max = $('#max_page').val();
            if (page == 1) {
                $('.prev').hide();
            }
            if (page == max) {
                $('.next').hide();
            } else {
                $('.next').show();
            }
            console.log(page);
            $('.page-item').each(function() {
                $(this).removeClass('active');
            });
            $(this).parent('.page-item').addClass('active');
            $.ajax({
                type: "GET",
                url: "{{url('price-filter')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    page: page,
                },
                success: function(res) {
                    console.log(res);
                    let img = "{{url('/images')}}";
                    $('#fprice').empty();
                    $.each(res, function(key, value) {
                        $('#fprice').append('<div class="col-lg-4 col-md-6 col-sm-12 pb-1" >\
                                <div class="card product-item border-0 mb-4">\
                                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">\
                                        <img class="img-fluid w-100" src="' + img + '/' + value['image'] + '" alt="">\
                                    </div>\
                                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">\
                                        <h6 class="text-truncate mb-3">(' + value['brand_name'] + ') ' + value['car_name'] + '</h6>\
                                        <div class="d-flex justify-content-center">\
                                            <h6>₹ ' + value['price'] + '</h6>\
                                        </div>\
                                    </div>\
                                    <div class="card-footer d-flex justify-content-between bg-light border">\
                                        <a href="product-detail/' + value['id'] + '" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>\
                                        <a href="/enquire-now/' + value['id'] + '" class="btn btn-sm text-dark p-0"><i class="fa fa-envelope text-primary mr-1"></i>Enquire Now</a>\
                                    </div>\
                                </div>\
                            </div>');
                    });
                }
            });
            var pages = parseInt(page);
            $('.nextp').text(pages + 1);
            $('.prevp').text(pages - 1);
        });
        // custom pagination function end

        // search bar function start

        $('#searchbar').keyup(function() {

            // for reset other filters start
            $('#price_filter option[value="0"]').prop('selected', true);
            $('.allbrand').text('All Brands');
            $('#year_all').prop('checked', true);
            $('#year_1').prop('checked', false);
            $('#year_2').prop('checked', false);
            $('#year_3').prop('checked', false);
            // for reset other filters end

            var search = $(this).val().trim().toLowerCase();
            $.ajax({
                type: "GET",
                url: "{{url('price-filter')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    search: search
                },
                success: function(ser) {
                    console.log(ser);
                    let img = "{{url('/images')}}";
                    $('#fprice').empty();
                    $.each(ser, function(key, value) {
                        $('#fprice').append('<div class="col-lg-4 col-md-6 col-sm-12 pb-1" >\
                                <div class="card product-item border-0 mb-4">\
                                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">\
                                        <img class="img-fluid w-100" src="' + img + '/' + value['image'] + '" alt="">\
                                    </div>\
                                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">\
                                        <h6 class="text-truncate mb-3">(' + value['brand_name'] + ') ' + value['car_name'] + '</h6>\
                                        <div class="d-flex justify-content-center">\
                                            <h6>₹ ' + value['price'] + '</h6>\
                                        </div>\
                                    </div>\
                                    <div class="card-footer d-flex justify-content-between bg-light border">\
                                        <a href="product-detail/' + value['id'] + '" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>\
                                        <a href="/enquire-now/' + value['id'] + '" class="btn btn-sm text-dark p-0"><i class="fa fa-envelope text-primary mr-1"></i>Enquire Now</a>\
                                    </div>\
                                </div>\
                            </div>');
                    });
                }
            });
        });
        // search bar function end

        // brand filter function with dropdown start 

        $(document).on('click', '.brand', function() {

            // for reset other filters start
            $("#searchbar").val('');
            $('#price_filter option[value="0"]').prop('selected', true);
            $('#year_all').prop('checked', true);
            $('#year_1').prop('checked', false);
            $('#year_2').prop('checked', false);
            $('#year_3').prop('checked', false);
            // for reset other filters end
            var name = $(this).text();
            $('.allbrand').text(name);
            $.ajax({
                type: "GET",
                url: "{{url('price-filter')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    name: name
                },
                success: function(brand) {
                    console.log(brand);
                    let img = "{{url('/images')}}";
                    $('#fprice').empty();
                    $.each(brand, function(key, value) {
                        $('#fprice').append('<div class="col-lg-4 col-md-6 col-sm-12 pb-1" >\
                                <div class="card product-item border-0 mb-4">\
                                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">\
                                        <img class="img-fluid w-100" src="' + img + '/' + value['image'] + '" alt="">\
                                    </div>\
                                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">\
                                        <h6 class="text-truncate mb-3">(' + value['brand_name'] + ') ' + value['car_name'] + '</h6>\
                                        <div class="d-flex justify-content-center">\
                                            <h6>₹ ' + value['price'] + '</h6>\
                                        </div>\
                                    </div>\
                                    <div class="card-footer d-flex justify-content-between bg-light border">\
                                        <a href="product-detail/' + value['id'] + '" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>\
                                        <a href="/enquire-now/' + value['id'] + '" class="btn btn-sm text-dark p-0"><i class="fa fa-envelope text-primary mr-1"></i>Enquire Now</a>\
                                    </div>\
                                </div>\
                            </div>');
                    });
                }
            });
        });
        // brand filter function with dropdown end
    });
</script>
@endsection