<div class="account_wrapper">
	<?=$sidebar;?>
	<div class="wrapper account_inner_section d-flex flex-column bg-light">
		<header class="header header-sticky mb-4">
			<div class="container-fluid">
				<button class="header-toggler px-md-0 me-md-3 d-md-none" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
					<i class="fa-solid fa-bars"></i>
				</button>
				<h4 class="pagestitle-item mb-0"><?=$page_header?></h4>
				<ul class="header-nav ms-auto"></ul>
			</div>
		</header>
		<div class="body flex-grow-1 px-3">
			<div class="container-fluid-lg">
				<?php
				$role = Session::get('role');
				if($role == 1){
				?>
					<div class="row">
						<div class="col-sm-6 col-lg-6">
							<div class="card mb-4 text-white bg-whitebg">
								<div class="card-body d-flex justify-content-between align-items-start">
									<div class="title_myaccount">
										<h3>All Bookings</h3>
										<!-- <p>All Bookings</p> -->
										<a href="<?=url('user/student-bookings')?>" class="myprof_btn">All Bookings</a>
									</div>
									<div class="profileuser-icon"><i class="fa-solid fa-user"></i> <?=count($all_bookings)?> </div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-lg-6">
							<div class="card mb-4 text-white bg-whitebg">
								<div class="card-body d-flex justify-content-between align-items-start">
									<div class="title_myaccount">
										<h3>Upcoming Bookings</h3>
										<!-- <p>Upcoming Bookings</p> -->
										<a href="<?=url('user/student-bookings')?>" class="myprof_btn">Upcoming Bookings</a>
									</div>
									<div class="profileuser-icon"><i class="fa-solid fa-check"></i> <?=count($upcoming_bookings)?> </div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-lg-6">
							<div class="card mb-4 text-white bg-whitebg">
								<div class="card-body d-flex justify-content-between align-items-start">
									<div class="title_myaccount">
										<h3>Cancel Bookings</h3>
										<!-- <p>Cancel Bookings</p> -->
										<a href="<?=url('user/student-bookings')?>" class="myprof_btn">Cancel Bookings</a>
									</div>
									<div class="profileuser-icon"><i class="fa-regular fa-newspaper"></i> <?=count($past_bookings)?> </div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-lg-6">
							<div class="card mb-4 text-white bg-whitebg">
								<div class="card-body d-flex justify-content-between align-items-start">
									<div class="title_myaccount">
										<h3>Transactions</h3>
										<!-- <p>Transactions</p> -->
										<a href="<?=url('user/student-transactions')?>" class="myprof_btn">Transactions</a>
									</div>
									<div class="profileuser-icon"><i class="fa-solid fa-indian-rupee-sign"></i> <?=$transaction?> </div>
								</div>
							</div>
						</div>
					</div>
				<?php } else {?>
					<div class="row">
						<div class="col-sm-6 col-lg-6">
							<div class="card mb-4 text-white bg-whitebg">
								<div class="card-body d-flex justify-content-between align-items-start">
									<div class="title_myaccount">
										<h3>Complete your profile</h3>
										<!-- <p>Add your profile pic and description</p> -->
										<a href="<?=url('user/profile')?>" class="myprof_btn">Complete your profile</a>
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
										<!-- <p>Add your availability so your followers can select a slot</p> -->
										<a href="<?=url('user/mentor-availability')?>" class="myprof_btn">Add availability</a>
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
										<!-- <p>Add a service so that your followers can book it</p> -->
										<a href="<?=url('user/mentor-services')?>" class="myprof_btn">Create a service</a>
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
										<!-- <p>Connect Bank, Stripe or PayPal for seamless withdrawals</p> -->
										<a href="<?=url('user/mentor-transactions')?>" class="myprof_btn">Connect payouts</a>
									</div>
									<div class="profileuser-icon"><i class="fa-solid fa-indian-rupee-sign"></i></div>
								</div>
							</div>
						</div>
					</div>
				<?php }?>
			</div>
		</div>
	</div>
</div>