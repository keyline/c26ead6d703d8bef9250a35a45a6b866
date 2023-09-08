<div class="account_wrapper">
	<?=$sidebar;?>
	<div class="wrapper account_inner_section d-flex flex-column min-vh-100 bg-light">
		<header class="header header-sticky mb-4">
			<div class="container-fluid">
				<button class="header-toggler px-md-0 me-md-3 d-md-none" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
					<i class="fa-solid fa-bars"></i>
				</button>
				<h4 class="pagestitle-item mb-0">Dashboard</h4>
				<ul class="header-nav ms-auto"></ul>
			</div>
		</header>
		<div class="body flex-grow-1 px-3">
			<div class="container-lg">
				<div class="row">
					<div class="col-sm-6 col-lg-6">
						<div class="card mb-4 text-white bg-whitebg">
							<div class="card-body d-flex justify-content-between align-items-start">
								<div class="title_myaccount">
									<h3>Complete your profile</h3>
									<p>Add your profile pic and description</p>
									<a href="#" class="myprof_btn">Complete your profile</a>
								</div>
								<div class="profileuser-icon"><i class="fa-solid fa-user"></i></div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-lg-6">
						<div class="card mb-4 text-white bg-whitebg">
							<div class="card-body d-flex justify-content-between align-items-start">
								<div class="title_myaccount">
									<h3>Add availability</h3>
									<p>Add your availability so your followers can select a slot</p>
									<a href="#" class="myprof_btn">Add availability</a>
								</div>
								<div class="profileuser-icon"><i class="fa-solid fa-check"></i></div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-lg-6">
						<div class="card mb-4 text-white bg-whitebg">
							<div class="card-body d-flex justify-content-between align-items-start">
								<div class="title_myaccount">
									<h3>Create a service</h3>
									<p>Add a service so that your followers can book it</p>
									<a href="#" class="myprof_btn">Create a service</a>
								</div>
								<div class="profileuser-icon"><i class="fa-regular fa-newspaper"></i></div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-lg-6">
						<div class="card mb-4 text-white bg-whitebg">
							<div class="card-body d-flex justify-content-between align-items-start">
								<div class="title_myaccount">
									<h3>Connect payout</h3>
									<p>Connect Bank, Stripe or PayPal for seamless withdrawals</p>
									<a href="#" class="myprof_btn">Connect payouts</a>
								</div>
								<div class="profileuser-icon"><i class="fa-solid fa-indian-rupee-sign"></i></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>