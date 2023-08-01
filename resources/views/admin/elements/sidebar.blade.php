<ul class="sidebar-nav" id="sidebar-nav">
  <li class="nav-item">
    <a class="nav-link " href="{{ url('admin/dashboard') }}">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->
  <!-- <li class="nav-heading">Access & Permission</li> -->
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#permission-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Access & Permission</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="permission-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="javascript:void(0);">
          <i class="bi bi-circle"></i><span>Modules</span>
        </a>
      </li>
      <li>
        <a href="javascript:void(0);">
          <i class="bi bi-circle"></i><span>Admin Sub Users</span>
        </a>
      </li>
      <li>
        <a href="javascript:void(0);">
          <i class="bi bi-circle"></i><span>Give Access</span>
        </a>
      </li>
    </ul>
  </li><!-- End Masters Nav -->
  <!-- <li class="nav-heading">Masters</li> -->
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#master-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Masters</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="master-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="{{ url('admin/banner/list') }}">
          <i class="bi bi-circle"></i><span>Banners</span>
        </a>
      </li>
      <li>
        <a href="javascript:void(0);">
          <i class="bi bi-circle"></i><span>Service Type</span>
        </a>
      </li>
      <li>
        <a href="javascript:void(0);">
          <i class="bi bi-circle"></i><span>Service</span>
        </a>
      </li>
      <li>
        <a href="javascript:void(0);">
          <i class="bi bi-circle"></i><span>Service Attribute</span>
        </a>
      </li>
      <li>
        <a href="javascript:void(0);">
          <i class="bi bi-circle"></i><span>How Do U Know</span>
        </a>
      </li>
    </ul>
  </li><!-- End Masters Nav -->
  <!-- <li class="nav-heading">Modules</li> -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="{{ url('admin/page/list') }}">
      <i class="bi bi-person"></i>
      <span>CMS Pages</span>
    </a>
  </li><!-- End Profile Page Nav -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="javascript:void(0);">
      <i class="bi bi-person"></i>
      <span>Blogs</span>
    </a>
  </li><!-- End Profile Page Nav -->
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#mentor-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Mentor</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="mentor-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="javascript:void(0);">
          <i class="bi bi-circle"></i><span>List</span>
        </a>
      </li>
      <li>
        <a href="javascript:void(0);">
          <i class="bi bi-circle"></i><span>Appointments</span>
        </a>
      </li>
      <li>
        <a href="javascript:void(0);">
          <i class="bi bi-circle"></i><span>Transactions</span>
        </a>
      </li>
    </ul>
  </li><!-- End Masters Nav -->
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#student-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Student</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="student-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="javascript:void(0);">
          <i class="bi bi-circle"></i><span>List</span>
        </a>
      </li>
      <li>
        <a href="javascript:void(0);">
          <i class="bi bi-circle"></i><span>Booked Sessions</span>
        </a>
      </li>
      <li>
        <a href="javascript:void(0);">
          <i class="bi bi-circle"></i><span>Transactions</span>
        </a>
      </li>
    </ul>
  </li><!-- End Masters Nav -->
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#survey-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Survey</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="survey-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="javascript:void(0);">
          <i class="bi bi-circle"></i><span>Question Type</span>
        </a>
      </li>
      <li>
        <a href="javascript:void(0);">
          <i class="bi bi-circle"></i><span>Grade</span>
        </a>
      </li>
      <li>
        <a href="javascript:void(0);">
          <i class="bi bi-circle"></i><span>Survey Management</span>
        </a>
      </li>
    </ul>
  </li><!-- End Masters Nav -->
</ul>