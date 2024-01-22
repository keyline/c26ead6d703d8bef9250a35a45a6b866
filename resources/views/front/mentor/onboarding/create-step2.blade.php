@extends('front.layouts.master', ['title' => 'Mentor Signup', 'pageName' => 'mentor-signup-2'])
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
                                    <img class="img-fluid" src="{{ env('FRONT_ASSETS_URL') }}assets/images/bulb_icon.png"
                                        alt="logo">
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
            <div class="row justify-content-around">
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
                                        <input type="text" name="social_url"class="form-control"
                                            placeholder="LinkedIn, Twitter, Instagram"
                                            aria-label="LinkedIn, Twitter, Instagram" aria-describedby="basic-addon1"
                                            value="{{ !isset($current_mentor->social_url) ? (old('social_url') ? old('social_url') : '') : $current_mentor->social_url }}">
                                    </div>
                                    <div class="title">
                                        <p>Your mentrovert page link</p>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">mentrovert.com/</span>
                                        <input type="text" class="form-control" name="profile_slug"
                                            value="{{ old('profile_slug') ?? $current_mentor->display_name }}"
                                            aria-describedby="basic-addon1">
                                    </div>
                                    <div class="title">
                                        <p>How do you plan to use Mentrovert</p>
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="button-group button-group--full-width">
                                            <label class="button-group__btn"><input type="radio"
                                                    name="registration_intent"
                                                    value="I want to help and support students through my expertise"
                                                    {{ !isset($current_mentor->registration_intent)
                                                        ? (old('registration_intent') == 'I want to help and support students through my expertise'
                                                            ? 'checked'
                                                            : '')
                                                        : ($current_mentor->registration_intent == 'I want to help and support students through my expertise'
                                                            ? 'checked'
                                                            : '') }} />
                                                <span class="button-group__label">I want to help and support students through my expertise</span></label>
                                            <label class="button-group__btn"><input type="radio"
                                                    name="registration_intent" value="I want to monetise my time"
                                                    {{ !isset($current_mentor->registration_intent)
                                                        ? (old('registration_intent') == 'I want to monetise my time'
                                                            ? 'checked'
                                                            : '')
                                                        : ($current_mentor->registration_intent == 'I want to monetise my time'
                                                            ? 'checked'
                                                            : '') }} />
                                                <span class="button-group__label">I want to monetise my
                                                    time</span></label>
                                            <label class="button-group__btn"><input type="radio"
                                                    name="registration_intent" value="I'm just exploring"
                                                    {{ !isset($current_mentor->registration_intent)
                                                        ? (old('registration_intent') == "I'm just exploring"
                                                            ? 'checked'
                                                            : '')
                                                        : ($current_mentor->registration_intent == "I'm just exploring"
                                                            ? 'checked'
                                                            : '') }} />
                                                <span class="button-group__label">I’m just exploring</span></label>
                                        </div>
                                    </div>
                                    <div class="title">
                                        <p>What all do you plan to offer?</p>
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="button-group button-group-2">
                                            @foreach ($serviceTypes as $type)
                                                <label class="button-group__btn">
                                                    <input type="checkbox" name="intended_service_type[]"
                                                        {{ !isset($current_mentor->intended_service_type)
                                                            ? (is_array(old('intended_service_type'))
                                                                ? (in_array($type->id, old('intended_service_type'))
                                                                    ? 'checked'
                                                                    : '')
                                                                : '')
                                                            : (in_array($type->id, json_decode($current_mentor->intended_service_type))
                                                                ? 'checked'
                                                                : '') }}
                                                        value="{{ $type->id }}" />
                                                    <span class="button-group__label">{{ $type->name }}</span></label>
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
                            @include('front.elements.side-testimonial-platform')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
