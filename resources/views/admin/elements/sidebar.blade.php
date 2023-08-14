<?php
use Illuminate\Support\Facades\Route;;
$routeName    = Route::current();
$pageName     = explode("/", $routeName->uri());
$pageSegment  = $pageName[1];
$pageFunction = ((count($pageName)>2)?$pageName[2]:'');
// dd($routeName);
?>
<ul class="sidebar-nav" id="sidebar-nav">
  <li class="nav-item">
    <a class="nav-link <?=(($pageSegment == 'dashboard')?'active':'')?>" href="{{ url('admin/dashboard') }}">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->

  <!-- <li class="nav-heading">Access & Permission</li> -->
  <li class="nav-item">
    <a class="nav-link <?=(($pageSegment == 'module' || $pageSegment == 'sub-user' || $pageSegment == 'access')?'':'collapsed')?> <?=(($pageSegment == 'module' || $pageSegment == 'sub-user' || $pageSegment == 'access')?'active':'')?>" data-bs-target="#permission-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Access & Permission</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="permission-nav" class="nav-content collapse <?=(($pageSegment == 'module' || $pageSegment == 'sub-user' || $pageSegment == 'access')?'show':'')?>" data-bs-parent="#sidebar-nav">
      <li>
        <a class="<?=(($pageSegment == 'module')?'active':'')?>" href="{{ url('admin/module/list') }}">
          <i class="bi bi-arrow-right"></i><span>Modules</span>
        </a>
      </li>
      <li>
        <a class="<?=(($pageSegment == 'sub-user')?'active':'')?>" href="{{ url('admin/sub-user/list') }}">
          <i class="bi bi-arrow-right"></i><span>Admin Sub Users</span>
        </a>
      </li>
      <li>
        <a class="<?=(($pageSegment == 'access')?'active':'')?>" href="{{ url('admin/access/list') }}">
          <i class="bi bi-arrow-right"></i><span>Give Access</span>
        </a>
      </li>
    </ul>
  </li><!-- End Masters Nav -->

  <!-- <li class="nav-heading">Masters</li> -->
  <li class="nav-item">
    <a class="nav-link <?=(($pageSegment == 'banner' || $pageSegment == 'service-type' || $pageSegment == 'service' || $pageSegment == 'service-attribute' || $pageSegment == 'source' || $pageSegment == 'expertise' || $pageSegment == 'currency')?'':'collapsed')?> <?=(($pageSegment == 'banner' || $pageSegment == 'service-type' || $pageSegment == 'service' || $pageSegment == 'service-attribute' || $pageSegment == 'source' || $pageSegment == 'expertise' || $pageSegment == 'currency')?'active':'')?>" data-bs-target="#master-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Master Management</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="master-nav" class="nav-content collapse <?=(($pageSegment == 'banner' || $pageSegment == 'service-type' || $pageSegment == 'service' || $pageSegment == 'service-attribute' || $pageSegment == 'source' || $pageSegment == 'expertise' || $pageSegment == 'currency')?'show':'')?>" data-bs-parent="#sidebar-nav">
      <li>
        <a class="<?=(($pageSegment == 'banner')?'active':'')?>" href="{{ url('admin/banner/list') }}">
          <i class="bi bi-arrow-right"></i><span>Banners</span>
        </a>
      </li>
      <li>
        <a class="<?=(($pageSegment == 'service-type')?'active':'')?>" href="{{ url('admin/service-type/list') }}">
          <i class="bi bi-arrow-right"></i><span>Service Types</span>
        </a>
      </li>
      <li>
        <a class="<?=(($pageSegment == 'service')?'active':'')?>" href="{{ url('admin/service/list') }}">
          <i class="bi bi-arrow-right"></i><span>Services</span>
        </a>
      </li>
      <li>
        <a class="<?=(($pageSegment == 'service-attribute')?'active':'')?>" href="{{ url('admin/service-attribute/list') }}">
          <i class="bi bi-arrow-right"></i><span>Service Attributes</span>
        </a>
      </li>
      <li>
        <a class="<?=(($pageSegment == 'source')?'active':'')?>" href="{{ url('admin/source/list') }}">
          <i class="bi bi-arrow-right"></i><span>Sources</span>
        </a>
      </li>
      <li>
        <a class="<?=(($pageSegment == 'expertise')?'active':'')?>" href="{{ url('admin/expertise/list') }}">
          <i class="bi bi-arrow-right"></i><span>Expertises</span>
        </a>
      </li>
      <li>
        <a class="<?=(($pageSegment == 'currency')?'active':'')?>" href="{{ url('admin/currency/list') }}">
          <i class="bi bi-arrow-right"></i><span>Currencies</span>
        </a>
      </li>
    </ul>
  </li><!-- End Masters Nav -->

  <!-- <li class="nav-heading">Modules</li> -->
  <li class="nav-item">
    <a class="nav-link <?=(($pageSegment == 'page')?'active':'')?>" href="{{ url('admin/page/list') }}">
      <i class="bi bi-person"></i>
      <span>CMS Pages</span>
    </a>
  </li><!-- End Profile Page Nav -->

  <li class="nav-item">
    <a class="nav-link <?=(($pageSegment == 'faq')?'active':'')?>" href="{{ url('admin/faq/list') }}">
      <i class="bi bi-question"></i>
      <span>FAQs</span>
    </a>
  </li><!-- End Profile Page Nav -->

  <li class="nav-item">
    <a class="nav-link <?=(($pageSegment == 'blog-category' || $pageSegment == 'blog')?'':'collapsed')?> <?=(($pageSegment == 'blog-category' || $pageSegment == 'blog')?'active':'')?>" data-bs-target="#blog-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Blog Management</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="blog-nav" class="nav-content collapse <?=(($pageSegment == 'blog-category' || $pageSegment == 'blog')?'show':'')?>" data-bs-parent="#sidebar-nav">
      <li>
        <a class="<?=(($pageSegment == 'blog-category')?'active':'')?>" href="{{ url('admin/blog-category/list') }}">
          <i class="bi bi-arrow-right"></i><span>Category</span>
        </a>
      </li>
      <li>
        <a class="<?=(($pageSegment == 'blog')?'active':'')?>" href="{{ url('admin/blog/list') }}">
          <i class="bi bi-arrow-right"></i><span>Blogs</span>
        </a>
      </li>
    </ul>
  </li><!-- End Masters Nav -->

  <li class="nav-item <?=(($pageSegment == 'mentor')?'':'collapsed')?> <?=(($pageSegment == 'mentor')?'active':'')?>">
    <a class="nav-link collapsed" data-bs-target="#mentor-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Mentor Management</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="mentor-nav" class="nav-content collapse <?=(($pageSegment == 'mentor')?'show':'')?>" data-bs-parent="#sidebar-nav">
      <li>
        <a class="<?=(($pageSegment == 'mentor')?'active':'')?>" href="{{ url('admin/mentor/list') }}">
          <i class="bi bi-arrow-right"></i><span>List</span>
        </a>
      </li>
      <!-- <li>
        <a href="javascript:void(0);">
          <i class="bi bi-arrow-right"></i><span>Appointments</span>
        </a>
      </li>
      <li>
        <a href="javascript:void(0);">
          <i class="bi bi-arrow-right"></i><span>Transactions</span>
        </a>
      </li> -->
    </ul>
  </li><!-- End Masters Nav -->

  <li class="nav-item <?=(($pageSegment == 'student')?'':'collapsed')?> <?=(($pageSegment == 'student')?'active':'')?>">
    <a class="nav-link collapsed" data-bs-target="#student-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Student Management</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="student-nav" class="nav-content collapse <?=(($pageSegment == 'student')?'show':'')?>" data-bs-parent="#sidebar-nav">
      <li>
        <a class="<?=(($pageSegment == 'student')?'active':'')?>" href="{{ url('admin/student/list') }}">
          <i class="bi bi-arrow-right"></i><span>List</span>
        </a>
      </li>
      <!-- <li>
        <a class="<?=(($pageSegment == 'student' && $pageFunction == 'bookings')?'active':'')?>" href="{{ url('admin/student/bookings') }}">
          <i class="bi bi-arrow-right"></i><span>Booked Sessions</span>
        </a>
      </li>
      <li>
        <a class="<?=(($pageSegment == 'student' && $pageFunction == 'transactions')?'active':'')?>" href="{{ url('admin/student/transactions') }}">
          <i class="bi bi-arrow-right"></i><span>Transactions</span>
        </a>
      </li> -->
    </ul>
  </li><!-- End Masters Nav -->

  <li class="nav-item">
    <a class="nav-link <?=(($pageSegment == 'question-type' || $pageSegment == 'grade')?'':'collapsed')?> <?=(($pageSegment == 'question-type' || $pageSegment == 'grade')?'active':'')?>" data-bs-target="#survey-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Survey Management</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="survey-nav" class="nav-content collapse <?=(($pageSegment == 'question-type' || $pageSegment == 'grade')?'show':'')?>" data-bs-parent="#sidebar-nav">
      <li>
        <a class="<?=(($pageSegment == 'question-type')?'active':'')?>" href="{{ url('admin/question-type/list') }}">
          <i class="bi bi-arrow-right"></i><span>Question Type</span>
        </a>
      </li>
      <!-- <li>
        <a class="<?=(($pageSegment == 'grade')?'active':'')?>" href="{{ url('admin/grade/list') }}">
          <i class="bi bi-arrow-right"></i><span>Grade</span>
        </a>
      </li> -->
      <li>
        <a href="javascript:void(0);">
          <i class="bi bi-arrow-right"></i><span>Survey</span>
        </a>
      </li>
    </ul>
  </li><!-- End Masters Nav -->

  <li class="nav-item">
    <a class="nav-link <?=(($pageSegment == 'bookings')?'active':'')?>" href="{{ url('admin/bookings/list') }}">
      <i class="bi bi-menu-button-wide"></i>
      <span>Bookings</span>
    </a>
  </li><!-- End Profile Page Nav -->

  <li class="nav-item">
    <a class="nav-link <?=(($pageSegment == 'transactions')?'active':'')?>" href="{{ url('admin/transactions/list') }}">
      <i class="bi bi-menu-button-wide"></i>
      <span>Transactions</span>
    </a>
  </li><!-- End Profile Page Nav -->

</ul>