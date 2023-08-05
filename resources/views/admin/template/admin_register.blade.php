<!DOCTYPE html>
<html lang="en">
   <head>
      @include('admin.template.header')
   </head>
   <body class="inner_page login">
      <div class="full_container">
         <div class="container">
            <div class="center verticle_center full_height">
               <div class="login_section">
                  <div class="logo_login">
                     <div class="center">
                     <img width="600" src="images/borcelle-removebg-preview.png" alt="#" />
                     </div>
                  </div>
                  <div class="login_form">
                     <form method="POST">
                        @csrf
                        <fieldset>
                            <div class="field">
                               <label class="label_field">Full Name <span class="text-danger">*</span></label>
                               <input type="text" name="fullname" placeholder="Full name" />
                               @error('fullname')
                               <div class="text-danger">{{$message}}</div>
                               @enderror
                            </div>
                           <div class="field">
                              <label class="label_field">Email Address<span class="text-danger">*</span></label>
                              <input type="email" name="email" placeholder="E-mail" />
                              @error('email')
                               <div class="text-danger">{{$message}}</div>
                               @enderror
                           </div>
                           <div class="field">
                              <label class="label_field">Password<span class="text-danger">*</span></label>
                              <input type="password" name="password" placeholder="Password" />
                              @error('password')
                               <div class="text-danger">{{$message}}</div>
                               @enderror
                           </div>
                           <div class="field">
                              <label class="label_field hidden">hidden label</label>
                              <a class="forgot" href="/admin-login">Already Registered? Login</a>
                           </div>
                           <div class="field margin_0">
                              <label class="label_field hidden">hidden label</label>
                              <button type="submit" class="main_bt">Register</button>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- jQuery -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- wow animation -->
      <script src="js/animate.js"></script>
      <!-- select country -->
      <script src="js/bootstrap-select.js"></script>
      <!-- nice scrollbar -->
      <script src="js/perfect-scrollbar.min.js"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
   </body>
</html>