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
      <i class="fa fa-home"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->

  <?php
  if($admin->type == 'ma'){?>
    <?php if((in_array(8, $module_id)) || (in_array(9, $module_id)) || (in_array(10, $module_id))){?>
    <li class="nav-item">
      <a class="nav-link <?=(($pageSegment == 'module' || $pageSegment == 'sub-user' || $pageSegment == 'access')?'':'collapsed')?> <?=(($pageSegment == 'module' || $pageSegment == 'sub-user' || $pageSegment == 'access')?'active':'')?>" data-bs-target="#permission-nav" data-bs-toggle="collapse" href="#">
        <i class="fa fa-lock"></i><span>Access & Permission</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="permission-nav" class="nav-content collapse <?=(($pageSegment == 'module' || $pageSegment == 'sub-user' || $pageSegment == 'access')?'show':'')?>" data-bs-parent="#sidebar-nav">
        <?php if(in_array(8, $module_id)){?>
        <li>
          <a class="<?=(($pageSegment == 'module')?'active':'')?>" href="{{ url('admin/module/list') }}">
            <i class="bi bi-arrow-right"></i><span>Modules</span>
          </a>
        </li>
        <?php }?>
        <?php if(in_array(9, $module_id)){?>
        <li>
          <a class="<?=(($pageSegment == 'sub-user')?'active':'')?>" href="{{ url('admin/sub-user/list') }}">
            <i class="bi bi-arrow-right"></i><span>Admin Sub Users</span>
          </a>
        </li>
        <?php }?>
        <?php if(in_array(10, $module_id)){?>
        <li>
          <a class="<?=(($pageSegment == 'access')?'active':'')?>" href="{{ url('admin/access/list') }}">
            <i class="bi bi-arrow-right"></i><span>Give Access</span>
          </a>
        </li>
        <?php }?>
      </ul>
    </li><!-- End Masters Nav -->
    <?php }?>
  <?php }?>

  <?php if((in_array(1, $module_id)) || (in_array(2, $module_id)) || (in_array(3, $module_id)) || (in_array(4, $module_id)) || (in_array(5, $module_id)) || (in_array(6, $module_id)) || (in_array(7, $module_id)) || (in_array(28, $module_id)) || (in_array(31, $module_id)) || (in_array(33, $module_id)) || (in_array(34, $module_id)) || (in_array(35, $module_id))){?>
  <li class="nav-item">
    <a class="nav-link <?=(($pageSegment == 'banner' || $pageSegment == 'service-type' || $pageSegment == 'service' || $pageSegment == 'service-attribute' || $pageSegment == 'source' || $pageSegment == 'expertise' || $pageSegment == 'currency' || $pageSegment == 'language' || $pageSegment == 'subject' || $pageSegment == 'testimonial' || $pageSegment == 'social-platform')?'':'collapsed')?> <?=(($pageSegment == 'banner' || $pageSegment == 'service-type' || $pageSegment == 'service' || $pageSegment == 'service-attribute' || $pageSegment == 'service-association' || $pageSegment == 'source' || $pageSegment == 'expertise' || $pageSegment == 'currency' || $pageSegment == 'language' || $pageSegment == 'subject' || $pageSegment == 'testimonial' || $pageSegment == 'social-platform' || $pageSegment == 'require-documents'  )?'active':'')?>" data-bs-target="#master-nav" data-bs-toggle="collapse" href="#">
      <i class="fa fa-database"></i><span>Master Management</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="master-nav" class="nav-content collapse <?=(($pageSegment == 'banner' || $pageSegment == 'service-type' || $pageSegment == 'service' || $pageSegment == 'service-attribute' || $pageSegment == 'service-association' || $pageSegment == 'source' || $pageSegment == 'expertise' || $pageSegment == 'currency' || $pageSegment == 'language' || $pageSegment == 'subject' || $pageSegment == 'testimonial' || $pageSegment == 'social-platform' || $pageSegment == 'require-documents')?'show':'')?>" data-bs-parent="#sidebar-nav">
      <?php if(in_array(1, $module_id)){?>
      <li>
        <a class="<?=(($pageSegment == 'banner')?'active':'')?>" href="{{ url('admin/banner/list') }}">
          <i class="bi bi-arrow-right"></i><span>Banners</span>
        </a>
      </li>
      <?php }?>
      <?php if(in_array(2, $module_id)){?>
      <li>
        <a class="<?=(($pageSegment == 'service-type')?'active':'')?>" href="{{ url('admin/service-type/list') }}">
          <i class="bi bi-arrow-right"></i><span>Service Types</span>
        </a>
      </li>
      <?php }?>
      <?php if(in_array(3, $module_id)){?>
      <li>
        <a class="<?=(($pageSegment == 'service')?'active':'')?>" href="{{ url('admin/service/list') }}">
          <i class="bi bi-arrow-right"></i><span>Services</span>
        </a>
      </li>
      <?php }?>
      <?php if(in_array(4, $module_id)){?>
      <li>
        <a class="<?=(($pageSegment == 'service-attribute')?'active':'')?>" href="{{ url('admin/service-attribute/list') }}">
          <i class="bi bi-arrow-right"></i><span>Service Attributes</span>
        </a>
      </li>
      <?php }?>
      <?php if(in_array(34, $module_id)){?>
      <li>
        <a class="<?=(($pageSegment == 'service-association')?'active':'')?>" href="{{ url('admin/service-association') }}">
          <i class="bi bi-arrow-right"></i><span>Services Association</span>
        </a>
      </li>
      <?php }?>
      <?php if(in_array(5, $module_id)){?>
      <li>
        <a class="<?=(($pageSegment == 'source')?'active':'')?>" href="{{ url('admin/source/list') }}">
          <i class="bi bi-arrow-right"></i><span>Sources</span>
        </a>
      </li>
      <?php }?>
      <?php if(in_array(6, $module_id)){?>
      <li>
        <a class="<?=(($pageSegment == 'expertise')?'active':'')?>" href="{{ url('admin/expertise/list') }}">
          <i class="bi bi-arrow-right"></i><span>Expertises</span>
        </a>
      </li>
      <?php }?>
      <?php if(in_array(7, $module_id)){?>
      <li>
        <a class="<?=(($pageSegment == 'currency')?'active':'')?>" href="{{ url('admin/currency/list') }}">
          <i class="bi bi-arrow-right"></i><span>Currencies</span>
        </a>
      </li>
      <?php }?>
      <?php if(in_array(28, $module_id)){?>
      <li>
        <a class="<?=(($pageSegment == 'language')?'active':'')?>" href="{{ url('admin/language/list') }}">
          <i class="bi bi-arrow-right"></i><span>Languages</span>
        </a>
      </li>
      <?php }?>
      <?php if(in_array(33, $module_id)){?>
      <li>
        <a class="<?=(($pageSegment == 'subject')?'active':'')?>" href="{{ url('admin/subject/list') }}">
          <i class="bi bi-arrow-right"></i><span>Subjects</span>
        </a>
      </li>
      <?php }?>
      <?php if(in_array(28, $module_id)){?>
      <li>
        <a class="<?=(($pageSegment == 'testimonial')?'active':'')?>" href="{{ url('admin/testimonial/list') }}">
          <i class="bi bi-arrow-right"></i><span>Testimonials</span>
        </a>
      </li>
      <?php }?>
      <?php if(in_array(31, $module_id)){?>
      <li>
        <a class="<?=(($pageSegment == 'social-platform')?'active':'')?>" href="{{ url('admin/social-platform/list') }}">
          <i class="bi bi-arrow-right"></i><span>Social Platforms</span>
        </a>
      </li>
      <?php }?>
      <?php if(in_array(35, $module_id)){?>
      <li>
        <a class="<?=(($pageSegment == 'require-documents')?'active':'')?>" href="{{ url('admin/require-documents/list') }}">
          <i class="bi bi-arrow-right"></i><span>Require Documents</span>
        </a>
      </li>
      <?php }?>
    </ul>
  </li><!-- End Masters Nav -->
  <?php }?>

  <?php if((in_array(11, $module_id))) {?>
  <li class="nav-item">
    <a class="nav-link <?=(($pageSegment == 'page')?'active':'')?>" href="{{ url('admin/page/list') }}">
      <i class="fa fa-file-text"></i>
      <span>CMS Pages</span>
    </a>
  </li><!-- End Profile Page Nav -->
  <?php }?>

  <?php if((in_array(11, $module_id))) {?>
  <li class="nav-item">
    <a class="nav-link <?=(($pageSegment == 'meta')?'active':'')?>" href="{{ url('admin/meta/list') }}">
      <i class="fa fa-file-text"></i>
      <span>Meta Informations</span>
    </a>
  </li><!-- End Profile Page Nav -->
  <?php }?>
  
  <?php if((in_array(12, $module_id)) || (in_array(29, $module_id))){?>
  <li class="nav-item">
      <a class="nav-link <?=(($pageSegment == 'faq' || $pageSegment == 'how-it-works')?'':'collapsed')?> <?=(($pageSegment == 'faq' || $pageSegment == 'how-it-works')?'active':'')?>" data-bs-target="#faq-nav" data-bs-toggle="collapse" href="#">
        <i class="fa fa-lock"></i><span>FAQ</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="faq-nav" class="nav-content collapse <?=(($pageSegment == 'faq' || $pageSegment == 'how-it-works')?'show':'')?>" data-bs-parent="#sidebar-nav">
        <?php if(in_array(12, $module_id)){?>
        <li>
          <a class="<?=(($pageSegment == 'faq')?'active':'')?>" href="{{ url('admin/faq/list') }}">
            <i class="bi bi-arrow-right"></i><span>FAQs</span>
          </a>
        </li>
        <?php }?>
        <?php if(in_array(29, $module_id)){?>
        <li>
          <a class="<?=(($pageSegment == 'how-it-works')?'active':'')?>" href="{{ url('admin/how-it-works/list') }}">
            <i class="bi bi-arrow-right"></i><span>How It Works</span>
          </a>
        </li>
        <?php }?>
      </ul>
    </li><!-- End Masters Nav -->
  <?php }?>

  <?php if((in_array(13, $module_id))) {?>
  <li class="nav-item">
    <a class="nav-link <?=(($pageSegment == 'team')?'active':'')?>" href="{{ url('admin/team/list') }}">
      <i class="fa fa-users"></i>
      <span>Teams</span>
    </a>
  </li><!-- End Profile Page Nav -->
  <?php }?>

  <?php if((in_array(14, $module_id)) || (in_array(15, $module_id))) {?>
  <li class="nav-item">
    <a class="nav-link <?=(($pageSegment == 'blog-category' || $pageSegment == 'blog')?'':'collapsed')?> <?=(($pageSegment == 'blog-category' || $pageSegment == 'blog')?'active':'')?>" data-bs-target="#blog-nav" data-bs-toggle="collapse" href="#">
      <i class="fa-solid fa-blog"></i><span>Blog Management</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="blog-nav" class="nav-content collapse <?=(($pageSegment == 'blog-category' || $pageSegment == 'blog')?'show':'')?>" data-bs-parent="#sidebar-nav">
      <?php if(in_array(14, $module_id)){?>
      <li>
        <a class="<?=(($pageSegment == 'blog-category')?'active':'')?>" href="{{ url('admin/blog-category/list') }}">
          <i class="bi bi-arrow-right"></i><span>Category</span>
        </a>
      </li>
      <?php }?>
      <?php if(in_array(15, $module_id)){?>
      <li>
        <a class="<?=(($pageSegment == 'blog')?'active':'')?>" href="{{ url('admin/blog/list') }}">
          <i class="bi bi-arrow-right"></i><span>Blogs</span>
        </a>
      </li>
      <?php }?>
    </ul>
  </li><!-- End Masters Nav -->
  <?php }?>

  <?php if(in_array(16, $module_id)){?>
  <li class="nav-item <?=(($pageSegment == 'mentor')?'':'collapsed')?> <?=(($pageSegment == 'mentor')?'active':'')?>">
    <a class="nav-link collapsed" data-bs-target="#mentor-nav" data-bs-toggle="collapse" href="#">
      <i class="fa fa-users"></i><span>Mentor Management</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="mentor-nav" class="nav-content collapse <?=(($pageSegment == 'mentor')?'show':'')?>" data-bs-parent="#sidebar-nav">
      <?php if(in_array(16, $module_id)){?>
      <li>
        <a class="<?=(($pageSegment == 'mentor')?'active':'')?>" href="{{ url('admin/mentor/list') }}">
          <i class="bi bi-arrow-right"></i><span>List</span>
        </a>
      </li>
      <?php }?>
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
  <?php }?>

  <?php if(in_array(17, $module_id)){?>
  <li class="nav-item <?=(($pageSegment == 'student')?'':'collapsed')?> <?=(($pageSegment == 'student')?'active':'')?>">
    <a class="nav-link collapsed" data-bs-target="#student-nav" data-bs-toggle="collapse" href="#">
      <i class="fa fa-users"></i><span>Student Management</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="student-nav" class="nav-content collapse <?=(($pageSegment == 'student')?'show':'')?>" data-bs-parent="#sidebar-nav">
      <?php if(in_array(17, $module_id)){?>
      <li>
        <a class="<?=(($pageSegment == 'student')?'active':'')?>" href="{{ url('admin/student/list') }}">
          <i class="bi bi-arrow-right"></i><span>List</span>
        </a>
      </li>
      <?php }?>
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
  <?php }?>

  <?php if((in_array(18, $module_id)) || (in_array(19, $module_id)) || (in_array(32, $module_id))) {?>
  <li class="nav-item">
    <a class="nav-link <?=(($pageSegment == 'question-type' || $pageSegment == 'survey' || $pageSegment == 'survey-students')?'':'collapsed')?> <?=(($pageSegment == 'question-type' || $pageSegment == 'survey' || $pageSegment == 'survey-students')?'active':'')?>" data-bs-target="#survey-nav" data-bs-toggle="collapse" href="#">
      <i class="fa fa-poll"></i><span>Survey Management</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="survey-nav" class="nav-content collapse <?=(($pageSegment == 'question-type' || $pageSegment == 'survey' || $pageSegment == 'survey-students')?'show':'')?>" data-bs-parent="#sidebar-nav">
      <?php if(in_array(18, $module_id)){?>
      <li>
        <a class="<?=(($pageSegment == 'question-type')?'active':'')?>" href="{{ url('admin/question-type/list') }}">
          <i class="bi bi-arrow-right"></i><span>Question Type</span>
        </a>
      </li>
      <?php }?>
      <!-- <li>
        <a class="<?=(($pageSegment == 'grade')?'active':'')?>" href="{{ url('admin/grade/list') }}">
          <i class="bi bi-arrow-right"></i><span>Grade</span>
        </a>
      </li> -->
      <?php if(in_array(19, $module_id)){?>
      <li>
        <a class="<?=(($pageSegment == 'survey')?'active':'')?>" href="{{ url('admin/survey/list')}}">
          <i class="bi bi-arrow-right"></i><span>Survey</span>
        </a>
      </li>
      <?php }?>
      <?php if(in_array(32, $module_id)){?>
      <li>
        <a class="<?=(($pageSegment == 'survey-students')?'active':'')?>" href="{{ url('admin/survey/survey-students')}}">
          <i class="bi bi-arrow-right"></i><span>Student Survey</span>
        </a>
      </li>
      <?php }?>
    </ul>
  </li><!-- End Masters Nav -->
  <?php }?>

  <?php if(in_array(20, $module_id)){?>
  <li class="nav-item">
    <a class="nav-link <?=(($pageSegment == 'bookings')?'active':'')?>" href="{{ url('admin/bookings/list') }}">
      <i class="fa fa-list"></i>
      <span>Bookings</span>
    </a>
  </li><!-- End Profile Page Nav -->
  <?php }?>

  <?php if(in_array(21, $module_id)){?>
    <li class="nav-item">
      <a class="nav-link <?=(($pageSegment == 'transactions')?'active':'')?>" href="{{ url('admin/transactions/list') }}">
        <i class="fa fa-inr"></i>
        <span>Transactions</span>
      </a>
    </li><!-- End Profile Page Nav -->
  <?php }?>

  <?php if(in_array(36, $module_id)){?>
    <li class="nav-item">
      <a class="nav-link <?=(($pageSegment == 'withdrawls')?'active':'')?>" href="{{ url('admin/withdrawls/list') }}">
        <i class="fa fa-inr"></i>
        <span>Withdrawls</span>
      </a>
    </li><!-- End Profile Page Nav -->
  <?php }?>

  <?php if(in_array(37, $module_id)){?>
    <li class="nav-item">
      <a class="nav-link <?=(($pageSegment == 'feedbacks')?'active':'')?>" href="{{ url('admin/feedbacks/list') }}">
        <i class="fa fa-comment"></i>
        <span>Booking Reviews</span>
      </a>
    </li><!-- End Profile Page Nav -->
  <?php }?>
  <?php if(in_array(38, $module_id)){?>
    <li class="nav-item">
      <a class="nav-link <?=(($pageSegment == 'platform-reviews')?'active':'')?>" href="{{ url('admin/platform-reviews/list') }}">
        <i class="fa-solid fa-star"></i>
        <span>Platform Reviews</span>
      </a>
    </li><!-- End Profile Page Nav -->
  <?php }?>

  <?php if(in_array(25, $module_id)){?>
    <li class="nav-item">
      <a class="nav-link <?=(($pageSegment == 'email-logs')?'active':'')?>" href="{{ url('admin/email-logs') }}">
        <i class="fa fa-envelope"></i>
        <span>Email Logs</span>
      </a>
    </li><!-- End Profile Page Nav -->
  <?php }?>

  <?php if(in_array(26, $module_id)){?>
    <li class="nav-item">
      <a class="nav-link <?=(($pageSegment == 'login-logs')?'active':'')?>" href="{{ url('admin/login-logs') }}">
        <i class="fa fa-list"></i>
        <span>Login Logs</span>
      </a>
    </li><!-- End Profile Page Nav -->
  <?php }?>

  <?php if(in_array(30, $module_id)){?>
    <li class="nav-item">
      <a class="nav-link <?=(($pageSegment == 'enquiry')?'active':'')?>" href="{{ url('admin/enquiry/list') }}">
        <i class="fa fa-envelope"></i>
        <span>Contact Enquiries</span>
      </a>
    </li><!-- End Profile Page Nav -->
  <?php }?>

  <?php if(in_array(27, $module_id)){?>
    <li class="nav-item">
      <a class="nav-link <?=(($pageSegment == 'settings')?'active':'')?>" href="{{ url('admin/settings') }}">
        <i class="fa fa-cogs"></i>
        <span>Account Settings</span>
      </a>
    </li><!-- End Profile Page Nav -->
  <?php }?>

</ul>