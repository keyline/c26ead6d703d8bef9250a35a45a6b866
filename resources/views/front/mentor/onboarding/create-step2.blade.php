@extends('front.layouts.master', ['title'=> 'Mentor Signup', 'page_name' => 'mentor-signup-2'])
@section('content')
<section class="mentor_element">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="metor_dashboard_top">
               <div class="metor_progess">
                  <div class="stepper-wrapper">
                     <div class="stepper-item first + completed"></div>
                     <div class="stepper-item  + active">
                        <img class="img-fluid" src="{{ env('FRONT_ASSETS_URL') }}assets/images/bulb_icon.png" alt="logo">
                     </div>
                     <div class="stepper-item  + ">
                        <div class="progress-dot step-counter"></div>
                     </div>
                     <div class=" stepper-item  + ">
                        <div class="progress-dot step-counter"></div>
                     </div>
                     <div class="last-counter stepper-item  + ">
                        <div class="progress-dot step-counter"></div>
                     </div>
                  </div>
                  <div class="me_probar"></div>
                  <!--<div class="met_prolight"><img class="img-fluid" src="{{ env('FRONT_ASSETS_URL') }}assets/images/bulb_icon.png" alt="logo"></div>-->
               </div>
            </div>
         </div>
      </div>
      <div class="row justify-content-center">
         <div class="col-lg-5 col-md-8 col-sm-8">
            <div class="metor_dashboard">
               <div class="metor_information">
                  <h2>Hello there!</h2>
                  <p class="text-muted mb-4">In a few moments you will be ready to share your expertise & time</p>
                  <div class="metor_step1_form">
                     @if ($errors->any())
                           <div class="alert alert-danger">
                              <ul>
                                 @foreach ($errors->all() as $error)
                                       <li>{{ $error }}</li>
                                 @endforeach
                              </ul>
                           </div>
                     @endif
                     <form action="{{ route('mentor.create.step2') }}" method="POST">
                        @csrf
                        <div class="title">
                           <p>Connect your social account</p>
                        </div>
                        <div class="input-group mb-3">
                           <span class="input-group-text" id="basic-addon1">https://</span>
                           <input type="text" name="social_url"class="form-control" placeholder="LinkedIn, Twitter, Instagram" aria-label="LinkedIn, Twitter, Instagram" aria-describedby="basic-addon1">
                        </div>
                        <div class="title">
                           <p>Your stumento page link</p>
                        </div>
                        <div class="input-group mb-3">
                           <span class="input-group-text" id="basic-addon1">stumento.com/</span>
                           <input type="text" class="form-control" name="profile_slug" value="alex_test"  aria-describedby="basic-addon1">
                        </div>
                        <div class="title">
                           <p>How do you plan to use Stumento</p>
                        </div>
                        <div class="input-group mb-3">
                           <div class="button-group button-group--full-width">
                              <label class="button-group__btn"><input type="radio" name="registration_intent" value="I want to offer my expertise to my followers"/> <span class="button-group__label">I want to offer my expertise to my followers</span></label>
                              <label class="button-group__btn"><input type="radio" name="registration_intent" value="I want to monetise my audience"/> <span class="button-group__label">I want to monetise my audience</span></label>
                              <label class="button-group__btn"><input type="radio" name="registration_intent" value="I'm just exploring"/> <span class="button-group__label">I’m just exploring</span></label>
                           </div>
                        </div>
                        <div class="title">
                           <p>What all do you plan to offer?</p>
                        </div>
                        <div class="input-group mb-3">
                           <div class="button-group button-group-2">
                              @foreach($serviceTypes AS $type)
                              <label class="button-group__btn"><input type="checkbox" name="intended_service_type[]" value="{{ $type->id }}"/> <span class="button-group__label">{{ $type->name }}</span></label>
                              <!-- <label class="button-group__btn"><input type="checkbox" name="service_offered" /> <span class="button-group__label">Priority DMs</span></label> -->
                              <!-- <label class="button-group__btn"><input type="checkbox" name="service_offered" /> <span class="button-group__label">Group sessions</span></label> -->
                              @endforeach
                           </div>
                        </div>
                        <div class="input-group mb-3">
                           <!--<button  class="next-btn">Next</button>-->
                           <!-- <a href="mentor2.html" class="next-btn">Next</a> -->
                           <button type="submit" class="next-btn">Next</button>
                        </div>
                     </form>
                  </div>
               </div>
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