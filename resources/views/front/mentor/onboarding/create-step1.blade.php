@extends('front.layouts.master', ['title' => 'Mentor Signup', 'pageName' => 'mentor-signup'])
@section('content')
    <?php $readonly = $data['user_id'] > 0 ? 'readonly' : ''; ?>

    <section class="login-section singup-section">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-lg-5 col-md-8 col-sm-8">
                    <div class="login-box signup-box">
                        <div class="icon-box-1">
                            <img src="{{ env('FRONT_ASSETS_URL') }}assets/images/lamp.webp" alt="">
                        </div>
                        <h3>Mentor Signup !</h3>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('mentor.create.step1') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="First name" name="first_name"
                                    {{ $readonly }}
                                    value="{{ !isset($data['mentor']->first_name) ? old('first_name') : $data['mentor']->first_name }}">
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Last name" name="last_name"
                                    {{ $readonly }}
                                    value="{{ !isset($data['mentor']->last_name) ? old('last_name') : $data['mentor']->last_name }}">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Email address" name="email"
                                    {{ $readonly }}
                                    value="{{ !isset($data['mentor']->email) ? old('email') : $data['mentor']->email }}">
                            </div>

                            <div class="form-group">
                                <input type="tel" class="form-control" id="phone" placeholder="Phone number"
                                    name="phone_number" {{ $readonly }}
                                    value="{{ !isset($data['mentor']->mobile) ?old('phone_number') : $data['mentor']->mobile }}">
                            </div>

                            <div class="form-group form_password">
                                <input type="password" class="form-control" placeholder="Set password" name="password"
                                    id="password">
                                <i class="fa-regular fa-eye" id="togglePassword" onclick="eyeOpen();"></i>
                                <i class="fa-regular fa-eye-slash" id="togglePassword2" onclick="eyeClose();"
                                    style="display:none;"></i>
                            </div>

                            <div class="form-group form_password">
                                <input type="password" class="form-control" placeholder="Confirm password"
                                    name="password_confirmation" id="confirm_password">
                                <i class="fa-regular fa-eye" id="togglePassword11" onclick="eyeConfirmOpen();"></i>
                                <i class="fa-regular fa-eye-slash" id="togglePassword22" onclick="eyeConfirmClose();"
                                    style="display:none;"></i>
                            </div>

                            <div class="form-group">
                                @if ($data['user_id'] > 0)
                                    <a href="{{ url('mentor/step2') }}" class="next-a_btn">Next</a>
                                @else
                                    <button class="login-btn">Sign Up</button>
                                @endif

                            </div>

                        </form>

                        <div class="form-group mb-1">
                            <p>
                                <span>Already have an account? <a href="<?= url('signin') ?>"> Sign In</a></span>
                            </p>
                        </div>
                        <div class="form-group mb-0">
                            <p>
                                <span>Don't have a student account? <a href="<?= url('student-signup') ?>"> Student Sign
                                        Up</a></span>
                            </p>
                        </div>
                        <!-- <div class="icon-box-2">
                                                          <img src="{{ env('FRONT_ASSETS_URL') }}assets/images/signup-logo.webp" alt="">
                                                          </div> -->
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
<script type="text/javascript">
    function eyeOpen() {
        $('#password').attr('type', 'text');
        $('#togglePassword').hide();
        $('#togglePassword2').show();
    }

    function eyeClose() {
        $('#password').attr('type', 'password');
        $('#togglePassword').show();
        $('#togglePassword2').hide();
    }


    function eyeConfirmOpen() {
        $('#confirm_password').attr('type', 'text');
        $('#togglePassword11').hide();
        $('#togglePassword22').show();
    }

    function eyeConfirmClose() {
        $('#confirm_password').attr('type', 'password');
        $('#togglePassword11').show();
        $('#togglePassword22').hide();
    }


</script>
