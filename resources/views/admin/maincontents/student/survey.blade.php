<?php
use App\Helpers\Helper;
$controllerRoute = $module['controller_route'];
?>
<div class="pagetitle">
  <h1><?=$page_header?></h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=url('admin/dashboard')?>">Home</a></li>
      <li class="breadcrumb-item active"><?=$page_header?></li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<section class="section">
  <div class="row">
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
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body pt-3">
          
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Survey No</th>
                <th scope="col">Date</th>
                <th scope="col">Title</th>
                <th scope="col">Type</th>
                <th scope="col">Description</th>
                <th scope="col">Guidelines</th>
                <th scope="col">No Of Questions</th>
                <th scope="col">Score</th>
                <th scope="col">Review/Remarks</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              
              <tr>
                <th scope="row">1</th>
                <td>STUMENTO/SURVEY/000001</td>
                <td>Aug 14, 2023 11:10 AM</td>
                <td>Self-esteem</td>
                <td>MCQ</td>
                <td>
                  Self-esteem is determined by how you view yourself. We all value ourselves.Each of us has an opinion of who we are.There are several factors that can influence how you view yourself. It's possible for people to experience recurring shifts in their self-perception. However, some people don't always feel good about themselves. They may not value themselves highly.
                </td>
                <td>
                  Please click the appropriate answer for each item, depending on whether you Strongly agree, agree, disagree, or strongly disagree with it.
                </td>
                <td>10</td>
                <td>25 (High)</td>
                <td>
                  In your case you have high self esteem: Pros of High self-esteem-Appraisal of the effects of self-esteem is complicated by several factors. Because many people with high self-esteem exaggerate their successes and good traits, we emphasize objective measures of outcomes. Cons of high self-esteem- High self-esteem is also a heterogeneous category, encompassing people who frankly accept their good qualities along with narcissistic, defensive, and conceited individuals.
                </td>
                <td>
                  <a target="_blank" href="<?=url('admin/' . $controllerRoute . '/view-survey-details/'.Helper::encoded(1))?>" class="btn btn-outline-info btn-sm" title="View Survey Details"><i class="fa fa-info-circle"></i></a>
                </td>
              </tr>

            </tbody>
          </table>
          
        </div>
      </div>

    </div>
  </div>
</section>