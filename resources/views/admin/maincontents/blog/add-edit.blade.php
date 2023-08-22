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
      $blog_category      = $row->blog_category;
      $title              = $row->title;
      $content_date       = $row->content_date;
      $short_description  = $row->short_description;
      $description        = $row->description;
      $image              = $row->image;
    } else {
      $blog_category      = '';
      $title              = '';
      $content_date       = '';
      $short_description  = '';
      $description        = '';
      $image              = '';
    }
    ?>
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body pt-3">
          <form method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
              <label for="blog_category" class="col-md-2 col-lg-2 col-form-label">Category</label>
              <div class="col-md-10 col-lg-10">
                <select name="blog_category" class="form-control" id="blog_category" required>
                  <option value="" selected>Select Category</option>
                  <?php if($blogCats){ foreach($blogCats as $blogCat){?>
                  <option value="<?=$blogCat->id?>" <?=(($blogCat->id == $blog_category)?'selected':'')?>><?=$blogCat->name?></option>
                  <?php } }?>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label for="title" class="col-md-2 col-lg-2 col-form-label">Title</label>
              <div class="col-md-10 col-lg-10">
                <input type="text" name="title" class="form-control" id="title" value="<?=$title?>" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="content_date" class="col-md-2 col-lg-2 col-form-label">Content Date</label>
              <div class="col-md-10 col-lg-10">
                <input type="date" name="content_date" class="form-control" id="content_date" value="<?=$content_date?>" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="short_description" class="col-md-2 col-lg-2 col-form-label">Summary</label>
              <div class="col-md-10 col-lg-10">
                <textarea name="short_description" class="form-control" id="short_description" rows="5" required><?=$short_description?></textarea>
              </div>
            </div>
            <div class="row mb-3">
              <label for="description" class="col-md-2 col-lg-2 col-form-label">Long Description</label>
              <div class="col-md-10 col-lg-10">
                <textarea name="description" class="form-control ckeditor" id="description" rows="5" required><?=$description?></textarea>
              </div>
            </div>
            <div class="row mb-3">
              <label for="image" class="col-md-2 col-lg-2 col-form-label">Image</label>
              <div class="col-md-10 col-lg-10">
                <input type="file" name="image" class="form-control" id="image">
                <small class="text-info">* Only JPG, JPEG, ICO, SVG, PNG files are allowed</small><br>
                <?php if($image != ''){?>
                  <img src="<?=env('UPLOADS_URL').'blog/'.$image?>" alt="<?=$title?>" style="width: 150px; height: 150px; margin-top: 10px;">
                <?php } else {?>
                  <img src="<?=env('NO_IMAGE')?>" alt="<?=$title?>" class="img-thumbnail" style="width: 150px; height: 150px; margin-top: 10px;">
                <?php }?>
                
                <div class="pt-2">
                  <!-- <a href="#profile_image" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a> -->
                  <!-- <a href="javascript:void(0);" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a> -->
                </div>
              </div>
            </div>

            <label for="" class="col-md-4 col-lg-3 col-form-label">Blog Contents</label>
            <div class="field_wrapper1">
              <?php
              // $table_of_content = (($blogContents)?(($blogContents->table_of_content != '')?json_decode($blogContents->table_of_content):[]):[]);
              // $summary = (($blogContents)?(($blogContents->summary != '')?json_decode($blogContents->summary):[]):[]);
              // $content = (($blogContents)?(($blogContents->content != '')?json_decode($blogContents->content):[]):[]);
              if(!empty($blogContents)){ foreach($blogContents as $blogContent) {
              ?>
                <div class="row" style="border: 1px solid #8144f0;padding: 10px;margin-bottom: 10px;">
                    <div class="col-md-6">
                      <label for="lefticon" class="control-label">Table Of Contents<span class="red">*</span></label>
                      <span class="input-with-icon">
                          <textarea class="form-control" name="table_of_content[]" rows="5"><?=$blogContent->table_of_content?></textarea>
                      </span>
                    </div>
                    <div class="col-md-6">
                      <label for="lefticon" class="control-label">Summary<span class="red">*</span></label>
                      <span class="input-with-icon">
                          <textarea class="form-control" name="summary[]" rows="5"><?=$blogContent->summary?></textarea>
                      </span>
                    </div>
                    <div class="col-md-11">
                      <label for="lefticon" class="control-label">Content<span class="red">*</span></label>
                      <span class="input-with-icon">
                          <textarea class="form-control ckeditor" name="content[]"><?=$blogContent->content?></textarea>
                      </span>
                    </div>
                    <div class="col-md-1" style="margin-top: 26px;">
                        <a href="javascript:void(0);" class="remove_button1" title="Add field"><i class="fa fa-minus-circle fa-2x text-danger"></i></a>
                    </div>                                    
                </div>
              <?php } }?>
              <div class="row" style="border: 1px solid #8144f0;padding: 10px;margin-bottom: 10px;">
                <div class="col-md-6">
                  <label for="lefticon" class="control-label">Table Of Contents<span class="red">*</span></label>
                  <span class="input-with-icon">
                      <textarea class="form-control" name="table_of_content[]" rows="5"></textarea>
                  </span>
                </div>
                <div class="col-md-6">
                  <label for="lefticon" class="control-label">Summary<span class="red">*</span></label>
                  <span class="input-with-icon">
                      <textarea class="form-control" name="summary[]" rows="5"></textarea>
                  </span>
                </div>
                <div class="col-md-11">
                  <label for="lefticon" class="control-label">Content<span class="red">*</span></label>
                  <span class="input-with-icon">
                      <textarea class="form-control ckeditor" name="content[]"></textarea>
                  </span>
                </div>
                <div class="col-md-1" style="margin-top: 26px;">
                    <a href="javascript:void(0);" class="add_button1" title="Add field"><i class="fa fa-plus-circle fa-2x text-success"></i></a>
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
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.4.7/standard-all/ckeditor.js"></script>
<script type="text/javascript">
  $(document).ready(function(){        
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button1'); //Add button selector
    var wrapper = $('.field_wrapper1'); //Input field wrapper
    var fieldHTML = '<div class="row" style="border: 1px solid #8144f0;padding: 10px;margin-bottom: 10px;">\
                      <div class="col-md-6">\
                        <label for="lefticon" class="control-label">Table Of Contents<span class="red">*</span></label>\
                        <span class="input-with-icon">\
                            <textarea class="form-control" name="table_of_content[]" rows="5"></textarea>\
                        </span>\
                      </div>\
                      <div class="col-md-6">\
                        <label for="lefticon" class="control-label">Summary<span class="red">*</span></label>\
                        <span class="input-with-icon">\
                            <textarea class="form-control" name="summary[]" rows="5"></textarea>\
                        </span>\
                      </div>\
                      <div class="col-md-11">\
                        <label for="lefticon" class="control-label">Content<span class="red">*</span></label>\
                        <span class="input-with-icon">\
                            <textarea class="form-control ckeditor" id="replace_element_'+x+'" name="content[]"></textarea>\
                        </span>\
                      </div>\
                      <div class="col-md-1" style="margin-top: 26px;">\
                          <a href="javascript:void(0);" class="remove_button1" title="Remove field"><i class="fa fa-minus-circle fa-2x text-danger"></i></a>\
                      </div>\
                    </div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){
          
          x++; //Increment field counter
          $(wrapper).append(fieldHTML); //Add field html
          CKEDITOR.replace( 'replace_element_' + x );
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button1', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
  });
</script>
