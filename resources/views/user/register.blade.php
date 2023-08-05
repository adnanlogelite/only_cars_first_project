<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{url('auth/fonts/material-icon/css/material-design-iconic-font.min.css')}}">
    <link rel="stylesheet" href="{{url('https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Main css -->
    <link rel="stylesheet" href="{{url('auth/css/style.css')}}">
</head>

<body>

    <div class="main">
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                @if(Session::has('verify_error'))
                <div class="pt-3">
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> {{ Session::get('verify_error') }}
                    </div>
                </div>
                @endif
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form register" id="register-form">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name" />
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email" />
                            </div>
                            <div class="form-group">
                                <label for="phone"><i class="zmdi zmdi-phone"></i></label>
                                <input type="number" name="phone" id="phone" placeholder="Phone" />
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password" />
                            </div>
                            <div class="form-group">
                                <label for="re-password"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_password" id="re_password" placeholder="Repeat your password" />
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="{{url('auth/images/pngwing.png')}}" alt="sing up image"></figure>
                        <figure><img src="{{url('auth/images/favpng_sports-car.png')}}" alt="sing up image"></figure>
                        <a href="login" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- JS -->
    <script src="{{url('auth/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{url('auth/js/main.js')}}"></script>
    <script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.register').on('submit', function(e) {
                e.preventDefault();
                var formdata = new FormData(this);
                $.ajax({
                    url: "{{url('register')}}",
                    type: "post",
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: formdata,
                    success: function(res) {
                        console.log(res);
                        swal({
                            title: "Succesfully Registered!",
                            text: "Please Verify Your Email!",
                            icon: "success",
                        });
                        $(".register")[0].reset();
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
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>