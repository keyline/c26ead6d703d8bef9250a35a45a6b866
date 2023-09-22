<?php
use App\Helpers\Helper;
use App\Models\User;
use App\Models\Survey;
use App\Models\QuestionTypes;
use App\Models\SurveyQuestion;
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
          
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Student Details</th>
                <th scope="col">Survey No</th>
                <th scope="col">Date</th>
                <th scope="col">Title</th>
                <th scope="col">Type</th>
                <th scope="col">No Of Questions</th>
                <th scope="col">Score</th>
                <th scope="col">Review/Remarks</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if($allSurveys){ foreach($allSurveys as $allSurvey) { ?>
              <tr>
                <th scope="row">1</th>
                <?php $getUser = User::where('id','=',$allSurvey->user_id)->first(); ?>
                <td>
                  <h6><i class="fa fa-user"></i> <?=$getUser->name;?></h6>
                  <h6><i class="fa fa-envelope"></i> <?=$getUser->email;?></h6>
                  <h6><i class="fa fa-mobile"></i> <?=$getUser->phone;?></h6>
                </td>
                <td>STUMENTO/SURVEY/0000<?=$allSurvey->id;?></td>
                <td><?=date_format(date_create($allSurvey->added_on), "M d, Y h:i A")?></td>
                <?php $surveyData = Survey::where('id', '=', $allSurvey->survey_id)->where('status','=',1)->first(); ?>
                <td><?=$surveyData->title;?></td>
                <?php $questionType = QuestionTypes::where('id', '=', $surveyData->question_type)->where('status','=',1)->first(); ?>
                <td><?=$questionType->name;?></td>
                <?php $surveyCount = SurveyQuestion::where('survey_id', '=', $surveyData->id)->where('status','=',1)->count(); ?>
                <td><?=$surveyCount;?></td>
                <td><?=$allSurvey->score;?> (<?=$allSurvey->grade;?>)</td>
                <td><?php echo mb_strimwidth($allSurvey->grade_review, 0, 200, "...");?></td>
                <td>
                  <a target="_blank" href="<?=url('admin/' . $controllerRoute . '/view-survey-details/'.Helper::encoded($allSurvey->user_id) .'/'. Helper::encoded($allSurvey->id)) ?>" class="btn btn-outline-info btn-sm" title="View Survey Details"><i class="fa fa-info-circle"></i></a>
                </td>
              </tr>
              <?php } } ?>
            </tbody>
          </table>
          
        </div>
      </div>

    </div>
  </div>
</section>