<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-12 col-6">
            <div class="headlogo"><a class="navbar-brand" href="<?=url('/dashboard')?>"><img class="img-fluid" src="<?=env('FRONT_DASHBOARD_ASSETS_URL')?>assets/img/logo.png" alt="logo"></a></div>
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
                                <a class="nav-link" href="<?=url('/dashboard')?>">Home</a>
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
                    <ul class="header-nav ms-3">
                        <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <div class="avatar avatar-md"><img class="avatar-img" src="<?=env('FRONT_DASHBOARD_ASSETS_URL')?>assets/img/avatars/8.jpg" alt="user@email.com"></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end pt-0">
                            <div class="dropdown-header bg-light py-2">
                                <div class="fw-semibold">Account</div>
                            </div>

                            <a class="dropdown-item" href="<?=url('/dashboard/profile')?>"><i class="fa-regular fa-user"></i> Profile</a>
                            <!-- <a class="dropdown-item" href="#"><i class="fa-solid fa-gear"></i> Settings</a>
                            <a class="dropdown-item" href="#"><i class="fa-regular fa-credit-card"></i> Payments</a> -->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?=url('dashboard/logout')?>">
                                <svg class="icon me-2">
                                <use xlink:href="<?=env('FRONT_DASHBOARD_ASSETS_URL')?>vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                                </svg> Logout
                            </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>