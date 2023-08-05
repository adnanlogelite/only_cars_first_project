@extends('.user.template.master')
@section('title', 'Category')
@section('page_header')
<div class="col-lg-12">
    <div class="container-fluid bg-image mb-5" style="background-image: url('http://127.0.0.1:8000/images/allcar.png');">
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
        <!-- Shop Product Start -->
        <div class="col-lg-12 col-md-12">
            <div class="row pb-3">
                <!-- Loop -->
                <div class="row col-12" id="fprice">
                    @foreach($city as $cities)
                    <div class="col-lg-3 col-md-6 col-sm-12 pb-1" >
                        <div class="card product-item border-0 mb-4">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid w-100" src="{{asset('/images')}}/{{$cities->image}}" alt="">
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3">({{$cities->brand_name}}) {{$cities->car_name}}</h6>
                                <div class="d-flex justify-content-center">
                                    <h6>₹ {{$cities->price}}</h6>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a href="/product-detail/{{$cities->id}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                <a href="/enquire-now/{{$cities->id}}" class="btn btn-sm text-dark p-0"><i class="fa fa-envelope text-primary mr-1"></i>Enquire Now</a>
                            </div>
                        </div>
                    </div>
                    <!-- append product  -->
                    @endforeach
                    <!-- Loop End  -->
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
        <!-- Shop End -->
    </div>
</div>
@endsection