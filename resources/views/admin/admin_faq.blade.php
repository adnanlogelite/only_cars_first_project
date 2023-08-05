@extends('.admin.template.master')
@section('title', 'FAQs')
@section('content')
<!-- row -->
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
<style>
    button.right {
        margin-bottom: 10px;
        float: right;
        background-color: #ff5722;
    }

    .color {
        color: white;
    }

    .ck-editor__editable {
        min-height: 200px;
    }
</style>
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>FAQs</h2>
            </div>
        </div>
        <div class="col-md-12">
            <div class="white_shd full margin_bottom_20">
                <div class="full graph_head">
                    <div class="heading1 margin_0">
                        <h2>Add Faq</h2>
                    </div>
                </div>
                <div class="table_section padding_infor_info ">
                    <form id="form_listing">
                        @csrf
                        <input type="hidden" name="fid" @if($faq) value="{{$faq->id}}" @endif>
                        <div class="table-responsive-sm">
                            <h1>Question</h1>
                            <input class="form-control form-control-lg mb-5" type="text" @if($faq) value="{{$faq->title}}" @endif name="title" placeholder="Enter Title">
                            <h1>Answer</h1>
                            <textarea name="content" id="editor" cols="30" rows="10">@if($faq) {!! html_entity_decode($faq->content) !!} @endif</textarea>
                            <button type="submit" class="btn right float-right mt-3">
                                <span class="color"> Upload</span>
                            </button>
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
                url: "{{url('upload-faq')}}",
                type: "post",
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                data: formdata,
                success: function(res) {
                    console.log(res);
                    if (res.code == 100) {
                        $("#form_listing")[0].reset();
                        alert(res.msg);
                    }
                    if (res.code == 200) {
                        alert(res.msg);
                        window.location.href = "{{ url('/admin-faq')}}";
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
<!-- end row -->
@endsection