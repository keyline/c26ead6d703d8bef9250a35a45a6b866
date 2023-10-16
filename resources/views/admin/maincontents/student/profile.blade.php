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
    <?php $checkStudentDocument = UserDocument::where('user_id', '=', $student->user_id)->first();
        if($checkStudentDocument){ ?>
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
                        <div class="table-responsive">
                            <table style="width: 100%;  border-spacing: 2px;">
                                <tbody>
                                    <?php $profiledetail = User::where('id', '=', $student->user_id)->first(); ?>
                                    <tr>
                                        <th style="background: #ccc; color: #000; width: 30%; padding: 10px; text-align: left; font-family: sans-serif; font-size: 14px;">Full Name</th>
                                        <td style="padding: 10px; background: #ccc; text-align: left; color: #000;font-family: sans-serif;font-size: 15px;"><?=$student->first_name . ' ' . $student->last_name; ?></td>
                                    </tr>
                                    <tr>
                                        <th style="background: #cccccc42; color: #000; width: 30%; padding: 10px; text-align: left; font-family: sans-serif; font-size: 14px;">Email Address</th>
                                        <td style="padding: 10px; background: #cccccc42; text-align: left; color: #000;font-family: sans-serif;font-size: 15px;"><?=$profiledetail->email;?></td>
                                    </tr>
                                    <tr>
                                        <th style="background: #ccc; color: #000; width: 30%; padding: 10px; text-align: left; font-family: sans-serif; font-size: 14px;">Phone</th>
                                        <td style="padding: 10px; background: #ccc; text-align: left; color: #000;font-family: sans-serif;font-size: 15px;"><?=$student->phone;?></td>
                                    </tr>
                                    <tr>
                                        <th style="background: #cccccc42; color: #000; width: 30%; padding: 10px; text-align: left; font-family: sans-serif; font-size: 14px;">Registered at</th>
                                        <td style="padding: 10px; background: #cccccc42; text-align: left; color: #000;font-family: sans-serif;font-size: 15px;"><?=date_format(date_create($profiledetail->created_at), "M d, Y h:i A")?></td>
                                    </tr>
                                    <tr>
                                        <th style="background: #ccc; color: #000; width: 30%; padding: 10px; text-align: left; font-family: sans-serif; font-size: 14px;">Profile Pic</th>
                                        <td style="padding: 10px; background: #ccc; text-align: left; color: #000;font-family: sans-serif;font-size: 15px;">
                                        <?php if($student->profile_pic != ''){?>
                                            <img src="<?=env('UPLOADS_URL').'/'.$student->profile_pic?>" class="img-thumbnail" alt="<?=$student->first_name.' '.$student->last_name?>" style="width: 150px; height: 150px; margin-top: 10px;">
                                        <?php } else {?>
                                            <img src="<?=env('NO_IMAGE')?>" alt="<?=$student->first_name.' '.$student->last_name?>" class="img-thumbnail" style="width: 150px; height: 150px; margin-top: 10px;">
                                        <?php }?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
                                        <option value="<?=$allStudent->id;?>" <?=(($checkStudentDocument->doucument_id == $allStudent->id )?'Selected':'')?> ><?=$allStudent->document;?></option>
                                    <?php } }  ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                              <label for="image" class="col-md-2 col-lg-2 col-form-label">Document Scan Copy</label>
                              <div class="col-md-10 col-lg-10">
                                <input type="file" name="image" class="form-control" id="img_file" onChange="img_pathUrl(this);" >
                                <small class="text-info">* Only JPG, JPEG, ICO, SVG, PNG, PDF files are allowed</small><br>
                                <?php if($checkStudentDocument->document != ''){?>
                                  <img src="<?=env('UPLOADS_URL').'user/'.$checkStudentDocument->document?>" class="img-thumbnail" alt="<?=$checkStudentDocument->document?>" style="height: 110px; margin-top: 10px;" id="img_url">
                                <?php } else {?>
                                  <img src="<?=env('NO_IMAGE')?>" alt="<?=$checkStudentDocument->document?>" class="img-thumbnail" style="height: 110px; margin-top: 10px;">
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
           
        <?php }else{ ?>
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
                        <div class="table-responsive">
                            <table style="width: 100%;  border-spacing: 2px;">
                                <tbody>
                                    <?php $profiledetail = User::where('id', '=', $student->user_id)->first(); ?>
                                    <tr>
                                        <th style="background: #ccc; color: #000; width: 30%; padding: 10px; text-align: left; font-family: sans-serif; font-size: 14px;">Full Name</th>
                                        <td style="padding: 10px; background: #ccc; text-align: left; color: #000;font-family: sans-serif;font-size: 15px;"><?=$student->first_name . ' ' . $student->last_name; ?></td>
                                    </tr>
                                    <tr>
                                        <th style="background: #cccccc42; color: #000; width: 30%; padding: 10px; text-align: left; font-family: sans-serif; font-size: 14px;">Email Address</th>
                                        <td style="padding: 10px; background: #cccccc42; text-align: left; color: #000;font-family: sans-serif;font-size: 15px;"><?=$profiledetail->email;?></td>
                                    </tr>
                                    <tr>
                                        <th style="background: #ccc; color: #000; width: 30%; padding: 10px; text-align: left; font-family: sans-serif; font-size: 14px;">Phone</th>
                                        <td style="padding: 10px; background: #ccc; text-align: left; color: #000;font-family: sans-serif;font-size: 15px;"><?=$student->mobile;?></td>
                                    </tr>
                                    <tr>
                                        <th style="background: #cccccc42; color: #000; width: 30%; padding: 10px; text-align: left; font-family: sans-serif; font-size: 14px;">Registered at</th>
                                        <td style="padding: 10px; background: #cccccc42; text-align: left; color: #000;font-family: sans-serif;font-size: 15px;"><?=date_format(date_create($profiledetail->created_at), "M d, Y h:i A")?></td>
                                    </tr>
                                    <tr>
                                        <th style="background: #ccc; color: #000; width: 30%; padding: 10px; text-align: left; font-family: sans-serif; font-size: 14px;">Profile Pic</th>
                                        <td style="padding: 10px; background: #ccc; text-align: left; color: #000;font-family: sans-serif;font-size: 15px;">
                                        <?php if($student->profile_pic != ''){?>
                                            <img src="<?=$student->profile_pic?>" class="img-thumbnail" alt="<?=$student->first_name.' '.$student->last_name?>" style="width: 150px; height: 150px; margin-top: 10px;">
                                            <?php } else {?>
                                            <img src="<?=env('NO_IMAGE')?>" alt="<?=$student->first_name.' '.$student->last_name?>" class="img-thumbnail" style="width: 150px; height: 150px; margin-top: 10px;">
                                            <?php }?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                  </div>
                  <div class="tab-pane" id="tab2">
                    <div class="table-responsive">
                      <div class="card">
                        <div class="card-body pt-3">
                          <form method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <input type="hidden" name="type" value="student">
                                <input type="hidden" name="user_id" value="<?=$profiledetail->id;?>">
                                <?php $allStudents = RequireDocument::where('user_type', '=', 'student')->get(); ?>
                                <label for="service_type_id" class="col-md-2 col-lg-2 col-form-label">Document Type</label>
                                <div class="col-md-10 col-lg-10">
                                    <select name="doucument_id" class="form-control" id="doucument_id" required>
                                    <option value="" selected>Select Document</option>
                                    <?php if($allStudents){ foreach($allStudents as $allStudent){?>
                                        <option value="<?=$allStudent->id;?>" ><?=$allStudent->document;?></option>
                                    <?php } }  ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="image" class="col-md-2 col-lg-2 col-form-label">Document Scan Copy</label>
                                <div class="col-md-10 col-lg-10">
                                    <input type="file" name="image" class="form-control" id="img_file" onChange="img_pathUrl(this);">
                                    <small class="text-info">* Only JPG, JPEG, ICO, SVG, PNG, PDF files are allowed, File size upto 1MB </small><br>
                                    <img src="<?=env('NO_IMAGE')?>" alt="" class="img-thumbnail" style="height: 110px; margin-top: 10px;" id="img_url">
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
      <?php  } ?>
  </div>
  </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    function img_pathUrl(input){
        $('#img_url')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
    }
</script>