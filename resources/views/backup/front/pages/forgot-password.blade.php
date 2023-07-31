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
            <div class="inner-form">
                <div class="form-group">
                   <label for="email">Email *</label>
                   <input type="Email" class="form-control" placeholder="john@example.com" name="email" id="email" required>
                </div>
                <div class="row">
                    <div class="button col-md-12 mt-3 mb-2">
                       <input type="submit" value="SUBMIT" class="theme-btn">
                    </div>
                    <div class="form-group col-md-12">
                        <p>Don't have account yet ? <a href="{{ url('/signup') }}">Sign Up</a></p>
                        <p>Already have account ? <a href="{{ url('/signin') }}">Sign In</a></p>
                    </div>                   
                </div>
            </div>
        </form>
    </div> 
</div>
<script>
    page = 'forgot-password';
</script>