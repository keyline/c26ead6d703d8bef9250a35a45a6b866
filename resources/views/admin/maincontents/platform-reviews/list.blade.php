<?php
use App\Models\Booking;
use App\Models\ServiceType;
use App\Models\Service;
use App\Models\ServiceAttribute;
use App\Models\ServiceDetail;
use App\Models\ServiceTypeAttribute;
use App\Models\User;
use App\Helpers\Helper;
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
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body pt-3">
          <div class="table-responsive">
            <table class="table datatable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>User Type</th>
                  <th>User</th>
                  <th>Rating</th>
                  <th>Review</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if($feedbacks) { $sl=1; foreach($feedbacks as $row){
                  if($row->user_type == 'STUDENT'){
                    $user = User::where('id', '=', $row->user_id)->first();
                  } else {
                    $user = User::where('id', '=', $row->user_id)->first();
                  }
                ?>
                  <tr>
                    <td><?=$sl++?></td>
                    <td><?=$row->user_type?></td>
                    <td>
                        <h6><i class="fa fa-user"></i> <?=(($user)?$user->name:'')?></h6>
                        <h6><i class="fa fa-envelope"></i> <?=(($user)?$user->email:'')?></h6>
                        <h6><i class="fa fa-mobile"></i> <?=(($user)?$user->phone:'')?></h6>
                    </td>
                    <td><?=$row->rating?></td>
                    <td><?=wordwrap($row->review,25,"<br>\n")?></td>
                    <td>
                      <?php if($row->status){?>
                        <a href="<?=url('admin/' . $controllerRoute . '/change-status/'.Helper::encoded($row->id))?>" class="btn btn-success btn-sm"><i class="fa fa-times"></i> Click To Deapprove</a>
                      <?php } else {?>
                        <a href="<?=url('admin/' . $controllerRoute . '/change-status/'.Helper::encoded($row->id))?>" class="btn btn-danger btn-sm"><i class="fa fa-check"></i> Click To Approve</a>
                        <a href="<?=url('admin/' . $controllerRoute . '/delete/'.Helper::encoded($row->id))?>" class="btn btn-outline-danger btn-sm" title="Delete <?=$module['title']?>" onclick="return confirm('Do You Want To Delete This <?=$module['title']?>');"><i class="fa fa-trash"></i></a>
                      <?php }?>
                    </td>
                  </tr>
                <?php } }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>