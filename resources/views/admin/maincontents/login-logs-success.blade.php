<?php
use App\Models\GeneralSetting;
$generalSetting = GeneralSetting::find('1');
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=Email_log_Success_Report.xls");
?>
<table border="1" cellpadding="5" cellspacing="3" style="border-collapse: collapse;">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">User Type</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">IP Address</th>
      <th scope="col">Activity Details</th>
      <th scope="col">Activity Date</th>
      <th scope="col">Activity Type</th>
      <th scope="col">Platform</th>
    </tr>
  </thead>
  <tbody>
    <?php if($rows){ $sl=1; foreach($rows as $row){?>
      <tr>
        <th scope="row"><?=$sl++?></th>
        <td><?=$row->user_type?></td>
        <td><?=$row->user_name?></td>
        <td><?=$row->user_email?></td>
        <td><?=$row->ip_address?></td>
        <td><?=$row->activity_details?></td>
        <td><?=date_format(date_create($row->created_at), "M d, Y h:i A")?></td>
        <td>
          <?php if($row->activity_type == 0) {?>
            <span class="badge bg-danger">FAILED</span>
          <?php } elseif($row->activity_type == 1) {?>
            <span class="badge bg-success">SUCCESS</span>
          <?php } elseif($row->activity_type == 2) {?>
            <span class="badge bg-primary">Log Out</span>
          <?php }?>
        </td>
        <td><?=$row->platform_type?></td>
      </tr>
    <?php } }?>
  </tbody>
</table>