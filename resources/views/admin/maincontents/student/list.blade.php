<?php
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
            <a href="<?=url('admin/students-export')?>" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i> Export</a>
          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Registered At</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if($rows){ $sl=1; foreach($rows as $row){?>
                <tr>
                  <th scope="row"><?=$sl++?></th>
                  <td><?=$row->first_name.' '.$row->last_name?></td>
                  <td><?=$row->email?></td>
                  <td><?=$row->phone?></td>
                  <td><?=date_format(date_create($row->created_at), "M d, Y h:i A")?></td>
                  <td>
                    <!-- <a href="<?=url('admin/' . $controllerRoute . '/edit/'.Helper::encoded($row->user_id))?>" class="btn btn-outline-primary btn-sm" title="Edit <?=$module['title']?>"><i class="fa fa-edit"></i></a> -->
                    <a href="<?=url('admin/' . $controllerRoute . '/delete/'.Helper::encoded($row->user_id))?>" class="btn btn-outline-danger btn-sm" title="Delete <?=$module['title']?>" onclick="return confirm('Do You Want To Delete This <?=$module['title']?>');"><i class="fa fa-trash"></i></a>
                    <?php if($row->valid){?>
                      <a href="<?=url('admin/' . $controllerRoute . '/change-status/'.Helper::encoded($row->user_id))?>" class="btn btn-success btn-sm" title="Activate <?=$module['title']?>"><i class="fa fa-check"></i> Click To Disapprove</a>
                    <?php } else {?>
                      <a href="<?=url('admin/' . $controllerRoute . '/change-status/'.Helper::encoded($row->user_id))?>" class="btn btn-danger btn-sm" title="Deactivate <?=$module['title']?>"><i class="fa fa-times"></i> Click To Approve</a>
                    <?php }?>
                    <br><br>
                    <a target="_blank" href="<?=url('admin/' . $controllerRoute . '/profile/'.Helper::encoded($row->user_id))?>" class="badge bg-dark" title="Edit <?=$module['title']?>"><i class="fa fa-user"></i> Student Profile</a>
                    <br><br>
                    <a target="_blank" href="<?=url('admin/' . $controllerRoute . '/bookings/'.Helper::encoded($row->user_id))?>" class="badge bg-info" title="Edit <?=$module['title']?>"><i class="fa fa-list"></i> Bookings</a>
                    <br><br>
                    <a target="_blank" href="<?=url('admin/' . $controllerRoute . '/transactions/'.Helper::encoded($row->user_id))?>" class="badge bg-warning" title="Edit <?=$module['title']?>"><i class="fa fa-inr"></i> Transactions</a>
                    <br><br>
                    <a target="_blank" href="<?=url('admin/' . $controllerRoute . '/survey/'.Helper::encoded($row->user_id))?>" class="badge bg-primary" title="View Survey"><i class="fa fa-poll"></i> Surveys</a>
                  </td>
                </tr>
              <?php } }?>
            </tbody>
          </table>
          <!-- End Table with stripped rows -->
        </div>
      </div>

    </div>
  </div>
</section>
