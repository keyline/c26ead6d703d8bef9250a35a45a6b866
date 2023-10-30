@extends('front.layouts.master', ['title'=> 'Mentor Signup', 'pageName' => 'mentor-signup'])
@section('content')
<section class="login-section singup-section">
   <div class="container">
      <div class="row justify-content-around">
         <div class="col-lg-5 col-md-8 col-sm-8">
            <div class="login-box signup-box">
               <div class="icon-box-1">
                  <img src="{{ env('FRONT_ASSETS_URL') }}assets/images/lamp.webp" alt="">
               </div>
               <h3>Welcome!</h3>
               @if ($errors->any())
               <div class="alert alert-danger">
                  <ul>
                        @foreach ($errors->all() as $error)
                           <li>{{ $error }}</li>
                        @endforeach
                  </ul>
               </div>
               @endif
               <form action="{{route('mentor.create.step1')}}" method="POST">
                @csrf
                  <div class="form-group">
                     <input type="text" class="form-control" placeholder="First name" name="first_name">
                  </div>
                  <div class="form-group">
                     <input type="text" class="form-control" placeholder="Last name" name="last_name">
                  </div>
                  <div class="form-group">
                     <input type="text" class="form-control" placeholder="Email address" name="email">
                  </div>
                  <div class="form-group">
                     <input type="tel" class="form-control" id="phone" placeholder="Phone number" name="phone_number">
                  </div>
                  <div class="form-group form_password">
                     <input type="password" class="form-control" placeholder="Set password" name="password" id="password">
                     <i class="fa-regular fa-eye" id="togglePassword" onclick="getEyeOpen();"></i>
                     <i class="fa-regular fa-eye-slash" id="togglePassword2" onclick="getEyeClose();" style="display:none;"></i>
                  </div>
                  <div class="form-group form_password">
                     <input type="password" class="form-control" placeholder="Confirm password" name="password_confirmation" id="confirm_password">
                     <i class="fa-regular fa-eye" id="togglePassword11" onclick="getEyeOpen();"></i>
                     <i class="fa-regular fa-eye-slash" id="togglePassword22" onclick="getEyeClose();" style="display:none;"></i>
                  </div>
                  <div class="form-group">
                     <button class="login-btn">Sign Up</button>
                  </div>
               </form>
               <!-- <div class="icon-box-2">
                  <img src="{{ env('FRONT_ASSETS_URL') }}assets/images/signup-logo.webp" alt="">
                  </div> -->
            </div>
         </div>
         
         <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="rightside_testslider">
               <div class="login_sidebar_testimorial">
                  
                  @include('front.elements.side-testimonial')

               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
<script type="text/javascript">
   function getEyeOpen(){
      $('#password').attr('type', 'text');
      $('#confirm_password').attr('type', 'text');

      $('#togglePassword').hide();
      $('#togglePassword11').hide();
      $('#togglePassword2').show();
      $('#togglePassword22').show();
   }
   function getEyeClose(){
      $('#password').attr('type', 'password');
      $('#confirm_password').attr('type', 'password');

      $('#togglePassword2').hide();
      $('#togglePassword22').hide();
      $('#togglePassword').show();
      $('#togglePassword11').show();
   }
</script>