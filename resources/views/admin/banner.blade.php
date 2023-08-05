@extends('.admin.template.master')
@section('title', 'Upload Banner')
@section('content')
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
<form id="banner_upload">
    @csrf
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Banner</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-control col-6">
                    <input type="file" name="banner" id="banner">
                </div>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn right float-right"><span class="color"><i class="fa fa-upload"></i> Upload Banner</span></button>
            </div>
            <!-- banner inner -->
            <div class="midde_cont">
                <div class="container-fluid">
                    <!-- row -->
                    <div class="row column4 graph">
                        <!-- Image section -->
                        <div class="col-md-12">
                            <div class="white_shd full margin_bottom_30">
                                <div class="full graph_head">
                                    <div class="heading1 margin_0">
                                        <h2>Media Gallery Design Elements</h2>
                                    </div>
                                    <button type="button" class="btn btn-danger float-right" id="delete_all"><i class="fa fa-trash"></i> Delete Banner</button>
                                </div>
                                <div class="full gallery_section_inner padding_infor_info">
                                    <!-- bootstrap section  -->
                                    <div class="row load">
                                        <!-- content append  -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end banner inner -->
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        getdata();
        $('#banner_upload').on('submit', function(e) {
            e.preventDefault();
            var formdata = new FormData(this);
            $.ajax({
                url: "{{url('banner-uploaded')}}",
                type: "post",
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                data: formdata,
                success: function(res) {
                    console.log(res);
                    if (res.code == 100) {
                        $("#banner_upload")[0].reset();
                        alert(res.msg);
                        // $('.load').empty()
                        getdata();
                    }
                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function(field_name, error) {
                        $(document).find('[name=' + field_name + ']').next().remove();
                        $(document).find('[name=' + field_name + ']').after('<span class="text-strong text-danger">' + error + '</span>')
                    });
                }
            });
        });

        function getdata() {
            $.ajax({
                type: "GET",
                url: "{{url('banner-list')}}",
                success: function(response) {
                    var html = '';
                    $.each(response, function(key, value) {
                        let img = 'http://127.0.0.1:8000/images';
                        if(value['banner_set'] == 0){
                            html += '<div class="col-md-3" id="rem_banner">\
                                                  <div class="custom-control custom-checkbox image-checkbox">\
                                                     <input type="checkbox" class="custom-control-input listCheck" data-id="' + value['id'] + '" id="' + value['id'] + '" name="banners">\
                                                     <label class="custom-control-label" for="' + value['id'] + '">\
                                                         <img src="' + img + '/' + value['banner_img'] + '" name="bannerimg" alt="" class="img-fluid">\
                                                     </label>\
                                                     <input type="hidden" name="banner_set" id="banner_set" value="' + value['banner_set'] + '">\
                                                     <button type="button" class="btn btn-primary w-100 set_banner" banner-id="' + value['id'] + '">Set Banner</button>\
                                                  </div>\
                                                </div>';
                        }else{
                            html += '<div class="col-md-3" id="rem_banner">\
                                                  <div class="custom-control custom-checkbox image-checkbox">\
                                                     <input type="checkbox" class="custom-control-input listCheck" data-id="' + value['id'] + '" id="' + value['id'] + '" name="banners">\
                                                     <label class="custom-control-label" for="' + value['id'] + '">\
                                                         <img src="' + img + '/' + value['banner_img'] + '" name="bannerimg" alt="" class="img-fluid">\
                                                     </label>\
                                                     <input type="hidden" name="banner_set" id="banner_set" value="' + value['banner_set'] + '">\
                                                     <button type="button" class="btn btn-secondary w-100 set_banner" banner-id="' + value['id'] + '">Disable Banner</button>\
                                                  </div>\
                                                </div>'
                        }
                    });
                    $('.load').html(html);
                }
            });
        }
        $('#delete_all').click(function(e) {
            var bannerarr = [];
            $('.listCheck:checked').each(function() {
                bannerarr.push($(this).data('id'));
            });
            if (bannerarr.length <= 0) {
                alert('Choose atleast 1 banner!');
            } else {
                var bannerId = bannerarr.join(",");
                $.ajax({
                    url: "{{url('banner-deleted')}}",
                    type: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: 'ids=' + bannerId,
                    success: function(data) {
                        console.log(data);
                        if (data.code == 300) {
                            alert(data.msg);
                        }
                        $(".listCheck:checked").each(function() {
                            $(this).closest('#rem_banner').remove();
                        });

                    }
                });
            }
        });
        $(document).on('click', '.set_banner', function() {
            var id = $(this).attr('banner-id');
            if ($(this).hasClass('btn-secondary')) {
                $.ajax({
                    url: "{{url('banner-updated')}}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: id
                    },
                    success: function(res) {
                        console.log(res);
                        if (res.code == 100) {
                            alert(res.msg);
                        }
                    }
                });
                $(this).removeClass('btn-secondary').text('Set Banner');
                $(this).addClass('btn-primary').text('Set Banner');
            } else {
                $.ajax({
                    url: "{{url('banner-updated')}}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: id
                    },
                    success: function(res) {
                        console.log(res);
                        if (res.code == 200) {
                            alert(res.msg);
                        }
                    }
                });
                $(this).addClass('btn-secondary').text('Disable Banner');
            }
        });
    });
</script>
@endsection