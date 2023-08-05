@extends('.admin.template.master')
@section('title', 'Enquiry')
@section('content')
<!-- row -->
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>Enquiry</h2>
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
                                            @foreach($enquire as $enquiry)
                                            <a href="/read-enquiry/{{$enquiry->id}}">
                                                <li>
                                                    <span><img src="{{asset('/images')}}/{{$enquiry->car_image}}" class="img-responsive" alt="#"></span>
                                                    <span>
                                                        <span class="name_user">{{$enquiry->fname}} {{$enquiry->lname}}</span>
                                                        <span class="msg_user">Enquiry For ({{$enquiry->brand_name}}) {{$enquiry->car_name}}</span>
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
    {{ $enquire->links('pagination::bootstrap-4') }}
</div>
<!-- end row -->
@endsection