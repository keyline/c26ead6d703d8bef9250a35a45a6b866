<div class="container">
    <div class="auth-logo">
        <a href="<?=url('/')?>">
            <img src="<?=env('UPLOADS_URL').$generalSetting->site_logo?>" alt="<?=$generalSetting->site_name?>">
        </a>
    </div>
    <div class="auth-layout-inner">
        <h3><?=$page_header?></h3>
        <p>Please register here to explore more about the community.</p>
        <form method="POST" id="signup_form" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" class="form-control" name="key" id="key" value="facb6e0a6fcbe200dca2fb60dec75be7">
            <input type="hidden" class="form-control" name="source" id="source" value="WEB">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="name">Full Name *</label>
                    <input type="text" class="form-control requiredCheck" placeholder="John Keller" name="name" id="name" data-check="Name">
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email *</label>
                    <input type="Email" class="form-control requiredCheck" placeholder="john@example.com" name="email" id="email" data-check="Email">
                </div> 
                <div class="form-group col-md-6">
                    <label for="country">Country *</label>
                    <!-- <select class="form-control requiredCheck" id="country" name="country" data-check="Country">
                        <option value="" selected>Select Country</option>
                        <?php if($countries){ foreach($countries as $country){?>
                        <option value="<?=$country->id?>"><?=$country->name?></option>
                        <?php } }?>
                    </select> -->
                    <select class="form-control selectpicker countrypicker" data-flag="true" data-countries="AE"></select>
                </div>                
                <div class="form-group col-md-6">
                    <label for="phone">Phone *</label>
                    <input type="text" class="form-control requiredCheck" placeholder="9876543210" id="phone" name="phone" data-check="Phone" value="+971" onkeypress="return isNumber(event)" minlength="9" maxlength="15">
                </div>
                <div class="form-group col-md-6 p-lelative">
                    <label for="password">Password *</label>
                    <input type="password" class="form-control requiredCheck" id="password" name="password" placeholder="Password" data-check="Password">
                </div>
                <div class="form-group col-md-6 p-lelative">
                    <label for="confirm_password">Confirm Password *</label>
                    <input type="password" class="form-control requiredCheck" id="confirm_password" name="confirm_password" placeholder="Confirm Password" data-check="Confirm Password">
                </div>
                <div class="button col-md-12 mt-3 mb-2">
                    <input type="submit" value="SIGN UP" class="theme-btn">
                </div>
                <div class="form-group col-md-12">
                    <p>Already have account ? <a href="{{ url('/signin') }}">Sign In</a></p>
                </div>
                <div class="col-md-12">
                    <small>By clicking Signup, you agree to the Autotranslate 
                    <a href="<?=url('page/user-agreement')?>" target="_blank">User Agreement</a>, 
                    <a href="<?=url('page/privacy-policy')?>" target="_blank">Privacy Policy</a>, and 
                    <a href="<?=url('page/cookie-policy')?>" target="_blank">Cookie Policy</a></small>                   
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    page = 'signup';
</script>
<script src="//cdn.tutorialjinni.com/jquery/3.6.1/jquery.min.js"></script>
<script src="//cdn.tutorialjinni.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="//cdn.tutorialjinni.com/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
<script src="//g.tutorialjinni.com/mojoaxel/bootstrap-select-country/dist/js/bootstrap-select-country.min.js"></script>