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
    $checkMentorDocument = UserDocument::where('user_id', '=', $mentor->user_id)->first();
    // Helper::pr($checkMentorDocument);
    ?>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body pt-3">
                <ul class="nav nav-tabs nav-tabs-bordered">
                  <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab1">Basic Details</button>
                  </li>
                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab2">Upload Document</button>
                  </li>
                </ul>
                <div class="tab-content pt-2">
                    <div class="tab-pane fade show active all-booking-overview" id="tab1">
                        <?php $profiledetail = User::where('id', '=', $mentor->user_id)->first(); ?>
                        <form method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="mode" value="updatebasic">
                            <div class="row mb-3">
                                <label for="first_name" class="col-md-2 col-lg-2 col-form-label">First Name</label>
                                <div class="col-md-10 col-lg-10">
                                    <input type="text" name="first_name" class="form-control" id="first_name" value="<?=$mentor->first_name?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="last_name" class="col-md-2 col-lg-2 col-form-label">Last Name</label>
                                <div class="col-md-10 col-lg-10">
                                    <input type="text" name="last_name" class="form-control" id="last_name" value="<?=$mentor->last_name?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="display_name" class="col-md-2 col-lg-2 col-form-label">Display Name</label>
                                <div class="col-md-10 col-lg-10">
                                    <input type="text" name="display_name" class="form-control" id="display_name" value="<?=$mentor->display_name?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-md-2 col-lg-2 col-form-label">Email</label>
                                <div class="col-md-10 col-lg-10">
                                    <input type="email" name="email" class="form-control" id="email" value="<?=$profiledetail->email?>" required readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="phone" class="col-md-2 col-lg-2 col-form-label">Phone</label>
                                <div class="col-md-10 col-lg-10">
                                    <input type="text" name="phone" class="form-control" id="phone" value="<?=$profiledetail->phone?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="team_meeting_link" class="col-md-2 col-lg-2 col-form-label">Team Meeting Link</label>
                                <div class="col-md-10 col-lg-10">
                                    <input type="text" name="team_meeting_link" class="form-control" id="team_meeting_link" value="<?=$mentor->team_meeting_link?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                              <label for="image" class="col-md-2 col-lg-2 col-form-label">Profile Image</label>
                              <div class="col-md-10 col-lg-10">
                                <input type="file" name="image" class="form-control" id="img_file" onChange="img_pathUrl(this);" >
                                <small class="text-info">* Only JPG, JPEG, ICO, SVG, PNG files are allowed</small><br>
                                <?php if($mentor->profile_pic != ''){?>
                                  <a href="<?=env('UPLOADS_URL').'user/'.$mentor->profile_pic?>" target="_blank" class="badge bg-info">View Profile Pic</a>
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
                                    <input type="hidden" name="type" value="mentor">
                                    <input type="hidden" name="mentor_id" value="<?=$mentor->id;?>">
                                    <input type="hidden" name="user_id" value="<?=$profiledetail->id;?>">
                                    <?php $allMentors = RequireDocument::where('user_type', '=', 'mentor')->get(); ?>
                                    <label for="service_type_id" class="col-md-2 col-lg-2 col-form-label">Document Type</label>
                                    <div class="col-md-10 col-lg-10">
                                        <select name="doucument_id" class="form-control" id="doucument_id" required>
                                        <option value="" selected>Select Document</option>
                                        <?php if($allMentors){ foreach($allMentors as $allMentor){?>
                                            <?php
                                            if(!empty($checkMentorDocument)){
                                                if($checkMentorDocument->doucument_id == $allMentor->id){
                                                    $selected = 'selected';
                                                } else {
                                                    $selected = '';
                                                }
                                            } else {
                                                $selected = 'selected';
                                            }
                                            ?> 
                                            <option value="<?=$allMentor->id;?>" <?=$selected?>><?=$allMentor->document;?></option>
                                        <?php } }  ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="image" class="col-md-2 col-lg-2 col-form-label">Document Scan Copy</label>
                                  <div class="col-md-10 col-lg-10">
                                    <input type="file" name="image" class="form-control" id="img_file" onChange="img_pathUrl(this);" >
                                    <small class="text-info">* Only JPG, JPEG, ICO, SVG, PNG, PDF files are allowed</small><br>
                                    <?php if(!empty($checkMentorDocument)){?>
                                        <?php if($checkMentorDocument->document != ''){?>
                                          <a href="<?=env('UPLOADS_URL').'user/'.$checkMentorDocument->document?>" target="_blank" class="badge bg-info">View Document</a>
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
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    function img_pathUrl(input){
        $('#img_url')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
    }
</script>