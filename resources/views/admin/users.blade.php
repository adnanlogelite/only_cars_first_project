@extends('.admin.template.master')

@section('title', 'Users')
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
                <h2>Users</h2>
            </div>
            <!-- <a href="/add-listing"><button type="button" class="btn right float-right">
                    <span class="color"><i class="fa fa-plus"></i> Add Listing</span>
                </button></a> -->
        </div>
        @php($sno = 1)
        <div class="col-md-12">
            <div class="white_shd full margin_bottom_30">
                <div class="full graph_head">
                    <div class="heading1 margin_0">
                        <h2>All Users</h2>
                    </div>
                </div>
                <div class="table_section padding_infor_info ">
                    <div class="table-responsive-sm">
                        <table class="table">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>#</th>
                                    <!-- <th>Image</th> -->
                                    <th>Name</th>
                                    <th>Email</th>
                                    <!-- <th>Gender</th> -->
                                    <th>Phone</th>
                                    <th>Verification</th>
                                    <th colspan="2">Operations</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody style="text-align: center;">
                            @foreach($users as $user)
                                <tr class="remove_user">
                                    <td>{{$sno++}}</td>
                                    <!-- <td><img src="" alt="..." style="height:80px;"></td> -->
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <!-- <td>Male</td> -->
                                    <td>{{$user->phone}}</td>
                                    @if($user->status == 1)
                                    <td><i class="fa fa-check-circle fa-lg" style='color:#0fe000'></i></td>
                                    @else
                                    <td><i class="fa fa-ban fa-lg" style='color: red'></i></td>
                                    @endif
                                    <td colspan="2"><a href="/edit-user/{{$user->id}}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a> | <span data-id="{{$user->id}}" id="delete" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</span></td>
                                    <!-- <td>Enable/Disable</td> -->
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
                url: "{{url('delete-user/{id}')}}",
                data: {
                    id: id,
                    "_token": "{{csrf_token()}}"
                },
                success: function(res) {
                    console.log(res);
                    if (res.code == 100) {
                        alert(res.msg);
                    }
                    el.closest(".remove_user").remove();
                }
            });
        });
    });
</script>
@endsection