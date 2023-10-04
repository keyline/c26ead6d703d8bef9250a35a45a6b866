<?php
use App\Helpers\Helper;
use App\Models\SurveyQuestionOptions;
$controllerRoute = $module['controller_route'];
?>
  <style>
      .input-field {
        /* display: block; */
        margin-top: 10px;
        width: auto;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border-radius: 0.375rem;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
      }
  </style>
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
      $question_type      = $row->question_type;
      $title              = $row->title;
      $short_description  = $row->short_description;
      $guideline          = $row->guideline; 
    } else {
      $question_type      = '';
      $title              = '';
      $short_description  = '';
      $guideline          = '';
    }
    ?>
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body pt-3">
          <form method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
              <label for="page_name" class="col-md-2 col-lg-2 col-form-label">Question Type</label>
               <div class="col-md-10 col-lg-10">
                <select class="form-control" name="question_type" id="question_type" required>
                  <option value="">Select Question Type</option>
                  <?php if($question_types){ foreach($question_types as $type){ ?>
                    <option value="<?=$type->id;?>" <?=(($question_type == $type->id)?'selected':'')?> ><?=$type->name;?></option> 
                  <?php } } ?>
                </select>
              </div> 
            </div>
            <div class="row mb-3">
              <label for="page_name" class="col-md-2 col-lg-2 col-form-label">Survey Title</label>
               <div class="col-md-10 col-lg-10">
                <input type="text" name="survey_name" class="form-control" id="survey_name" rows="5" value="<?=$title?>" required>
              </div> 
            </div>
            <div class="row mb-3">
              <label for="page_name" class="col-md-2 col-lg-2 col-form-label">Short Description</label>
               <div class="col-md-10 col-lg-10">
                <textarea name="short_description" class="form-control" id="page_name" rows="5" required><?=$short_description?></textarea>
              </div>
            </div>
            <div class="row mb-3">
              <label for="page_name" class="col-md-2 col-lg-2 col-form-label">Guideline</label>
               <div class="col-md-10 col-lg-10">
                <textarea name="guideline" class="form-control" id="guideline" rows="3" required><?=$guideline?></textarea>
              </div>
            </div>
            <div class="row mb-3">
              <label for="page_name" class="col-md-2 col-lg-2 col-form-label">Survey Data</label>
              <div class="col-md-10 col-lg-10">
                <div class="field_wrapper">

                  <?php if($questions){ $sl = 101; foreach($questions as $question){?>
                    <?php
                    $questionOptions  = SurveyQuestionOptions::select('option_id','question_id','option_name','option_weight','factor')->where('status', '=', 1)->where('question_id', '=', $question->question_id)->get();
                    $optionIds        = [];
                    $questionIds      = [];
                    $optionLabels     = [];
                    $optionWeights    = [];
                    if($questionOptions){
                      foreach($questionOptions as $questionOption){
                        $optionIds[]      = $questionOption->option_id;
                        $questionIds[]    = $questionOption->question_id;
                        $optionLabels[]   = $questionOption->option_name;
                        $optionWeights[]  = $questionOption->option_weight;
                      }
                    }
                    ?>
                    <div class="row" style="border:1px solid #0d6efd54; border-radius:10px; padding: 10px; margin-top: 10px;">
                      <input type="hidden" name="questionID[]" value="<?=$question->question_id?>" id="questionID">
                      <div class="col-md-6 col-lg-6">
                          <input type="text" style="margin-top: 10px;" class="form-control" name="question[]" id="question" placeholder="Question" value="<?=$question->question_name?>">
                      </div>
                      <div class="col-md-4 col-lg-4">
                          <input type="text" style="margin-top: 10px;" class="form-control" name="factor[]" id="factor" placeholder="Factor" value="<?=$question->factor?>">
                      </div>
                      <div class="col-md-1 col-lg-1">
                        
                          <input type="tel" style="margin-top: 10px;" class="form-control option-label" min="0" name="label[]" id="numFields<?=$sl?>" onkeyup="addInputFields0()" placeholder="Option" value="<?=$question->no_of_labels?>" onclick="getInputOptions('<?=$sl?>', <?=$question->no_of_labels?> , '<?=implode("|",$optionIds)?>', '<?=implode("|",$questionIds)?>', '<?=implode("|",$optionLabels)?>', '<?=implode("|",$optionWeights)?>')">

                      </div>
                      <div class="col-md-1 col-lg-1">
                        <a href="javascript:void(0);" class="remove_button" title="Remove field" style="height: 100%;display: flex;align-items: center;" >
                          <i class="fa fa-minus-circle fa-2x text-danger"></i>
                        </a>
                      </div>
                      <div id="inputContainer<?=$sl?>" style="margin-top: 10px;"></div>
                    </div>
                  <?php $sl++; } }?>

                  <div class="row" style="border:1px solid #0d6efd54; border-radius:10px; padding: 10px; margin-top: 10px;">
                    <input type="hidden" name="questionID[]" value="">
                    <div class="col-md-6 col-lg-6">
                        <input type="text" style="margin-top: 10px;" class="form-control" name="question[]" id="question" placeholder="Question">
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <input type="text" style="margin-top: 10px;" class="form-control" name="factor[]" id="factor" placeholder="Factor" value="">
                    </div>
                    <div class="col-md-1 col-lg-1">
                        <input type="tel" style="margin-top: 10px;" class="form-control" min="0" name="label[]" id="numFields0" onkeyup="addInputFields0()" placeholder="Option">
                    </div>
                    <div class="col-md-1 col-lg-1">
                      <a href="javascript:void(0);" class="add_button" title="Add field" style="height: 100%;display: flex;align-items: center;" >
                        <i class="fa fa-plus-circle fa-2x text-success"></i>
                      </a>
                    </div>
                    <div id="inputContainer0" style="margin-top: 10px;"></div>
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
        var maxField = 100;
        var addButton = $('.add_button');
        var wrapper = $('.field_wrapper');
        var x = 1;
        $(addButton).click(function(){
            if(x < maxField){
            var fieldHTML ='<div class="row" style="border:1px solid #0d6efd54; border-radius:10px; padding: 10px; margin-top: 10px;">\
                              <input type="hidden" name="questionID[]" value="">\
                              <div class="col-md-6 col-lg-6">\
                                <input type="text" style="margin-top: 10px;" class="form-control" name="question[]" id="question" placeholder="Question">\
                              </div>\
                              <div class="col-md-4 col-lg-4">\
                                <input type="text" style="margin-top: 10px;" class="form-control" name="factor[]" id="factor" placeholder="Factor" value="">\
                              </div>\
                              <div class="col-md-1 col-lg-1">\
                                  <input type="tel" min="0" style="margin-top: 10px;" class="form-control" name="label[]" id="numFields'+x+'" onkeyup="addInputFields('+x+')" placeholder="Option">\
                              </div>\
                              <div class="col-md-1 col-lg-1">\
                                <a href="javascript:void(0);" class="remove_button" title="Remove field" style="height: 100%;display: flex;align-items: center;" >\
                                  <i class="fa fa-minus-circle fa-2x text-danger"></i>\
                                </a>\
                              </div>\
                              <div id="inputContainer'+x+'" style="margin-top: 10px;"></div>\
                          </div>';
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
    $('.option-label').click();
  });
  function getInputOptions(containerId, no_of_label, optionId, questionId, label,weight){
    var optionArray   = optionId.split("|");
    var questionArray = questionId.split("|");
    var labelArray    = label.split("|");
    var weightArray   = weight.split("|");    
    
    var container = document.getElementById('inputContainer' + containerId);
    container.innerHTML = '';
    var numFields0 = parseInt(document.getElementById("numFields" + containerId).value);
    for (var i = 0; i < numFields0; i++) {
      
      /* option id */
        var input3 = document.createElement("input");
        input3.type = "hidden";
        input3.name = "optionid"+ containerId  +"[]";
        input3.value = optionArray[i];
        container.appendChild(input3);
      /* option id */
      /* question id */
        var input4 = document.createElement("input");
        input4.type = "hidden";
        input4.name = "questionid"+ containerId  +"[]";
        input4.value = questionArray[i];
        container.appendChild(input4);
      /* question id */
      /* option label */
        var input1 = document.createElement("input");
        input1.type = "text";
        input1.name = "option"+ containerId  +"[]";
        input1.className = "input-field";
        input1.value = labelArray[i];
        input1.placeholder = "Option "+ i;
        container.appendChild(input1);
      /* option label */
      /* option weight */
        var input2 = document.createElement("input");
        input2.type = "tel";
        input2.name = "score"+ containerId +"[]";
        input2.className = "input-field";
        input2.value = weightArray[i];
        input2.placeholder = "Score "+i;
        container.appendChild(input2);
        /* option weight */
       
        var br = document.createElement("br");
        container.appendChild(br);
      
    }
  }
</script>
<script>
    function addInputFields0(){
        var container = document.getElementById("inputContainer0");
        container.innerHTML = '';
        var numFields0 = parseInt(document.getElementById("numFields0").value);
        for (var i = 1; i <= numFields0; i++) {

            var input1 = document.createElement("input");
            input1.type = "text";
            input1.name = "option0[]";
            input1.className = "input-field";
            input1.placeholder = "Option "+ i;
            container.appendChild(input1);
            
            var input2 = document.createElement("input");
            input2.type = "tel";
            input2.name = "score0[]";
            input2.className = "input-field";
            input2.placeholder = "Weight "+i;
            container.appendChild(input2);
            
            var br = document.createElement("br");
            container.appendChild(br);
        }
    }
</script>
<script>
    function addInputFields(e) {
      let Id = e;
      var container = document.getElementById("inputContainer"+Id);
      container.innerHTML = '';
      var numFields = parseInt(document.getElementById("numFields"+Id).value);
      for (var i = 1; i <= numFields; i++) {

          var input1 = document.createElement("input");
          input1.type = "text";
          input1.name = "option"+ Id +"[]";
          input1.className = "input-field";
          input1.placeholder = "Option "+ i;
          container.appendChild(input1);
          
          var input2 = document.createElement("input");
          input2.type = "tel";
          input2.name = "score"+ Id +"[]";
          input2.className = "input-field";
          input2.placeholder = "Weight "+i;
          container.appendChild(input2);
          
          var br = document.createElement("br");
          container.appendChild(br);
        }
    }
</script>