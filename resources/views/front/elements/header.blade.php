<div class="container">
   <div class="row">
      <div class="col-lg-3 col-md-4 col-sm-12 col-6">
         <div class="headlogo"><a class="navbar-brand" href="<?=url('/')?>"><img class="img-fluid" src="<?=env('UPLOADS_URL').$generalSetting->site_logo?>" alt="<?=$generalSetting->site_name?>"></a></div>
      </div>
      <div class="col-lg-9 col-md-8 col-sm-12">
         <div class="head_menusection">
            <nav class="navbar navbar-expand-lg navbar-light">
               <button class="navbar-toggler" type="button" id="myNavbarToggler4" aria-label="Toggle navigation">
               <i class="fa fa-bars" aria-hidden="true"></i>
               </button>
               <div class="offcanvas-collapse navbar-collapse" id="myNavbarToggler4">
                  <button class="navbar-toggler  mobileclose" type="button" data-toggle="collapse" data-target="#myNavbarToggler4" aria-controls="myNavbarToggler4" aria-expanded="false" aria-label="Toggle navigation">
                  <i class="zmdi zmdi-close"></i>
                  </button>
                  <ul class="navbar-nav">
                     <li class="nav-item active">
                        <a class="nav-link" href="<?=url('/')?>">Home</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="<?=url('mentors')?>">Mentors</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="<?=url('blogs')?>">Resources</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="<?=url('how-it-works')?>">How it works</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="#">Take a free test</a>
                     </li>
                  </ul>
               </div>
            </nav>
            <div class="header_loginbtn">
               <ul>
                  <li>
                     <a class="btn_border" href="<?=url('signin')?>">Sign In</a>
                  </li>
                  <li>
                     <a class="btn_orgfill" href="<?=route('mentor.signup')?>">Sign up free</a>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>