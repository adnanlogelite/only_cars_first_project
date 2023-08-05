@extends('.admin.template.master')
@section('title', 'Add Listing')
@section('content')
<style>
    .ck-editor__editable {
        min-height: 100px;
    }
</style>
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2><i class="fa fa-plus"></i> Edit Details</h2>
            </div>
        </div>
    </div>
    <div class="row column1">
        <div class="col-md-12">
            <div class="white_shd full margin_bottom_30">
                <div class="p-5">
                    <form class="row g-3" id="form_listing">
                        @csrf
                        <input type="hidden" name="aid" value="{{$add->id}}">
                        <div class="col-md-12"><br>
                            <label for="inputAddress" class="form-label">Address <span class="text-danger">*</span></label>
                            <input type="text" placeholder="123 Street" value="{{$add->address}}" name="address" class="form-control" id="address">
                        </div>
                        <div class="col-md-12"><br>
                            <label for="inputEmail" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="text" placeholder="example@email.com" value="{{$add->email}}" name="email" class="form-control" id="email">
                        </div>
                        <div class="col-md-12"><br>
                            <label for="inputPhone" class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="text" placeholder="+123456789" value="{{$add->phone}}" name="phone" class="form-control" id="phone">
                        </div>
                        <div class="col-md-12"><br>
                            <label for="inputPhone" class="form-label">Get In Touch <span class="text-danger">*</span></label>
                            <textarea name="description" id="editor" cols="30" rows="10">{!! html_entity_decode($add->description) !!}</textarea>
                        </div>
                        <div class="col-12"><br>
                            <button type="submit" id="submit" style="background-color: #ff5722; color:white;" class="btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
    $(document).ready(function() {
        $('#form_listing').on('submit', function(e) {
            e.preventDefault();
            var formdata = new FormData(this);
            $.ajax({
                url: "{{url('/add-address')}}",
                type: "post",
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                data: formdata,
                success: function(res) {
                    console.log(res);
                    if (res.code == 100) {
                        alert(res.msg);
                        window.location.href = "{{ url('/admin-address')}}";
                    }
                    // if(res.code == 200){
                    //     alert(res.msg);
                    // }
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