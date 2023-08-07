@extends('.user.template.master')
@section('title', 'FAQs')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<style>
    .accordion {
        background-color: #eee;
        color: #444;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
        transition: 0.4s;
    }

    .active,
    .accordion:hover {
        background-color: #ccc;
    }

    .panel {
        padding: 0 18px;
        display: none;
        background-color: white;
        overflow: hidden;
    }
</style>
@section('page_header')
<div class="col-lg-12">
    <div class="container-fluid bg-image mb-5" style="background-image: url('images/allcar.png');">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">FAQs</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="/home">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">FAQs</p>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
@php($sno = 1)
<div class="container-fluid">
    <div class="text-center mb-4">
        <h1 class="section-title px-5"><span class="px-2">Frequently Ask Questions (FAQs)</span></h1>
    </div>
    <div class="row px-xl-5">
        <div class="col-lg-12 mb-5">
            <div class="faq">
                <div class="container">
                    @foreach($faq as $faqs)
                        <button class="accordion mb-3 accordion-button collapsed" data-bs-toggle="collapse">{{$faqs->title}}</button>
                        <div class="panel">
                            {!! html_entity_decode($faqs->content) !!}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
</script>
@endsection