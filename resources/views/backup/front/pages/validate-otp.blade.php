<style type="text/css">
    .timer {
        font-weight: bold;
        font-size: 20px;
        color: #2151a5;
        font-style: italic;
    }
</style>
<div class="container">
    <div class="auth-logo">
        <a href="<?=url('/')?>">
            <img src="<?=env('UPLOADS_URL').$generalSetting->site_logo?>" alt="<?=$generalSetting->site_name?>">
        </a>
    </div>
    <div class="auth-layout-inner">
        <h3><?=$page_header?></h3>
        <p>Reset the password in two easy steps.</p>
        @if(session('success_message'))
            <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show autohide" role="alert">
              {{ session('success_message') }}
            </div>
        @endif
        @if(session('error_message'))
            <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show autohide" role="alert">
              {{ session('error_message') }}
            </div>
        @endif
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="form-control" name="id" id="id" value="<?=$id?>">
            <div class="row">
                <div class="form-group col-md-12">
                    <ul class="otp-input">
                        <li>
                            <input class="otp requiredCheck" name="otp1" id="otp1" type="password" oninput='digitValidate(this)' onkeyup='tabChange(1)' maxlength=1 data-check="OTP" autocomplete="off">
                        </li>
                        <li>
                            <input class="otp requiredCheck" name="otp2" id="otp2" type="password" oninput='digitValidate(this)' onkeyup='tabChange(2)' maxlength=1 data-check="OTP" autocomplete="off">
                        </li>
                        <li>
                            <input class="otp requiredCheck" name="otp3" id="otp3" type="password" oninput='digitValidate(this)' onkeyup='tabChange(3)' maxlength=1 data-check="OTP" autocomplete="off">
                        </li>
                        <li>
                            <input class="otp requiredCheck" name="otp4" id="otp4" type="password" oninput='digitValidate(this)'onkeyup='tabChange(4)' maxlength=1 data-check="OTP" autocomplete="off">
                        </li>
                    </ul>
                </div>                 
            </div>
            <div class="row">
                <div class="button col-md-12 mt-3 mb-2">
                   <input type="submit" value="VERIFY" class="theme-btn">
                </div>
            </div>
        </form>
        <div timer id='timer' class=timer></div>
        <div class="row" id="resend-div" style="display: none;">
            <div class="form-group col-md-12">
                <p>Did not received the code ? <button class="resendbtn" onclick="resendOTP(<?=$id?>);">Resend OTP</button></p>
            </div>    
        </div>
    </div>
</div>
<script>
    page = 'validate-otp';
</script>