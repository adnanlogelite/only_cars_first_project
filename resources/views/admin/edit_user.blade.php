@extends('.admin.template.master')
@section('title', 'Edit User')
@section('content')
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2><i class="fa fa-edit"></i> Edit User</h2>
            </div>
        </div>
    </div>
    <div class="row column1">
        <div class="col-md-12 d-flex justify-content-center">
            <div class="white_shd full margin_bottom_30 col-6">
                <div class="p-5">
                    <form class="row g-3" id="form_listing" action="/user-edited" method="POST">
                        @csrf
                        <input type="hidden" name="uid" value="{{$user->id}}">
                        <div class="col-md-12 mb-3">
                            <label for="inputName" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{$user->name}}" name="uname" id="inputName">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="inputEmail" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" value="{{$user->email}}" name="uemail" id="inputEmail">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="inputPhone" class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" value="{{$user->phone}}" name="uphone" id="inputPhone">
                        </div>
                        <div class="col-12">
                            <button type="submit" id="submit" style="background-color: #ff5722; color:white;" class="btn">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection