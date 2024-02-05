<?php
use App\Helpers\Helper;
use App\Models\QuestionTypes;
use App\Models\SurveyQuestion;
use App\Models\SurveyQuestionOptions;
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
          <div class="row">
            <div class="col-md-3">
              <h6>Survey Type</h6>
            </div>
            <div class="col-md-9">
              <?php $questionType = QuestionTypes::where('id', '=', $survey->question_type)->where('status','=',1)->first(); ?>
              <small><?=$questionType->name;?></small>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <h6>Description</h6>
            </div>
            <div class="col-md-9">
              <small><?=$survey->short_description;?></small>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <h6>Guidelines</h6>
            </div>
            <div class="col-md-9">
              <small><?=$survey->guideline;?></small>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <h6>No Of Questions</h6>
            </div>
            <div class="col-md-9">
              <?php $surveyCount = SurveyQuestion::where('survey_id', '=', $survey->id)->where('status','=',1)->count(); ?>
              <small><?=$surveyCount;?></small>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-body pt-3">
          <ul class="list-group">
            <?php if($answersRecords){ $sl=1; foreach($answersRecords as $answersRecord){ ?>
              <li class="list-group-item">
                <?php
                  $getData     = SurveyQuestionOptions:: where('option_id', '=', $answersRecord->option_id)->where('status','=',1)->first();
                  $getquestion = SurveyQuestion:: where('question_id', '=', $getData->question_id)->where('status','=',1)->first();
                ?>
                <h5>Q.<?=$sl++ . '.' ?> <?=$getquestion->question_name;?></h5>
                <h5>Ans: <?=$getData->option_name;?></h5>
              </li>
            <?php }  } ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
