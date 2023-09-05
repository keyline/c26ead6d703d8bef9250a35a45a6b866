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
                  <div class="form-group">
                     <input type="password" class="form-control" placeholder="Set password" name="password">
                  </div>
                  <div class="form-group">
                     <input type="password" class="form-control" placeholder="Confirm password" name="password_confirmation">
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
                  <div class="testmoric_item">
                     <div class="testimor_quote"><img src="{{ env('FRONT_ASSETS_URL') }}assets/images/testi_qutationo.png" alt="icon"></div>
                     <div class="testimori_content">I was looking for online career counselling after 12th and one of my friends suggested StuMento. The best part of StuMento is that  I got to choose from multiple career counsellers from the comfort of my home. Thanks to the sessions, Now I am so much more clear about my career now👍</div>
                     <div class="testomori_profile">
                        <div class="testmori_prof_img"><img src="{{ env('FRONT_ASSETS_URL') }}assets/images/testi_qutati_img.png" alt="icon"></div>
                        <div class="testmori_name">
                           <h3>Vijay</h3>
                           <h5>Recent 12th graduate</h5>
                        </div>
                     </div>
                  </div>
                  <div class="testmoric_item">
                     <div class="testimor_quote"><img src="{{ env('FRONT_ASSETS_URL') }}assets/images/testi_qutationo.png" alt="icon"></div>
                     <div class="testimori_content">I was looking for online career counselling after 12th and one of my friends suggested StuMento. The best part of StuMento is that  I got to choose from multiple career counsellers from the comfort of my home. Thanks to the sessions, Now I am so much more clear about my career now👍</div>
                     <div class="testomori_profile">
                        <div class="testmori_prof_img"><img src="{{ env('FRONT_ASSETS_URL') }}assets/images/testi_qutati_img.png" alt="icon"></div>
                        <div class="testmori_name">
                           <h3>Vijay</h3>
                           <h5>Recent 12th graduate</h5>
                        </div>
                     </div>
                  </div>
                  <div class="testmoric_item">
                     <div class="testimor_quote"><img src="{{ env('FRONT_ASSETS_URL') }}assets/images/testi_qutationo.png" alt="icon"></div>
                     <div class="testimori_content">I was looking for online career counselling after 12th and one of my friends suggested StuMento. The best part of StuMento is that  I got to choose from multiple career counsellers from the comfort of my home. Thanks to the sessions, Now I am so much more clear about my career now👍</div>
                     <div class="testomori_profile">
                        <div class="testmori_prof_img"><img src="{{ env('FRONT_ASSETS_URL') }}assets/images/testi_qutati_img.png" alt="icon"></div>
                        <div class="testmori_name">
                           <h3>Vijay</h3>
                           <h5>Recent 12th graduate</h5>
                        </div>
                     </div>
                  </div>
                  <div class="testmoric_item">
                     <div class="testimor_quote"><img src="{{ env('FRONT_ASSETS_URL') }}assets/images/testi_qutationo.png" alt="icon"></div>
                     <div class="testimori_content">I was looking for online career counselling after 12th and one of my friends suggested StuMento. The best part of StuMento is that  I got to choose from multiple career counsellers from the comfort of my home. Thanks to the sessions, Now I am so much more clear about my career now👍</div>
                     <div class="testomori_profile">
                        <div class="testmori_prof_img"><img src="{{ env('FRONT_ASSETS_URL') }}assets/images/testi_qutati_img.png" alt="icon"></div>
                        <div class="testmori_name">
                           <h3>Vijay</h3>
                           <h5>Recent 12th graduate</h5>
                        </div>
                     </div>
                  </div>
                  <div class="testmoric_item">
                     <div class="testimor_quote"><img src="{{ env('FRONT_ASSETS_URL') }}assets/images/testi_qutationo.png" alt="icon"></div>
                     <div class="testimori_content">I was looking for online career counselling after 12th and one of my friends suggested StuMento. The best part of StuMento is that  I got to choose from multiple career counsellers from the comfort of my home. Thanks to the sessions, Now I am so much more clear about my career now👍</div>
                     <div class="testomori_profile">
                        <div class="testmori_prof_img"><img src="{{ env('FRONT_ASSETS_URL') }}assets/images/testi_qutati_img.png" alt="icon"></div>
                        <div class="testmori_name">
                           <h3>Vijay</h3>
                           <h5>Recent 12th graduate</h5>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection