<?php
use App\Helpers\Helper;
use App\Models\User;
use App\Models\RequireDocument;
use App\Models\UserDocument;
$controllerRoute = $module['controller_route'];
?>
<div class="pagetitle">
  <h1><?=$page_header?></h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=url('admin/dashboard')?>">Home</a></li>
      <li class="breadcrumb-item active"><?=$page_header?></li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<section class="section">
  <div class="row">
    <div class="col-xl-12">
      @if(session('success_message'))
        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show autohide" role="alert">
          {{ session('success_message') }}
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      @if(session('error_message'))
        <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show autohide" role="alert">
          {{ session('error_message') }}
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
    </div>
    <?php
    $checkStudentDocument = UserDocument::where('user_id', '=', $student->user_id)->first();
    ?>
    <div class="col-lg-12">
            <div class="card">
              <div class="card-body pt-3">
                <ul class="nav nav-tabs nav-tabs-bordered">
                  <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab1">Basic Details</button>
                  </li>
                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab2">Upload Documents</button>
                  </li>
                </ul>
                <div class="tab-content pt-2">
                    <div class="tab-pane fade show active all-booking-overview" id="tab1">
                        <?php $profiledetail = User::where('id', '=', $student->user_id)->first(); ?>
                        <form method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="mode" value="updatebasic">
                            <div class="row mb-3">
                                <label for="first_name" class="col-md-2 col-lg-2 col-form-label">First Name</label>
                                <div class="col-md-10 col-lg-10">
                                    <input type="text" name="first_name" class="form-control" id="first_name" value="<?=$student->first_name?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="last_name" class="col-md-2 col-lg-2 col-form-label">Last Name</label>
                                <div class="col-md-10 col-lg-10">
                                    <input type="text" name="last_name" class="form-control" id="last_name" value="<?=$student->last_name?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="display_name" class="col-md-2 col-lg-2 col-form-label">Display Name</label>
                                <div class="col-md-10 col-lg-10">
                                    <input type="text" name="display_name" class="form-control" id="display_name" value="<?=$student->display_name?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-md-2 col-lg-2 col-form-label">Email</label>
                                <div class="col-md-10 col-lg-10">
                                    <input type="email" name="email" class="form-control" id="email" value="<?=$student->email?>" required readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="phone" class="col-md-2 col-lg-2 col-form-label">Phone</label>
                                <div class="col-md-10 col-lg-10">
                                    <input type="text" name="phone" class="form-control" id="phone" value="<?=$student->phone?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                              <label for="image" class="col-md-2 col-lg-2 col-form-label">Profile Image</label>
                              <div class="col-md-10 col-lg-10">
                                <input type="file" name="image" class="form-control" id="img_file" onChange="img_pathUrl(this);" >
                                <small class="text-info">* Only JPG, JPEG, ICO, SVG, PNG files are allowed</small><br>
                                <?php if($student->profile_pic != ''){?>
                                  <a href="<?=env('UPLOADS_URL').'user/'.$student->profile_pic?>" target="_blank" class="badge bg-info">View Profile Pic</a>
                                <?php } else {?>
                                  <a href="<?=env('NO_IMAGE')?>" target="_blank" class="badge bg-info">View Profile Pic</a>
                                <?php }?>
                              </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <div class="table-responsive">
                          <div class="card">
                            <div class="card-body pt-3">
                              <form method="POST" action="" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="mode" value="updateDocument">
                                <div class="row mb-3">
                                    <input type="hidden" name="type" value="student">
                                    <input type="hidden" name="user_id" value="<?=$profiledetail->id;?>">
                                    <?php $allStudents = RequireDocument::where('user_type', '=', 'student')->get(); ?>
                                    <label for="service_type_id" class="col-md-2 col-lg-2 col-form-label">Document Type</label>
                                    <div class="col-md-10 col-lg-10">
                                        <select name="doucument_id" class="form-control" id="doucument_id" required>
                                        <option value="" selected>Select Document</option>
                                        <?php if($allStudents){ foreach($allStudents as $allStudent){?>
                                            <?php
                                            if(!empty($checkStudentDocument)){
                                                if($checkStudentDocument->doucument_id == $allStudent->id){
                                                    $selected = 'selected';
                                                } else {
                                                    $selected = '';
                                                }
                                            } else {
                                                $selected = 'selected';
                                            }
                                            ?>
                                            <option value="<?=$allStudent->id;?>" <?=$selected?>><?=$allStudent->document;?></option>
                                        <?php } }  ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="image" class="col-md-2 col-lg-2 col-form-label">Document Scan Copy</label>
                                  <div class="col-md-10 col-lg-10">
                                    <input type="file" name="image" class="form-control" id="img_file" onChange="img_pathUrl(this);" >
                                    <small class="text-info">* Only JPG, JPEG, ICO, SVG, PNG, PDF files are allowed</small><br>
                                    <?php if(!empty($checkStudentDocument)){?>
                                        <?php if($checkStudentDocument->document != ''){?>
                                          <a href="<?=env('UPLOADS_URL').'user/'.$checkStudentDocument->document?>" target="_blank" class="badge bg-info">View Document</a>
                                        <?php } else {?>
                                          <a href="<?=env('NO_IMAGE')?>" target="_blank" class="badge bg-info">View Document</a>
                                        <?php }?>
                                    <?php } else {?>
                                        <a href="<?=env('NO_IMAGE')?>" target="_blank" class="badge bg-info">View Document</a>
                                    <?php }?>
                                  </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
  </div>
  </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    function img_pathUrl(input){
        $('#img_url')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
    }
</script>