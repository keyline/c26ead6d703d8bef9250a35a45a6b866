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
          <h5 class="card-title">
            <a href="<?=url('admin/' . $controllerRoute . '/add/')?>" class="btn btn-outline-success btn-sm">Add <?=$module['title']?></a>
          </h5>
          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Mentor Background Color</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if($rows){ $sl=1; foreach($rows as $row){?>
                <tr>
                  <th scope="row"><?=$sl++?></th>
                  <td><?=$row->name?></td>
                  <td><?=wordwrap($row->description,40,"<br>\n")?></td>
                  <td><p style="background-color: <?=$row->mentor_background_color?>; border-radius: 50%; width: 20px; height:20px;padding: 5px; margin-top:10px;">&nbsp;</p></td>
                  <td>
                    <?php if($row->image != ''){?>
                      <img src="<?=env('UPLOADS_URL').'service/'.$row->image?>" class="img-thumbnail" alt="<?=$row->name?>" style="width: 150px; height: 150px; margin-top: 10px;">
                    <?php } else {?>
                      <img src="<?=env('NO_IMAGE')?>" alt="<?=$row->name?>" class="img-thumbnail" style="width: 150px; height: 150px; margin-top: 10px;">
                    <?php }?>
                  </td>
                  <td>
                    <a href="<?=url('admin/' . $controllerRoute . '/edit/'.Helper::encoded($row->id))?>" class="btn btn-outline-primary btn-sm" title="Edit <?=$module['title']?>"><i class="fa fa-edit"></i></a>
                    <a href="<?=url('admin/' . $controllerRoute . '/delete/'.Helper::encoded($row->id))?>" class="btn btn-outline-danger btn-sm" title="Delete <?=$module['title']?>" onclick="return confirm('Do You Want To Delete This <?=$module['title']?>');"><i class="fa fa-trash"></i></a>
                    <?php if($row->status){?>
                      <a href="<?=url('admin/' . $controllerRoute . '/change-status/'.Helper::encoded($row->id))?>" class="btn btn-outline-success btn-sm" title="Activate <?=$module['title']?>"><i class="fa fa-check"></i></a>
                    <?php } else {?>
                      <a href="<?=url('admin/' . $controllerRoute . '/change-status/'.Helper::encoded($row->id))?>" class="btn btn-outline-warning btn-sm" title="Deactivate <?=$module['title']?>"><i class="fa fa-times"></i></a>
                    <?php }?>
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