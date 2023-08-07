@extends('.user.template.master')
@section('title', 'Privacy Policy')
@section('page_header')
<div class="col-lg-12">
    <div class="container-fluid bg-image mb-5" style="background-image: url('images/banner.png');">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Privacy Policy</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="/home">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Privacy & Policy</p>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="container-fluid">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">{{$privacy->title}}</span></h2>
    </div>
    <div class="row px-xl-5">
        <div class="col-lg-12 mb-5">
            <div class="contact-form p-5">
                {!! html_entity_decode($privacy->content) !!}
            </div>
        </div>
    </div>
</div>
@endsection