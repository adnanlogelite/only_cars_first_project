@extends('.admin.template.master')

@section('title', 'Categories')
@include('admin.template.header')
<style>
    button.right {
        margin-bottom: 10px;
        float: right;
        background-color: #ff5722;
    }

    .orbg {
        background-color: #ff5722;
    }

    .color {
        color: white;
    }
</style>

@section('content')
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>Categories</h2>
            </div>
            <a href="/add-category"><button type="button" class="btn right float-right">
                    <span class="color"><i class="fa fa-plus"></i> Add Category</span>
                </button></a>
        </div>
        @php($sno = 1)
        <div class="col-md-12">
            <div class="white_shd full margin_bottom_30">
                <div class="full graph_head">
                    <div class="heading1 margin_0">
                        <h2>All Categories</h2>
                    </div>
                </div>
                <div class="table_section padding_infor_info ">
                    <div class="table-responsive-sm">
                        <table class="table">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>#</th>
                                    <th>Parent</th>
                                    <th>Sub-Categories</th>
                                    <th colspan="2">Operations</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center;">
                            @foreach($categories as $category)
                                <tr class="remove_cat">
                                    <td>{{$sno++}}</td>
                                    <td>{{$category->category}}</td>
                                    <td>@if($category->category != $category->sub_category) {{$category->sub_category}} @else -- @endif</td>
                                    <td colspan="2"><a href="/add-category/{{$category->id}}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a> | <span id="delete" data-id="{{ $category->id }}" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</span></td>
                                    <td>Enable/Disable</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(this).on('click', '#delete', function() {
            var id = $(this).attr('data-id');
            var el = $(this);
            $.ajax({
                type: 'GET',
                url: "{{url('delete-category/{id}')}}",
                data: {
                    id: id,
                    "_token": "{{csrf_token()}}"
                },
                success: function(res) {
                    console.log(res);
                    if (res.code == 300) {
                        alert(res.msg);
                    }
                    el.closest(".remove_cat").remove();
                }
            });
        });
    });
</script>
@endsection