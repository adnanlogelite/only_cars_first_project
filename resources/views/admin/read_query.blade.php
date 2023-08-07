@extends('.admin.template.master')
@section('title', 'Read Query')
@section('content')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Query</h2>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row column1">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <div class="heading1 margin_0">
                            <h2>Contact Query</h2>
                        </div>
                    </div>
                    <div class="full price_table padding_infor_info">
                        <div class="row">
                            <!-- user profile section -->
                            <!-- profile image -->
                            <div class="col-lg-12">
                                <div class="full dis_flex center_text">
                                    <div class="profile_img"><img width="80" class="rounded-circle" src="{{url('images/user-image.png')}}" alt="#" /></div>
                                    <div class="profile_contant">
                                        <div class="contact_inner">
                                            <h3>{{$contact->name}}</h3>
                                            <ul class="list-unstyled">
                                                <li><i class="fa fa-envelope-o"></i> <span class="text-dark font-weight-medium">Email</span> : {{$contact->email}}</li>
                                                <li><i class="fa fa-book"></i> <span class="text-dark font-weight-medium">Subject</span> : {{$contact->subject}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- profile contant section -->
                                <div class="full inner_elements margin_top_30">
                                    <div class="tab_style2">
                                        <div class="tabbar">
                                            <nav>
                                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#recent_activity" role="tab" aria-selected="true">About</a>
                                                </div>
                                            </nav>
                                            <div class="tab-content" id="nav-tabContent">
                                                <div class="tab-pane fade show active" id="recent_activity" role="tabpanel" aria-labelledby="nav-home-tab">
                                                    <div class="container">
                                                        <div class="d-flex mb-2">
                                                            <p class="text-dark font-weight-medium mb-0 mr-3">Description:</p>
                                                        </div>
                                                        <p class="col-lg-10">{{$contact->message}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end user profile section -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
            <!-- end row -->
        </div>
    </div>
</div>
@endsection