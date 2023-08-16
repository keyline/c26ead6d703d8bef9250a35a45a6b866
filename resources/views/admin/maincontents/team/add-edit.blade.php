<?php
use App\Helpers\Helper;
$controllerRoute = $module['controller_route'];
?>
<div class="pagetitle">
  <h1><?=$page_header?></h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=url('admin/dashboard')?>">Home</a></li>
      <li class="breadcrumb-item active"><a href="<?=url('admin/' . $controllerRoute . '/list/')?>"><?=$module['title']?> List</a></li>
      <li class="breadcrumb-item active"><?=$page_header?></li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<section class="section profile">
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
    if($row){
      $name           = $row->name;
      $image          = $row->image;
      $designation    = $row->designation;
      $qualification  = $row->qualification;
      $experience     = $row->experience;
      $bio            = $row->bio;
      $thought        = $row->thought;
    } else {
      $name           = '';
      $image          = '';
      $designation    = '';
      $qualification  = '';
      $experience     = '';
      $bio            = '';
      $thought        = '';
    }
    ?>
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body pt-3">
          <form method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
              <label for="name" class="col-md-2 col-lg-2 col-form-label">Name</label>
              <div class="col-md-10 col-lg-10">
                <input type="text" name="name" class="form-control" id="name" value="<?=$name?>" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="designation" class="col-md-2 col-lg-2 col-form-label">Designation</label>
              <div class="col-md-10 col-lg-10">
                <input type="text" name="designation" class="form-control" id="designation" value="<?=$designation?>" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="qualification" class="col-md-2 col-lg-2 col-form-label">Qualification</label>
              <div class="col-md-10 col-lg-10">
                <input type="text" name="qualification" class="form-control" id="qualification" value="<?=$qualification?>" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="experience" class="col-md-2 col-lg-2 col-form-label">Experience</label>
              <div class="col-md-10 col-lg-10">
                <input type="text" name="experience" class="form-control" id="experience" value="<?=$experience?>" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="thought" class="col-md-2 col-lg-2 col-form-label">Thought</label>
              <div class="col-md-10 col-lg-10">
                <textarea name="thought" class="form-control ckeditor" id="thought" required><?=$thought?></textarea>
              </div>
            </div>
            <div class="row mb-3">
              <label for="bio" class="col-md-2 col-lg-2 col-form-label">Bio</label>
              <div class="col-md-10 col-lg-10">
                <textarea name="bio" class="form-control ckeditor" id="bio" required><?=$bio?></textarea>
              </div>
            </div>
            <div class="row mb-3">
              <label for="image" class="col-md-2 col-lg-2 col-form-label">Image</label>
              <div class="col-md-10 col-lg-10">
                <input type="file" name="image" class="form-control" id="image">
                <small class="text-info">* Only JPG, JPEG, ICO, SVG, PNG files are allowed</small><br>
                <?php if($image != ''){?>
                  <img src="<?=env('UPLOADS_URL').'team/'.$image?>" class="img-thumbnail" alt="<?=$name?>" style="width: 150px; height: 150px; margin-top: 10px;">
                <?php } else {?>
                  <img src="<?=env('NO_IMAGE')?>" alt="<?=$name?>" class="img-thumbnail" style="width: 150px; height: 150px; margin-top: 10px;">
                <?php }?>
                
                <div class="pt-2">
                  <!-- <a href="#profile_image" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a> -->
                  <a href="javascript:void(0);" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                </div>
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary"><?=(($row)?'Save':'Add')?></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>