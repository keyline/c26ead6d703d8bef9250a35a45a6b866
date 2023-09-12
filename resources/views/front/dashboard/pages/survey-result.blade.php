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
				<h4 class="pagestitle-item mb-0">Survey Result</h4>
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
					<div class="col-sm-12 col-lg-12 d-flex justify-content-center">
						<div class="survay_resulting">
							<div class="survay_resulting_inner">
								<div class="survay_resulting_tick"><i class="fa-solid fa-check"></i></div>
								<div class="survay_resulting_content">
									<p>Thank you for Survry, you have finish all <strong>21</strong> question. Your result given below:</p>
									
									<blockquote>
										In your case you have high self esteem: Pros of High self-esteem-Appraisal of the effects of self-esteem is complicated by several factors. Because many people with high self-esteem exaggerate their successes and good traits, we emphasize objective measures of outcomes. Cons of high self-esteem- High self-esteem is also a heterogeneous category, encompassing people who frankly accept their good qualities along with narcissistic, defensive, and conceited individuals. 
									</blockquote>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>