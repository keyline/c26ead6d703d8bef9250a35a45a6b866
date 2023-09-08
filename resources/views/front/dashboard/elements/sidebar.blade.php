<?php
    use App\Helpers\Helper;
    // Helper::pr(session()->all());die; 
?>
<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item"><a class="nav-link" href="<?=url('/dashboard/index')?>">Dashboard</a></li>
        <?php if(session()->get('role') == 2 ){ ?>
            <li class="nav-item"><a class="nav-link" href="<?=url('/dashboard/mentor-availability')?>"> Mentor Availability</a></li>
            <li class="nav-item"><a class="nav-link" href="<?=url('/dashboard/mentor-services')?>"> Mentor Service</a></li>
        <?php  } ?>
    </ul>
</div>