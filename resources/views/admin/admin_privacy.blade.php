@extends('.admin.template.master')
@section('title', 'Privacy Policy')
@section('content')
<!-- row -->
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
        min-height: 500px;
    }
</style>
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>Privacy Policy</h2>
            </div>
        </div>
        <div class="col-md-12">
            <div class="white_shd full margin_bottom_20">
                <div class="full graph_head">
                    <div class="heading1 margin_0">
                        <h2>Add Privacy Policy</h2>
                    </div>
                </div>
                <div class="table_section padding_infor_info ">
                    <form action="/upload-privacy" method="POST">
                        @csrf
                        <input type="hidden" value="{{$policy->id}}" name="pid">
                        <div class="table-responsive-sm">
                            <h1>Title</h1>
                            <input class="form-control form-control-lg mb-5" type="text" value="{{$policy->title}}" name="title" placeholder="Enter Title">
                            <h1>Content</h1>
                            <div id="kl">
                                <textarea name="content" id="editor" cols="30" rows="10">{!! html_entity_decode($policy->content) !!}</textarea>
                            </div>
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
</script>
<!-- end row -->
@endsection