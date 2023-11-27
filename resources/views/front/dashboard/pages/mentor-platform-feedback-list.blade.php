<?php
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MentorProfile;
use App\Models\ServiceType;
use App\Models\Service;
use App\Models\ServiceAttribute;
use App\Models\ServiceDetail;
use App\Models\ServiceTypeAttribute;
use App\Models\StudentProfile;
use App\Models\Booking;
use App\Models\BookingRating;
use App\Models\PlatformRating;
use App\Helpers\Helper;
?>
<div class="account_wrapper">
	<?=$sidebar;?>
	<div class="wrapper account_inner_section d-flex flex-column min-vh-100 bg-light">
		<header class="header header-sticky mb-4">
			<div class="container-fluid">
				<button class="header-toggler px-md-0 me-md-3 d-md-none" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()"><i class="fa-solid fa-bars"></i></button>
				<h4 class="pagestitle-item mb-0"><?=$page_header?></h4>
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
			<div class="container-fluid-lg">
				<div class="row">
					<div class="col-sm-12 col-lg-12">
						<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#feedbackModal"><i class="fa-solid fa-star"></i> Submit Review</button>
						<div class="table-responsive">
							<table id="example3" class="stripe table cell-border hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Rating</th>
										<th>Review</th>
										<th>Approved Date/Time</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if($feedbacks){ $sl=1; foreach($feedbacks as $feedback){
										$mentor = User::where('id', '=', $feedback->user_id)->first();
									?>
										<tr>
											<td><?=$sl++?></td>
											<td>
												<div class="m-left d-table">
													<?php for($i=1;$i<=$feedback->rating;$i++){?>
														<span class="fa fa-star checked"></span>
													<?php } ?>
													<?php for($i=1;$i<=(5 - $feedback->rating);$i++){?>
														<span class="fa fa-star"></span>
													<?php } ?>
												</div>
											</td>
											<td><?=$feedback->review?></td>
											<td><?=(($feedback->approve_tmestamp != '')?date_format(date_create($feedback->approve_tmestamp), "M d, Y h:i A"):'')?></td>
											<td>
												<?php if($feedback->status){?>
													<span class="badge bg-success">Approved</span>
												<?php } else {?>
													<span class="badge bg-warning">Pending</span>
												<?php }?>
											</td>
										</tr>
									<?php } }?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Feedback</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="feedback_start">
            <p>Please give platform feedabck</p>
            <form class="" method="POST" action="">
	            <div class="feedstar rating">
                @csrf
                <label>
                    <input type="radio" name="stars" value="1" />
                    <span class="icon">★</span>
                </label>
                <label>
                    <input type="radio" name="stars" value="2" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
                <label>
                    <input type="radio" name="stars" value="3" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>   
                </label>
                <label>
                    <input type="radio" name="stars" value="4" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
                <label>
                    <input type="radio" name="stars" value="5" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
	            </div>
	            <div class="mb-3 feedbcknote_label">
                <label for="exampleFormControlTextarea1" class="form-label">Review :</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="review" rows="3" required></textarea>
                <button type="submit" class="btn mt-3 m-auto d-table btn-primary">Submit</button>
	            </div>
            </form>
        </div>
      </div>
    </div>
	</div>
</div>
<style>
	.checked {
	  color: orange;
	}
	.rating {
	  display: inline-block;
	  position: relative;
	  height: 50px;
	  line-height: 50px;
	  font-size: 50px;
	}

	.rating label {
	  position: absolute;
	  top: 0;
	  left: 0;
	  height: 100%;
	  cursor: pointer;
	}

	.rating label:last-child {
	  position: static;
	}

	.rating label:nth-child(1) {
	  z-index: 5;
	}

	.rating label:nth-child(2) {
	  z-index: 4;
	}

	.rating label:nth-child(3) {
	  z-index: 3;
	}

	.rating label:nth-child(4) {
	  z-index: 2;
	}

	.rating label:nth-child(5) {
	  z-index: 1;
	}

	.rating label input {
	  position: absolute;
	  top: 0;
	  left: 0;
	  opacity: 0;
	}

	.rating label .icon {
	  float: left;
	  color: transparent;
	  width: 3rem !important;
	    height: 1rem !important;
	    font-size: 3rem !important;
	}

	.rating label:last-child .icon {
	  color: #000;
	}

	.rating:not(:hover) label input:checked ~ .icon,
	.rating:hover label:hover input ~ .icon {
	  color: #f9233f;
	}

	.rating label input:focus:not(:checked) ~ .icon:last-child {
	  color: #000;
	  text-shadow: 0 0 5px #09f;
	}
</style>
<script>
	$(':radio').change(function() {
	  console.log('New star rating: ' + this.value);
	});
</script>