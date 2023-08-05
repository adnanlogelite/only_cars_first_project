<div class="col-lg-3 d-none d-lg-block">
    <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
        <h6 class="m-0">
            @if(request()->id == 1)
            New Cars
            @elseif(request()->id == 2)
            Used Cars
            @elseif(request()->id == 3)
            Top Selling Cars
            @else
            Categories
            @endif
        </h6>
        <i class="fa fa-angle-down text-dark"></i>
    </a>
    <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 2;">
        <div class="navbar-nav w-100 overflow-hidden" id="cat" style="height: 120px">
        <!-- Append Categories  -->
        </div>
    </nav>
</div>
<div class="col-lg-9">
    <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
        <a href="" class="text-decoration-none d-block d-lg-none">
            <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav mr-auto py-0 highlight">
                <a href="/home" class="nav-item nav-link home">Home</a>
                <a href="/shop" class="nav-item nav-link shop">All Cars</a>
                <a href="/my-enquiry" class="nav-item nav-link myenq">My Enquiry</a>
                <a href="/contact" class="nav-item nav-link contact">Contact</a>
            </div>
            <div class="navbar-nav ml-auto py-0">
                @if(Session::has('userlogin'))
                <a href="/logout" class="nav-item nav-link">Logout</a>
                @else
                <a href="/login" class="nav-item nav-link">Login</a>
                <a href="/register" class="nav-item nav-link">Register</a>
                @endif
            </div>
        </div>
    </nav>
</div>
<script>
    $(document).ready(function(){
        var pathname = $(location).attr('pathname');
        if(pathname == '/home'){
            $('.home').addClass('active');
        }
        if(pathname == '/shop'){
            $('.shop').addClass('active');
        }
        if(pathname == '/contact'){
            $('.contact').addClass('active');
        }
        if(pathname == '/my-enquiry'){
            $('.myenq').addClass('active');
        }

        $.ajax({
            type: "GET",
            url: "{{url('cat-list')}}",
            success: function(res){
                $.each(res, function(key, value){
                    $('#cat').append('<a href="/category/'+value['id']+'" class="nav-item nav-link">'+value['category']+'</a>');
                });
            }
        });
        $(document).on('click', '.highlight', function(){
            $(this).addClass('active');
        });
    });
</script>