<?php
	use App\Models\User;
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
					<div class="col-sm-12 col-lg-12">
						<div class="survay_listing">
							<ul>
								<li class="question">
									<h3>You regularly make new friends.</h3>
									<ul>
										<li><label><input type="radio" name="a" class="choice"> Strongly agree</label></li>
										<li><label><input type="radio" name="a"> Agree</label></li>
										<li><label><input type="radio" name="a"> Disagree</label></li>
										<li><label><input type="radio" name="a"> Strongly disagree</label></li>
									</ul>
								</li>
								<li class="question">
									<h3>At times I think I am no good at all.</h3>
									<ul>
										<li><label><input type="radio" name="b"> Strongly agree</label></li>
										<li><label><input type="radio" name="b"> Agree</label></li>
										<li><label><input type="radio" name="b"> Disagree</label></li>
										<li><label><input type="radio" name="b"> Strongly disagree</label></li>
									</ul>
								</li>
								<li class="question">
									<h3>I feel that I have a number of good qualities.</h3>
									<ul>
										<li><label><input type="radio" name="c"> Strongly agree</label></li>
										<li><label><input type="radio" name="c"> Agree</label></li>
										<li><label><input type="radio" name="c"> Disagree</label></li>
										<li><label><input type="radio" name="c"> Strongly disagree</label></li>
									</ul>
								</li>
								<li class="question">
									<h3>I can predict other peoples' behavior.</h3>
									<ul>
										<li><label><input type="radio" name="d"> Extremely poor </label></li>
										<li><label><input type="radio" name="d"> Very Poor</label></li>
										<li><label><input type="radio" name="d"> Poor</label></li>
										<li><label><input type="radio" name="d"> Neutral </label></li>
										<li><label><input type="radio" name="d"> Well </label></li>
										<li><label><input type="radio" name="d"> Very Well </label></li>
										<li><label><input type="radio" name="d"> Extremely Well </label></li>
									</ul>
								</li>
								<li class="question">
									<h3>I know how my actions will make others feel.</h3>
									<ul>
										<li><label><input type="radio" name="e"> Extremely poor </label></li>
										<li><label><input type="radio" name="e"> Very Poor</label></li>
										<li><label><input type="radio" name="e"> Poor</label></li>
										<li><label><input type="radio" name="e"> Neutral </label></li>
										<li><label><input type="radio" name="e"> Well </label></li>
										<li><label><input type="radio" name="e"> Very Well </label></li>
										<li><label><input type="radio" name="e"> Extremely Well </label></li>
									</ul>
								</li>
								<li class="question">
									<h3>I can often understand what others are trying to accomplish without the need for them to say anything. </h3>
									<ul>
										<li><label><input type="radio" name="f"> Extremely poor </label></li>
										<li><label><input type="radio" name="f"> Very Poor</label></li>
										<li><label><input type="radio" name="f"> Poor</label></li>
										<li><label><input type="radio" name="f"> Neutral </label></li>
										<li><label><input type="radio" name="f"> Well </label></li>
										<li><label><input type="radio" name="f"> Very Well </label></li>
										<li><label><input type="radio" name="f"> Extremely Well </label></li>
									</ul>
								</li>
								<li class="question">
									<h3>Some people have a knack forr writing‚ while others will never write well no matter how they try.</h3>
									<ul>
										<li><label><input type="radio" name="g" disabled> TRUE</label></li>
										<li><label><input type="radio" name="g" disabled> FALSE</label></li>
									</ul>
								</li>
								<li class="question">
									<h3>There are some subjects in which I could never well.</h3>
									<ul>
										<li><label><input type="radio" name="h"> TRUE</label></li>
										<li><label><input type="radio" name="h"> FALSE</label></li>
									</ul>
								</li>
								<li class="question">
									<h3>Professors sometimes make an early impression of you and then no matter what you do‚ you cannot change that impression.</h3>
									<ul>
										<li><label><input type="radio" name="i"> TRUE</label></li>
										<li><label><input type="radio" name="i"> FALSE</label></li>
									</ul>
								</li>
							</ul>
							<a class="btn_orgfill uppercase me-2" href="<?=url('user/survey-result')?>">PROCEED</a>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

