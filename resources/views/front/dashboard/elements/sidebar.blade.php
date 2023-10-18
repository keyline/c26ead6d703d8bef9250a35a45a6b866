<?php
    use App\Helpers\Helper;
    // Helper::pr(session()->all());die; 
?>
<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item"><a class="nav-link" href="<?=url('/user/dashboard')?>"><i class="fa fa-home" style="margin-right:10px;"></i> Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="<?=url('/user/profile')?>"><i class="fa fa-user" style="margin-right:10px;"></i> Profile</a></li>
        <?php if(session()->get('role') == 1){?>
            <li class="nav-item"><a class="nav-link" href="<?=url('/user/student-bookings')?>"><i class="fa fa-list" style="margin-right:10px;"></i> Bookings</a></li>
            <li class="nav-item"><a class="nav-link" href="<?=url('/user/student-transactions')?>"><i class="fa fa-inr" style="margin-right:10px;"></i> Transactions</a></li>
            <li class="nav-item"><a class="nav-link" href="<?=url('/user/student-feedback-list')?>"><i class="fa fa-comment" style="margin-right:10px;"></i> Feedbacks</a></li>
        <?php  } ?>
        <?php if(session()->get('role') == 2){?>
            <li class="nav-item"><a class="nav-link" href="<?=url('/dashboard/mentor-availability')?>"><i class="fa fa-home" style="margin-right:10px;"></i> Mentor Availability</a></li>
            <li class="nav-item"><a class="nav-link" href="<?=url('/dashboard/mentor-services')?>"><i class="fa fa-home" style="margin-right:10px;"></i> Mentor Service</a></li>
            <li class="nav-item"><a class="nav-link" href="<?=url('/user/mentor-bookings')?>"><i class="fa fa-list" style="margin-right:10px;"></i> Bookings</a></li>
            <li class="nav-item"><a class="nav-link" href="<?=url('/user/mentor-transactions')?>"><i class="fa fa-inr" style="margin-right:10px;"></i> Transactions</a></li>
            <li class="nav-item"><a class="nav-link" href="<?=url('/user/mentor-withdrawls')?>"><i class="fa fa-inr" style="margin-right:10px;"></i> Withdrawls</a></li>
            <li class="nav-item"><a class="nav-link" href="<?=url('/user/mentor-feedback-list')?>"><i class="fa fa-comment" style="margin-right:10px;"></i> Feedbacks</a></li>
        <?php  } ?>
    </ul>
</div>