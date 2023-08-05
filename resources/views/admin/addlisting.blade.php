@extends('.admin.template.master')
@section('title', 'Add Listing')
@section('content')
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2><i class="fa fa-plus"></i> Add Listing</h2>
            </div>
        </div>
    </div>
    <div class="row column1">
        <div class="col-md-12">
            <div class="white_shd full margin_bottom_30">
                <div class="p-5">
                    <form class="row g-3" id="form_listing">
                        @csrf
                        <input type="hidden" name="lid" @if($listing) value="{{$listing->id}}" @endif>
                        <div class="col-6">
                            <label for="formFile" class="form-label">Upload Image <span class="text-danger">*</span></label><br>
                            @if($listing)
                            <img src="{{asset('images')}}/{{$listing->image}}" alt="" height="50px">@endif
                            <input type="file" name="image" @if($listing) accept="images/*" @endif class="form-control" id="image">
                        </div>
                        <div class="col-md-6">
                            <label for="inputCarNumber" class="form-label">Car Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" @if($listing) value="{{$listing->car_number}}" @endif name="car_number" id="inputCarNumber">
                        </div>
                        <div class="col-md-6"><br>
                            <label for="inputName" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Car Name" @if($listing) value="{{$listing->car_name}}" @endif name="car_name" class="form-control" id="inputName">
                        </div>
                        <div class="col-md-6"><br>
                            <label for="inputBrandName" class="form-label">Company <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Brand Name" @if($listing) value="{{$listing->brand_name}}" @endif name="brand_name" class="form-control" id="inputBrandName">
                        </div>
                        <div class="col-md-12"><br>
                            <label for="inputCategory" class="form-label">Choose Category <span class="text-danger">*</span></label>
                            <select id="inputCategory" name="category" class="form-control">
                                <option value="" selected disabled>--Select Category--</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}" @if($listing) {{$category->category == $listing->category ? 'selected' : ''}} @endif>{{$category->category}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4"><br>
                            <label for="model" class="form-label">Model <span class="text-danger">*</span></label>
                            <input type="number" name="model_year" @if($listing) value="{{$listing->model_year}}" @endif placeholder="Model Year" class="form-control" id="model">
                        </div>
                        <div class="col-md-4"><br>
                            <label for="inputPrice" class="form-label">Price <span class="text-danger">*</span></label>
                            <input type="number" name="price" @if($listing) value="{{$listing->price}}" @endif placeholder="₹" class="form-control" id="inputPrice">
                        </div>
                        <div class="col-md-4"><br>
                            <label for="inputCity" class="form-label">City <span class="text-danger">*</span></label>
                            <input type="text" name="city" @if($listing) value="{{$listing->city}}" @endif placeholder="City Name" class="form-control" id="inputCity">
                        </div>
                        <div class="col-12 mb-3"><br>
                            <label for="inputAddress" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea5" rows="3">@if($listing) {{$listing->description}} @endif</textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" id="submit" style="background-color: #ff5722; color:white;" class="btn">Add Listing</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#form_listing').on('submit', function(e) {
            e.preventDefault();
            var formdata = new FormData(this);
            $.ajax({
                url: "{{url('listing-added')}}",
                type: "post",
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                data: formdata,
                success: function(res) {
                    console.log(res);
                    if (res.code == 200) {
                        $("#form_listing")[0].reset();
                        alert(res.msg);
                    }
                    if(res.code == 100){
                        alert(res.msg);
                        window.location.href = "{{ url('listing')}}";
                    }
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