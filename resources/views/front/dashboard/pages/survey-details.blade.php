<?php
	use App\Models\User;
	use App\Models\surveyQuestionOptions;
	use App\Models\SurveyResult;
?>
<div class="account_wrapper">
	<?=$sidebar;?>
	<div class="wrapper account_inner_section d-flex flex-column min-vh-100 bg-light">
		<header class="header header-sticky mb-4">
			<div class="container-fluid">
				<button class="header-toggler px-md-0 me-md-3 d-md-none" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
					<i class="fa-solid fa-bars"></i>
				</button>
				<h4 class="pagestitle-item mb-0">Survey List</h4>
				<ul class="header-nav ms-auto"></ul>
			</div>
		</header>
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
		<div class="body flex-grow-1 px-3">
			<div class="container-lg">
				<div class="row">
				<?php $checkSurvey = SurveyResult::where('user_id','=',$user_id)->where('survey_id','=',$id)->count();
					if($checkSurvey){ ?> 
						<h1 style="text-align: center;color: red;"> You Have Already Participate In This Survey !!!</h1>
					<?php }else{ ?>
						<div class="col-sm-12 col-lg-12">
							<form method="POST" action="" enctype="multipart/form-data">
							@csrf
							<div class="survay_listing">							
								<ul>
									<?php if($surveyQuestions){ $q=1; foreach($surveyQuestions as $surveyQuestion){	?>
										<input type="hidden" name="survey_id" value="<?= $surveyQuestion->survey_id?>" id="survey_id">
										<li class="question <?=$q;?> <?=(($q == 1)?'':'inactive')?>" id="question-container-<?=$q?>">
											<h3><?=$q?>. <?= $surveyQuestion->question_name; ?></h3>
											<ul>
												<?php $surveyQuestionOptions = surveyQuestionOptions::where('survey_id','=', $surveyQuestion->survey_id)->where('question_id','=',$surveyQuestion->question_id)->where('status','=',1)->get();
												if($surveyQuestionOptions){
													foreach ($surveyQuestionOptions as $surveyQuestionOption) { ?>
														<li>
															<label for="option<?=$surveyQuestionOption->option_id?>">
															<input name="option<?=$q?>[]" value="<?=$surveyQuestionOption->option_weight;?>" type="radio" id="option<?=$surveyQuestionOption->option_id?>" onchange="setAnswer(<?=$q?>);"> <?=$surveyQuestionOption->option_name; ?></label>
														</li>
												<?php } } ?>
											</ul>
										</li>
									<?php $q++; }	} ?>
								</ul>
								<!-- <a class="btn_orgfill uppercase me-2" href="<?=url('user/survey-result')?>">PROCEED</a> -->
								<button type="submit" class="btn_orgfill uppercase me-2">PROCEED</button>
							</div>
							</form>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript">
	$(function(){
		
	})
	function setAnswer(questionId){
		let nextQuestionId = parseInt(questionId) + 1;
		$('#question-container-' + nextQuestionId).removeClass('inactive');
	}
</script>