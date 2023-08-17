<?php
use App\Helpers\Helper;
use App\Models\SurveyQuestionOptions;
$controllerRoute = $module['controller_route'];
?>
  <style>
      .input-field {
          /* display: block; */
          margin-top: 5px;
          width: 50%;
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
    <?php //Helper::pr($row);
    if($row){
      $question_type      = $row->question_type;
      $title              = $row->title;
      $short_description  = $row->short_description; 
    } else {
      $question_type      = '';
      $title              = '';
      $short_description  = '';
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
                  <option value="1" <?=(($question_type == 1)?'selected':'')?>>MCQ</option>
                </select>
              </div> 
            </div>
            <div class="row mb-3">
              <label for="page_name" class="col-md-2 col-lg-2 col-form-label">Survey Name</label>
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
              <label for="page_name" class="col-md-2 col-lg-2 col-form-label">Survey Data</label>
              <div class="col-md-10 col-lg-10">
                <div class="field_wrapper">

                  <?php if($questions){ $sl = 101; foreach($questions as $question){?>
                    <?php
                    $questionOptions = SurveyQuestionOptions::select('option_name','option_weight')->where('status', '=', 1)->where('question_id', '=', $question->question_id)->get();
                    $optionLabels = [];
                    $optionWeights = [];
                    if($questionOptions){
                      foreach($questionOptions as $questionOption){
                        $optionLabels[] = $questionOption->option_name;
                        $optionWeights[] = $questionOption->option_weight;
                      }
                    }
                    // print_r($optionLabels);
                    // print_r($optionWeights);
                    ?>
                    <div class="row" style="border:1px solid red; padding: 10px; margin-top: 10px;">
                      <div class="col-md-6 col-lg-6">
                          <input type="text" style="margin-top: 10px;" class="form-control" name="question[]" id="question" placeholder="Question" value="<?=$question->question_name?>">
                      </div>
                      <div class="col-md-2 col-lg-2">
                          <input type="tel" style="margin-top: 10px;" class="form-control" min="0" name="label[]" id="numFields<?=$sl?>" onkeyup="addInputFields0()" placeholder="Label" value="<?=$question->no_of_labels?>" onclick="getInputOptions('<?=$sl?>', <?=$question->no_of_labels?>)">
                      </div>
                      <div class="col-md-2 col-lg-2">
                        <a href="javascript:void(0);" class="remove_button" title="Remove field" style="height: 100%;display: flex;align-items: center;" >
                          <i class="fa fa-minus-circle fa-2x text-danger"></i>
                        </a>
                      </div>
                      <div id="inputContainer<?=$sl?>" style="margin-top: 10px;"></div>
                    </div>
                  <?php $sl++; } }?>

                  <div class="row" style="border:1px solid red; padding: 10px; margin-top: 10px;">
                      <div class="col-md-6 col-lg-6">
                          <input type="text" style="margin-top: 10px;" class="form-control" name="question[]" id="question" placeholder="Question">
                      </div>
                      <div class="col-md-2 col-lg-2">
                          <input type="tel" style="margin-top: 10px;" class="form-control" min="0" name="label[]" id="numFields0" onkeyup="addInputFields0()" placeholder="Label">
                      </div>
                      <div class="col-md-2 col-lg-2">
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
        var maxField = 10;
        var addButton = $('.add_button');
        var wrapper = $('.field_wrapper');
        var x = 1;
        $(addButton).click(function(){
            if(x < maxField){
            var fieldHTML ='<div class="row" style="border:1px solid red; padding: 10px; margin-top: 10px;">\
                              <div class="col-md-6 col-lg-6">\
                                  <input type="text" style="margin-top: 10px;" class="form-control" name="question[]" id="question" placeholder="Question">\
                              </div>\
                              <div class="col-md-2 col-lg-2">\
                                  <input type="tel" min="0" style="margin-top: 10px;" class="form-control" name="label[]" id="numFields'+x+'" onkeyup="addInputFields('+x+')" placeholder="Label">\
                              </div>\
                              <div class="col-md-2 col-lg-2">\
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
  // $(document).ready(function(){
  //   <?php if($questions){ foreach($questions as $question){?>
  //   // 1st options
  //     getInputOptions('inputContainer101', '<?=$question->no_of_labels?>');
      
  //   // 1st options
  //   <?php } }?>
  //   // 2nd onwards option

  //   // 2nd onwards option
  // });
  function getInputOptions(containerId, no_of_label){
    
    var container = document.getElementById('inputContainer' + containerId);
    container.innerHTML = '';
    var numFields0 = parseInt(document.getElementById("numFields" + containerId).value);
    for (var i = 1; i <= numFields0; i++) {
      var input1 = document.createElement("input");
        input1.type = "text";
        input1.name = "option0[]";
        input1.className = "input-field";
        input1.value = "input-field";
        input1.placeholder = "Option "+ i;
        container.appendChild(input1);
        
        var input2 = document.createElement("input");
        input2.type = "tel";
        input2.name = "score0[]";
        input2.className = "input-field";
        input2.value = "input-field";
        input2.placeholder = "Score "+i;
        container.appendChild(input2);
        
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
            input2.placeholder = "Score "+i;
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
          input2.placeholder = "Score "+i;
          container.appendChild(input2);
          
          var br = document.createElement("br");
          container.appendChild(br);
        }
    }
</script>