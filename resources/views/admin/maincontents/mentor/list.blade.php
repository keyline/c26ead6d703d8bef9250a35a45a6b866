<?php
use App\Models\MentorPayment;
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
        <div class="card-body">
            <a href="<?=url('admin/mentors-export')?>" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i> Export</a>
          <!-- Table with stripped rows -->
            <div class="table-responsive">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name<br>Team Meeting Link</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Social Link</th>
                    <th scope="col">Registered At</th>
                    <th scope="col">Balance</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if($rows){ $sl=1; foreach($rows as $row){?>
                    <tr class="tableaction_border">
                      <td><?=$sl++?></td>
                      <td>
                        <?=$row->first_name.' '.$row->last_name?><br>
                        <?php if($row->team_meeting_link){?>
                          <a href="<?=$row->team_meeting_link?>" target="_blank" class="badge bg-info">Team Meeting Link</a>
                        <?php }?>
                      </td>
                      <td><?=$row->email?></td>
                      <td><?=$row->mobile?></td>
                      <td><a href="<?=$row->social_url?>" target="_blank" class="badge bg-primary">Social Link</a></td>
                      <td><?=date_format(date_create($row->created_at), "M d, Y h:i A")?></td>
                      <td>
                        <h6>
                          <?php
                          $mentorBal   = 0;
                          $getBalance = MentorPayment::select('closing_amt')->where('mentor_id', '=', $row->user_id)->orderBy('id', 'DESC')->first();
                          if ($getBalance) {
                              $mentorBal   = $getBalance->closing_amt;
                          }
                          echo number_format($mentorBal,2);
                          ?>
                        </h6>
                        <a target="_blank" href="<?=url('admin/' . $controllerRoute . '/payouts/'.Helper::encoded($row->user_id))?>" class="badge bg-info" title="Edit <?=$module['title']?>"><i class="fa fa-inr"></i> View Payouts</a>
                      </td>
                    </tr>
                    <tr class="tableaction_dark">
                      <td colspan="7">
                        <div class="tableaction_allbtn">
                          <?php if($row->valid){?>
                            <a href="<?=url('admin/' . $controllerRoute . '/change-status/'.Helper::encoded($row->user_id))?>" class="btn btn-success " title="Activate <?=$module['title']?>"><i class="fa fa-check"></i> Click To Disapprove</a>
                          <?php } else {?>
                            <a href="<?=url('admin/' . $controllerRoute . '/change-status/'.Helper::encoded($row->user_id))?>" class="btn btn-danger " title="Deactivate <?=$module['title']?>"><i class="fa fa-times"></i> Click To Approve</a>
                            <a href="<?=url('admin/' . $controllerRoute . '/delete/'.Helper::encoded($row->user_id))?>" class="btn btn-outline-danger btn-sm" title="Delete <?=$module['title']?>" onclick="return confirm('Do You Want To Delete This <?=$module['title']?>');"><i class="fa fa-trash"></i> Delete</a>
                          <?php }?>
                          
                          <a target="_blank" href="<?=url('admin/' . $controllerRoute . '/profile/'.Helper::encoded($row->user_id))?>" class="btn badge btn-secondary" title="Profile of <?=$module['title']?>"><i class="fa fa-user"></i> Mentor Profile</a>
                          <a target="_blank" href="<?=url('admin/' . $controllerRoute . '/availability/'.Helper::encoded($row->user_id))?>" class="btn badge bg-success" title="Edit <?=$module['title']?>"><i class="fa fa-clock"></i> Availability</a>
                          <a target="_blank" href="<?=url('admin/' . $controllerRoute . '/assigned-services/'.Helper::encoded($row->user_id))?>" class="btn badge bg-primary" title="Edit <?=$module['title']?>"><i class="fa fa-wrench"></i> Assigned Services</a>
                          <a target="_blank" href="<?=url('admin/' . $controllerRoute . '/bookings/'.Helper::encoded($row->user_id))?>" class="btn badge bg-info" title="Edit <?=$module['title']?>"><i class="fa fa-list"></i> Bookings</a>
                          <a target="_blank" href="<?=url('admin/' . $controllerRoute . '/transactions/'.Helper::encoded($row->user_id))?>" class="btn badge bg-warning" title="Edit <?=$module['title']?>"><i class="fa fa-inr"></i> Transactions</a>

                          <?php if($row->is_featured){?>
                            <span class="badge bg-success">Marked As Featured</span>
                          <?php } else {?>
                            <a href="<?=url('admin/' . $controllerRoute . '/change-status-featured/'.Helper::encoded($row->user_id))?>" class="btn btn-outline-danger btn-xs" title="Featured <?=$module['title']?>"><i class="fa fa-times"></i> Mark Featured</a>
                          <?php }?>
                        </div>
                      </td>
                    </tr>
                  <?php } }?>
                </tbody>
              </table>
            </div>
          <!-- End Table with stripped rows -->
        </div>
      </div>

    </div>
  </div>
</section>
