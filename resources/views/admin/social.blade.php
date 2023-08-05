@extends('.admin.template.master')

@section('title', 'Soical Icon')
@include('admin.template.header')
<style>
    button.right {
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
                <h2><i class="fa fa-plus"></i> Add Social Links</h2>
            </div>
        </div>
        <div class="row column1">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="p-5">
                        <form class="row g-3" id="form_listing">
                            @csrf
                            <input type="hidden" name="sid" value="{{$social->id}}">
                            <div class="col-md-6">
                                <i class="fa fa-facebook-square"></i> <label for="inputFacebook" class="form-label">Facebook </label>
                                <input type="text" class="form-control" placeholder="https://facebook.com/username" value="{{$social->facebook}}" name="facebook" id="inputFacebook">
                            </div>
                            <div class="col-md-6">
                                <i class="fa fa-twitter-square"></i> <label for="inputTwitter" class="form-label">Twitter </label>
                                <input type="text" class="form-control" placeholder="https://twitter.com/username" value="{{$social->twitter}}" name="twitter" id="inputTwitter">
                            </div>
                            <div class="col-md-6"><br>
                                <i class="fa fa-linkedin-square"></i> <label for="inputLinkedin" class="form-label">Linked In </label>
                                <input type="text" class="form-control" placeholder="https://linkedin.com/username" value="{{$social->linkedin}}" name="linkedin" id="inLinkedin">
                            </div>
                            <div class="col-md-6"><br>
                                <i class="fa fa-instagram"></i> <label for="inputInstagram" class="form-label">Instagram </label>
                                <input type="text" class="form-control" placeholder="https://instagram.com/username" value="{{$social->instagram}}" name="instagram" id="inputInstagram">
                            </div>
                            <div class="col-md-6"><br>
                                <i class="fa fa-youtube"></i> <label for="inputYoutube" class="form-label">Youtube </label>
                                <input type="text" class="form-control" placeholder="https://youtube.com/username" value="{{$social->youtube}}" name="youtube" id="inputYoutube">
                            </div>
                            <div class="col-md-6"><br>
                                <i class="fa fa-reddit-square"></i> <label for="inputReddit" class="form-label">Reddit </label>
                                <input type="text" class="form-control" placeholder="https://reddit.com/username" value="{{$social->reddit}}" name="reddit" id="inputReddit">
                            </div>
                            <div class="col-md-6"><br>
                                <i class="fa fa-telegram"></i> <label for="inputTelegram" class="form-label">Telegram </label>
                                <input type="text" class="form-control" placeholder="https://telegram.com/username" value="{{$social->telegram}}" name="telegram" id="inputTelegram">
                            </div>
                            <div class="col-md-6 mb-4"><br>
                                <i class="fa fa-pinterest-square"></i> <label for="inputPinterest" class="form-label">Pinterest </label>
                                <input type="text" class="form-control" placeholder="https://pinterest.com/username" value="{{$social->pinterest}}" name="pinterest" id="inputPinterest">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn right float-left"><span class="color">Update Links</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#form_listing').on('submit', function(e) {
            e.preventDefault();
            var formdata = new FormData(this);
            $.ajax({
                url: "{{url('upload-social-media')}}",
                type: "post",
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                data: formdata,
                success: function(res) {
                    console.log(res);
                    if (res.code == 100) {
                        alert(res.msg);
                    }
                    window.location.href = "{{ url('/social-icon')}}";
                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function(field_name, error) {
                        $(document).find('[name=' + field_name + ']').next().remove();
                        $(document).find('[name=' + field_name + ']').after('<span class="text-strong text-danger">' + error + '</span>')
                    });
                }
            });
        });
    });
</script>
@endsection