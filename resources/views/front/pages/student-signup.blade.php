<section class="login-section singup-section">
    <div class="container">

        <div class="row justify-content-around">
            <div class="col-lg-5 col-md-8 col-sm-8">

                @if (session('error_message'))
                    <div class="alert alert-danger" style="padding:10px 1rem;">
                        {{ session('error_message') }}
                    </div>
                @endif

                <div class="login-box signup-box">
                    <div class="icon-box-1">
                        <img src="<?= env('FRONT_ASSETS_URL') ?>assets/images/lamp.webp" alt="">
                    </div>
                    <h3>Student Signup !</h3>
                    <small class="text-danger">* All fields are mandatory</small>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="<?= url('signup') ?>" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="hidden" class="form-control" name="key" id="key"
                            value="facb6e0a6fcbe200dca2fb60dec75be7">
                        <input type="hidden" class="form-control" name="source" id="source" value="WEB">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <!-- <span class="text-danger">* Required</span> -->
                                    <input type="text" class="form-control" name="fname" id="fname"
                                        placeholder="First name" data-check="First name" value="{{old('fname')}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <!-- <span class="text-danger">* Required</span> -->
                                    <input type="text" class="form-control" name="lname" id="lname"
                                        placeholder="Last name" data-check="Last name" value="{{old('lname')}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- <span class="text-danger">* Required</span> -->
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="Email address" data-check="Email address" required value="{{old('email')}}">
                        </div>
                        <div class="form-group">
                            <!-- <span class="text-danger">* Required</span> -->
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone number" data-check="Phone number" required maxlength="10" minlength="10" onkeypress="return isNumber(event)" value="{{old('phone')}}">
                        </div>
                        <div class="form-group form_password ">
                            <!-- <span class="text-danger">* Required</span> -->
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Set password" data-check="Set password" required>
                            <i class="fa-regular fa-eye" id="togglePassword" onclick="eyeOpen();"></i>
                            <i class="fa-regular fa-eye-slash" id="togglePassword2" onclick="eyeClose();"
                                style="display:none;"></i>
                        </div>
                        <div class="form-group form_password">
                            <!-- <span class="text-danger">* Required</span> -->
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password"
                                placeholder="Confirm password" data-check="Confirm password" required>
                            <i class="fa-regular fa-eye" id="togglePassword11" onclick="eyeConfirmOpen();"></i>
                            <i class="fa-regular fa-eye-slash" id="togglePassword22" onclick="eyeConfirmClose();"
                                style="display:none;"></i>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="login-btn">Sign Up</button>
                        </div>
                    </form>
                    <div class="form-group mb-1">
                        <p>
                            <span>Already have an account? <a href="<?= url('signin') ?>"> Sign In</a></span>
                        </p>
                    </div>
                    <div class="form-group mb-0">
                        <p>
                            <span>Don't have a mentor account? <a href="<?= url('mentor/signup') ?>"> Mentor Sign
                                    Up</a></span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="rightside_testslider">
                    <div class="login_sidebar_testimorial">
                        <?= $bookingReviewData ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>