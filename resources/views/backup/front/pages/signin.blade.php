<div class="container">
    <div class="auth-logo">
        <a href="<?=url('/')?>">
            <img src="<?=env('UPLOADS_URL').$generalSetting->site_logo?>" alt="<?=$generalSetting->site_name?>">
        </a>
    </div>
    <div class="auth-layout-inner">
        <h3><?=$page_header?></h3>
        <p>Please login to continue to your account.</p>
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
        <form method="POST" id="signin_form" enctype="multipart/form-data">
            @csrf
            <div class="inner-form">
                <div class="form-group">
                   <label for="email">Email *</label>
                   <input type="email" class="form-control" placeholder="john@example.com" name="email" id="email" required>
                </div>    
                <div class="form-group p-lelative">
                    <label for="pass_log_id">Password *</label>
                    <input type="password" class="form-control" id="pass_log_id" name="password" placeholder="Password" required>
                </div>
                <div class="row">
                    <div class="button col-md-12 mt-3 mb-2">
                       <input type="submit" value="SIGN IN" class="theme-btn">
                    </div>
                    <div class="form-group col-md-12">
                        <p>Forgot Password <a href="{{ url('/forgot-password') }}">Click Here</a></p>
                    </div>
                    <div class="form-group col-md-12">
                        <p>Don't have account yet ? <a href="{{ url('/signup') }}">Sign Up</a></p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    page = 'signin';
</script>