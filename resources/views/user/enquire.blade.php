@extends('.user.template.master')
@section('title', 'Checkout')
@section('page_header')
<div class="col-lg-12">
    <div class="container-fluid bg-image mb-5" style="background-image: url('http://127.0.0.1:8000/images/banner.png');">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Enquiry</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="/home">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Enquiry</p>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-4">
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Car Details</h4>
                </div>
                <div class="card-body">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0 mb-2">
                        <img class="img-fluid w-100" src="{{asset('/images')}}/{{$enquire->image}}" alt="">
                    </div>
                    <h5 class="font-weight-medium mb-3">About</h5>
                    <div class="d-flex">
                        <p class="text-dark font-weight-medium mb-0 mr-3">Name:</p>
                        <p>{{$enquire->car_name}}</p>
                    </div>
                    <div class="d-flex">
                        <p class="text-dark font-weight-medium mb-0 mr-3">Brand:</p>
                        <p>{{$enquire->brand_name}}</p>
                    </div>
                    <div class="d-flex">
                        <p class="text-dark font-weight-medium mb-0 mr-3">Model Year:</p>
                        <p>{{$enquire->model_year}}</p>
                    </div>
                    <div class="d-flex">
                        <p class="text-dark font-weight-medium mb-0 mr-3">Category:</p>
                        <p>{{$enquire->sub_category}}</p>
                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Price</h5>
                        <h5 class="font-weight-bold">₹ {{$enquire->price}}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <form id="enquiry">
                @csrf
                <input type="hidden" name="car_name" value="{{$enquire->car_name}}">
                <input type="hidden" name="brand_name" value="{{$enquire->brand_name}}">
                <input type="hidden" name="model_year" value="{{$enquire->model_year}}">
                <input type="hidden" name="category" value="{{$enquire->category}}">
                <input type="hidden" name="price" value="{{$enquire->price}}">
                <input type="hidden" name="car_image" value="{{$enquire->image}}">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Enquiry Form</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>First Name <span class="text-danger">*</span></label>
                            <input class="form-control" name="fname" type="text" placeholder="Adnan">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Last Name <span class="text-danger">*</span></label>
                            <input class="form-control" name="lname" type="text" placeholder="Khan">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail <span class="text-danger">*</span></label>
                            <input class="form-control" name="email" type="email" placeholder="example@email.com">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No <span class="text-danger">*</span></label>
                            <input class="form-control" name="phone" type="number" placeholder="+123 456 789">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address <span class="text-danger">*</span></label>
                            <input class="form-control" name="address" type="text" placeholder="123 Street">
                        </div>
                        <!-- <div class="col-md-6 form-group">
                        <label>Country</label>
                        <select class="custom-select">
                            <option selected>United States</option>
                            <option>Afghanistan</option>
                            <option>Albania</option>
                            <option>Algeria</option>
                        </select>
                    </div> -->
                        <div class="col-md-6 form-group">
                            <label>City <span class="text-danger">*</span></label>
                            <input class="form-control" name="city" type="text" placeholder="Lucknow">
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Description</label><br>
                            <textarea class="form-control" name="description" id="" rows="5"></textarea>
                        </div>
                        <!-- <div class="col-md-12 form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="newaccount">
                            <label class="custom-control-label" for="newaccount">Create an account</label>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="shipto">
                            <label class="custom-control-label" for="shipto" data-toggle="collapse" data-target="#shipping-address">Ship to different address</label>
                        </div>
                    </div> -->
                        <div class="card border-secondary mb-5 col-lg-12">
                            <div class="card-footer border-secondary bg-transparent">
                                <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Send Enquiry</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#enquiry').on('submit', function(e) {
            e.preventDefault();
            var formdata = new FormData(this);
            $.ajax({
                url: "{{url('send-enquiry')}}",
                type: "post",
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                data: formdata,
                success: function(res) {
                    console.log(res);
                    if (res.code == 100) {
                        swal({
                            title: "Enquiry Send Succesfully!",
                            text: "Please Check Your Email!",
                            icon: "success",
                        });
                    }
                    $("#enquiry")[0].reset();
                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function(field_name, error) {
                        $(document).find('[name=' + field_name + ']').next().remove();
                        $(document).find('[name=' + field_name + ']').after('<span class="text-strong text-danger">' + error + '</span>')
                    });
                }
            });
        });
    });
</script>
@endsection