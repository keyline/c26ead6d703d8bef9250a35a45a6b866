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
      $page_name    = $row->page_name;
      $page_content = $row->page_content;
    } else {
      $page_name    = '';
      $page_content = '';
    }
    ?>
      <div class="col-xl-12">
      <div class="card">
        <div class="card-body pt-3">
          <form method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
              <label for="page_name" class="col-md-2 col-lg-2 col-form-label">Range From</label>
               <div class="col-md-5 col-lg-5">
                <input type="text"class="form-control" id="minWeight" value="<?=$range_from?>" readonly>
              </div>
            </div>
            <div class="row mb-3">
              <label for="page_name" class="col-md-2 col-lg-2 col-form-label">Range To</label>
               <div class="col-md-5 col-lg-5">
                <input type="text" id="maxWeight" class="form-control" value="<?=$range_to?>" readonly>
              </div>
            </div>
            <div class="row mb-3">
              <label for="page_name" class="col-md-2 col-lg-2 col-form-label">Create Grade</label>
               <div class="col-md-10 col-lg-10">
                <div class="field_wrapper">
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-3">
                          <input type="text" name="factor[]" class="form-control" value="<?=$checkSurveyFactor->factor_name;?>" readonly>
                        </div>
                        <div class="col-md-2">
                            <input type="number" class="form-control" min="<?=$range_from?>" max="<?=$range_to?>" name="minimum[]" id="minimum" placeholder="Minimum" required onkeypress="return isNumber(event)">
                        </div>
                        <div class="col-md-2">
                            <input type="number" class="form-control"  min="<?=$range_from?>" max="<?=$range_to?>" name="maximum[]" id="maximum" placeholder="Maximum" required onkeypress="return isNumber(event)">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="grade[]" id="grade" placeholder="Grade" required>
                        </div>
                        <div class="col-md-10" style="margin-top: 10px">
                            <textarea class="form-control" name="review[]" id="review" rows="5" placeholder="Review"></textarea>
                        </div>
                        <div class="col-md-2" style="margin-top: 10px">
                            <a href="javascript:void(0);" class="add_button" title="Add field">
                              <i class="fa fa-plus-circle fa-2x text-success"></i>
                            </a>
                        </div>
                    </div>
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
<script type="text/javascript">
    $(document).ready(function(){
        var minweight = $("#minWeight").val();
        var maxweight = $("#maxWeight").val();
        var maxField = 10;
        var addButton = $('.add_button');
        var wrapper = $('.field_wrapper');
        var fieldHTML ='<div class="row" style="margin-top: 10px;">\
                        <div class="col-md-3">\
                          <input type="text" name="factor[]" class="form-control" value="<?=$checkSurveyFactor->factor_name;?>" readonly>\
                        </div>\
                          <div class="col-md-2">\
                              <input type="number" class="form-control" min="<?=$range_from?>" max="<?=$range_to?>" name="minimum[]" id="minimum" placeholder="Minimum" required>\
                          </div>\
                          <div class="col-md-2">\
                              <input type="number" class="form-control" min="<?=$range_from?>" max="<?=$range_to?>" name="maximum[]" id="maximum" placeholder="Maximum" required>\
                          </div>\
                          <div class="col-md-3">\
                              <input type="text" class="form-control" name="grade[]" id="grade" placeholder="Grade" required>\
                          </div>\
                          <div class="col-md-10" style="margin-top: 10px">\
                            <textarea class="form-control" name="review[]" id="review" rows="5" placeholder="Review"></textarea>\
                          </div>\
                          <div class="col-md-2" style="margin-top: 10px">\
                                <a href="javascript:void(0);" class="remove_button" title="Add field">\
                                <i class="fa fa-minus-circle fa-2x text-danger"></i>\
                                </a>\
                          </div>\
                        </div>';
        var x = 1;
        $(addButton).click(function(){
            if(x < maxField){
                x++;
                $(wrapper).append(fieldHTML);
            }
        });
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
            x--;
        });
    });
</script>
<script type="text/javascript">
   $(document).ready(function(){
      var minweight = $("#minWeight").val();
      var maxweight = $("#maxWeight").val();
      $('#minimum').on('change', function(){
          var value = $(this).val();
          if(value < minweight){
            alert('Minimum score is Low');
            document.getElementById('minimum').value = '';
          }
      });
      // $('#maximum').on('change', function(){
      //     var value = $(this).val();
      //     if(maxweight < value){
      //       alert('Maximum score is too High');
      //       document.getElementById('maximum').value = '';
      //     }
      // });
  });
  function isNumber(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
          return false;
      }
      return true;
  }
</script>