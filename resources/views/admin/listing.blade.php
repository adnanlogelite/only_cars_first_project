@extends('.admin.template.master')

@section('title', 'Listings')
@include('admin.template.header')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
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
                <h2>Listings</h2>
            </div>
            <a href="/add-listing"><button type="button" class="btn right float-right">
                    <span class="color"><i class="fa fa-plus"></i> Add Listing</span>
                </button></a>
        </div>
        <div class="col-md-12">
            <div class="white_shd full margin_bottom_30">
                <div class="full graph_head">
                    <div class="heading1 margin_0">
                        <h2>All Listings</h2>
                    </div>
                </div>
                <div class="table_section padding_infor_info ">
                    <div class="table-responsive-sm">
                        <table class="table">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Car Number</th>
                                    <th>Car Name</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>Model</th>
                                    <th>Price</th>
                                    <th>City</th>
                                    <th colspan="2">Operations</th>
                                    <th>Featured</th>
                                </tr>
                            </thead>
                            @foreach($listing as $list)
                            <tbody style="text-align: center;">
                                <tr class="remove_cat">
                                    <td>{{++$offset}}</td>
                                    <td><img src="{{asset('images')}}/{{$list->image}}" alt="..." style="height:80px;"></td>
                                    <td>{{$list->car_number}}</td>
                                    <td>{{$list->car_name}}</td>
                                    <td>{{$list->brand_name}}</td>
                                    <td>{{$list->category}}</td>
                                    <td>{{$list->model_year}}</td>
                                    <td>{{$list->price}}</td>
                                    <td>{{$list->city}}</td>
                                    <td colspan="2"><a href="/add-listing/{{$list->id}}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>&nbsp;<span id="delete" data-id="{{$list->id}}" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</span></td>
                                    <td>
                                        <div class="featured" list-id="{{$list->id}}">
                                            @if($list->featured == 0)
                                            <input type="checkbox" data-toggle="toggle" data-onstyle="outline-success" data-offstyle="outline-danger">
                                            @else
                                            <input type="checkbox" checked data-toggle="toggle" data-onstyle="outline-success" data-offstyle="outline-danger">
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $listing->links('pagination::bootstrap-4') }}
                        </div>
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
                url: "{{url('listing-deleted/{id}')}}",
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
        $(document).on('click', '.featured', function() {
            var lid = $(this).attr('list-id');
            // console.log(lid);
            $.ajax({
                url: "{{url('/feature-list')}}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    lid: lid
                },
                success: function(res) {
                    console.log(res);
                    if (res.code == 1) {
                        alert(res.msg);
                    }
                    if (res.code == 0) {
                        alert(res.msg);
                    }
                }
            });
        });
    });
</script>
@endsection