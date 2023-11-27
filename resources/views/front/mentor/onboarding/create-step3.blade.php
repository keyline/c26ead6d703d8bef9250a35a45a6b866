@extends('front.layouts.master', ['title' => 'Mentor Signup', 'pageName' => 'mentor-signup-3'])
@section('content')
    <section class="mentor_element">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="metor_dashboard_top">
                        <div class="metor_progess">
                            <div class="stepper-wrapper">
                                <div class="stepper-item first + completed"></div>
                                <div class="stepper-item  + completed">
                                </div>
                                <div class="stepper-item  + active">
                                    <img class="img-fluid" src="{{ env('FRONT_ASSETS_URL') }}assets/images/bulb_icon.png"
                                        alt="logo">
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
                            <h2>Let's add some services</h2>
                            <p class="text-muted mb-4">We‘ll help you get set up based on your expertise</p>
                            <div class="metor_step1_form">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @if (count($errors->all()) > 1)
                                                @break
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('mentor.create.step3') }}" method="POST">
                                @csrf
                                <div class="title">
                                    <p>Select your expertise</p>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="button-group button-group-2 check_roundbtn" id="buttons">
                                        @foreach ($services as $service)
                                            <label class="button-group__btn"><input type="radio" name="service"
                                                    value="{{ $service->slug }}" wt-checkbox
                                                    {{ old('service') == $service->slug ? 'checked' : '' }} />
                                                <span class="button-group__label">{{ $service->name }}</span></label>
                                        @endforeach
                                        <!-- <label class="button-group__btn"><input type="checkbox" name="check" /> <span class="button-group__label">Career Counselling</span></label> -->
                                        <!-- <label class="button-group__btn"><input type="checkbox" name="check" /> <span class="button-group__label">Cybersecurity</span></label>
                                  <label class="button-group__btn"><input type="checkbox" name="check" /> <span class="button-group__label">Law</span></label>
                                  <label class="button-group__btn"><input type="checkbox" name="check" /> <span class="button-group__label">Content & Branding</span></label>
                                  <label class="button-group__btn"><input type="checkbox" name="check" /> <span class="button-group__label">Others</span></label>
                                  <label class="button-group__btn"><input type="checkbox" name="check" /> <span class="button-group__label">HR</span></label>
                                  <label class="button-group__btn"><input type="checkbox" name="check" /> <span class="button-group__label">Software</span></label>
                                  <label class="button-group__btn"><input type="checkbox" name="check" /> <span class="button-group__label">Product</span></label>
                                  <label class="button-group__btn"><input type="checkbox" name="check" /> <span class="button-group__label">Study Abroad</span></label>
                                  <label class="button-group__btn"><input type="checkbox" name="check" /> <span class="button-group__label">Finance</span></label>
                                  <label class="button-group__btn"><input type="checkbox" name="check" /> <span class="button-group__label">Design</span></label>
                                  <label class="button-group__btn"><input type="checkbox" name="check" /> <span class="button-group__label">Data</span></label>  -->
                                    </div>
                                </div>
                                <!-- perfect example of a blade component -->
                                <!-- mental health section -->
                                <!-- start -->


                                @foreach ($services as $service)
                                    @if ($service->id === 1)
                                        @foreach ($types as $type)
                                            @if ($type->serviceAttributes->isNotEmpty())
                                                <div wt-toggle="service-{{ $service->slug }}" class="wrapper-service"
                                                    style="display:none">
                                                    <div class="title">
                                                        <!-- <p>Popular <strong>1:1 services</strong>  in your expertise</p> -->
                                                        <p>Popular <strong>{{ $type->name }}</strong> in your
                                                            expertise</p>

                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="button-group button-group-2 check_halfbtn">
                                                            @foreach ($type->serviceAttributes as $attribute)
                                                                <label class="button-group__btn"><input
                                                                        class="services__to__select" type="checkbox"
                                                                        name="services[]"
                                                                        value="{{ $attribute->id }}" /> <span
                                                                        class="button-group__label">{{ $attribute->title }}</span></label>
                                                            @endforeach
                                                            <!-- <label class="button-group__btn"><input type="checkbox" name="check" /> <span class="button-group__label">Emergency</span></label>
                                  <label class="button-group__btn"><input type="checkbox" name="check" /> <span class="button-group__label">Discovery call</span></label>
                                  <label class="button-group__btn"><input type="checkbox" name="check" /> <span class="button-group__label">Discovery Call</span></label>
                                  <label class="button-group__btn"><input type="checkbox" name="check" /> <span class="button-group__label">1st Session</span></label>
                                  <label class="button-group__btn"><input type="checkbox" name="check" /> <span class="button-group__label">Regular Session</span></label>  -->
                                                        </div>
                                                    </div>

                                                </div>
                                            @endif
                                        @endforeach
                                    @endif

                                    @if ($service->id === 2)
                                        @foreach ($mental_health as $type)
                                            @if ($type->serviceAttributes->isNotEmpty())
                                                <div wt-toggle="service-{{ $service->slug }}" class="wrapper-service"
                                                    id="{{ $service->name }}" style="display:none">
                                                    <div class="title">
                                                        <!-- <p>Popular <strong>1:1 services</strong>  in your expertise</p> -->
                                                        <p>Popular <strong>{{ $type->name }}</strong> in your
                                                            expertise</p>

                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="button-group button-group-2 check_halfbtn">
                                                            @foreach ($type->serviceAttributes as $attribute)
                                                                <label class="button-group__btn"><input
                                                                        class="services__to__select" type="checkbox"
                                                                        name="services[]"
                                                                        value="{{ $attribute->id }}" /> <span
                                                                        class="button-group__label">{{ $attribute->title }}</span></label>
                                                            @endforeach
                                                            <!-- <label class="button-group__btn"><input type="checkbox" name="check" /> <span class="button-group__label">Emergency</span></label>
                                  <label class="button-group__btn"><input type="checkbox" name="check" /> <span class="button-group__label">Discovery call</span></label>
                                  <label class="button-group__btn"><input type="checkbox" name="check" /> <span class="button-group__label">Discovery Call</span></label>
                                  <label class="button-group__btn"><input type="checkbox" name="check" /> <span class="button-group__label">1st Session</span></label>
                                  <label class="button-group__btn"><input type="checkbox" name="check" /> <span class="button-group__label">Regular Session</span></label>  -->
                                                        </div>
                                                    </div>

                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach

                                <!-- end -->

                                <!-- <div class="title">
                               <p>Popular <strong>Priority DM</strong>  services in your expertise</p>
                            </div>
                            <div class="input-group mb-3">
                               <div class="button-group button-group-2 check_halfbtn">
                                  <label class="button-group__btn"><input type="checkbox" name="check" /> <span class="button-group__label">Follow-up Session</span></label>
                                  <label class="button-group__btn"><input type="checkbox" name="check" /> <span class="button-group__label">Emergency</span></label>
                                  <label class="button-group__btn"><input type="checkbox" name="check" /> <span class="button-group__label">Discovery call</span></label>
                               </div>
                            </div> -->
                                <div class="input-group mb-3">
                                    <!--<button class="next-btn">Next</button>-->
                                    <!-- <a href="mentor3.html" class="next-btn">Next</a> -->
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
@push('scripts')
<script>
    $.fn.WT_CHECKBOX = function($this) {
        var name = $this.attr('name'),
            checked = $this.val();
        console.log({
            'name': name,
            'checked': checked,
            'is_checked': $this.prop("checked")
        });

        $('div.wrapper-service').hide();
        if ($this.prop("checked")) {
            var checkboxes = $('[wt-toggle=' + name + '-' + checked + ']').find('.services__to__select');
            $(checkboxes).each(function() {
                this.checked = !$this.prop("checked");
            });

        }


        $('[wt-toggle=' + name + '-' + checked + ']').slideToggle();
    };
    $('[wt-checkbox]').on('change', function() {
        $.fn.WT_CHECKBOX($(this));
    }).load($.fn.WT_CHECKBOX($('[wt-checkbox]:checked')));
</script>
@endpush
