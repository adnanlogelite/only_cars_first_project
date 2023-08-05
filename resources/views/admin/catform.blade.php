@extends('.admin.template.master')
@section('title', 'Add Category')
@section('content')
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>Categories</h2>
            </div>
        </div>
        <div class="col-md-12">
            <div class="white_shd full margin_bottom_30">
                <div class="full graph_head">
                    <div class="heading1 margin_0">
                        <h2><i class="fa fa-pencil" aria-hidden="true"></i> Add Categories</h2>
                    </div>
                </div>
                <div class="mt-5 pt-5">
                    <form id="cat_form">
                        @csrf
                        <div class="container">
                            <div class="form-group col">
                                <input type="hidden" name="cid" @if($edit) value="{{$edit->id}}" @endif class="form-control" id="formGroupExampleInput" placeholder="Type Category">
                                <label for="formGroupExampleInput">Enter Category <span class="text-danger">*</span></label>
                                <input type="text" name="category" @if($edit) value="{{$edit->sub_category}}" @endif class="form-control" id="formGroupExampleInput" placeholder="Type Category">
                                @error('category')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group col green-border-focus">
                                <label for="exampleFormControlTextarea5">Description</label>
                                <textarea class="form-control" name="description" id="exampleFormControlTextarea5" rows="3">@if($edit) {{$edit->description}} @endif</textarea>
                            </div>
                            <div class="form-group col">
                                <label for="formGroupExampleInput2">Choose Parent <span class="text-danger">*</span></label><br>
                                <select class="form-control" aria-label="Default select example" name="parent">
                                    <option selected disabled>--- Select Parent ---</option>
                                    <option value="0">Main Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if($edit) {{$category->id == $edit->parent ? 'selected' : ''}} @endif>{{$category->category}}</option>
                                    @endforeach
                                </select>
                                @error('parent')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group col"><button type="submit" id="submit" class="btn right" style="background-color: #ff5722; color:white;">
                                    <span class="color">Submit</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#cat_form').on('submit', function(e) {
            e.preventDefault();
            var formdata = new FormData(this);
            $.ajax({
                url: "{{url('category-added')}}",
                type: "post",
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                data: formdata,
                success: function(res) {
                    console.log(res);
                    if (res.code == 200) {
                        $("#cat_form")[0].reset();
                        alert(res.msg);
                    }
                    if (res.code == 100) {
                        alert(res.msg);
                        window.location.href = "{{ url('categories')}}";
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