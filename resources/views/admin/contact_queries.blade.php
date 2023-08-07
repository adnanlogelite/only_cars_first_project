@extends('.admin.template.master')
@section('title', 'Contact Queries')
@section('content')
<!-- row -->
@php($sno = 1)
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>Queries</h2>
            </div>
        </div>
        <div class="row column4 graph">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <div class="heading1 margin_0">
                            <h2>Message</h2>
                        </div>
                    </div>
                    <div class="full progress_bar_inner">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="msg_section">
                                    <div class="msg_list_main">
                                        <ul class="msg_list">
                                            @foreach($contact as $con)
                                            <a href="/read-query/{{$con->id}}">
                                                <li>
                                                    <span>{{$sno++}}</span>
                                                    <span>
                                                        <span class="name_user">{{$con->name}}</span>
                                                        <span class="msg_user">{{$con->message}}</span>
                                                        <!-- <span class="time_ago">12 min ago</span> -->
                                                    </span>
                                                </li>
                                            </a>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center">
</div>
<!-- end row -->
@endsection