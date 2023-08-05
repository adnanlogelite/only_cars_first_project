@extends('.user.template.master')
@section('title', 'Cart')
@section('page_header')
<div class="col-lg-12">
    <div class="container-fluid bg-image mb-5" style="background-image: url('http://127.0.0.1:8000/images/allcar.png');">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Enquiries</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">My Enquiry</p>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-12 table-responsive mb-5">
            <table class="table table-bordered text-center mb-3">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Enquiry ID</th>
                        <th>Car Image</th>
                        <th>Car Name</th>
                        <th>Brand Name</th>
                        <th>Model Year</th>
                        <th>Category</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach($enquiry as $enquire)
                    <tr>
                        <td>{{++$offset}}</td>
                        <td><img src="{{asset('/images')}}/{{$enquire->car_image}}" alt="" height="50"></td>
                        <td>{{$enquire->car_name}}</td>
                        <td>{{$enquire->brand_name}}</td>
                        <td>{{$enquire->model_year}}</td>
                        <td>{{$enquire->sub_category}}</td>
                        <td>₹ {{$enquire->price}}</td>
                    </tr>
                    @endforeach
                    <!-- <tr>
                        <td class="align-middle"><img src="{{url('user/img/product-2.jpg')}}" alt="" style="width: 50px;"> Colorful Stylish Shirt</td>
                        <td class="align-middle">$150</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary text-center" value="1">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">$150</td>
                        <td class="align-middle"><button class="btn btn-sm btn-primary"><i class="fa fa-times"></i></button></td>
                    </tr> -->
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $enquiry->links('pagination::bootstrap-4') }}
            </div>
        </div>
        <!-- <div class="col-lg-4">
            <form class="mb-5" action="">
                <div class="input-group">
                    <input type="text" class="form-control p-4" placeholder="Coupon Code">
                    <div class="input-group-append">
                        <button class="btn btn-primary">Apply Coupon</button>
                    </div>
                </div>
            </form>
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Subtotal</h6>
                        <h6 class="font-weight-medium">$150</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">$10</h6>
                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Total</h5>
                        <h5 class="font-weight-bold">$160</h5>
                    </div>
                    <button class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</button>
                </div>
            </div>
        </div> -->
    </div>
</div>
@endsection