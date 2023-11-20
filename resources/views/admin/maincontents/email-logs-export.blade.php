<?php
use App\Models\GeneralSetting;
$generalSetting = GeneralSetting::find('1');
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=Email_log_Report.xls");
?>
<table border="1" cellpadding="5" cellspacing="3" style="border-collapse: collapse;">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Subject</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>
    <?php if($rows){ $sl=1; foreach($rows as $row){?>
      <tr>
        <th scope="row"><?=$sl++?></th>
        <td><?=$row->name?></td>
        <td><?=$row->email?></td>
        <td><?=$row->subject?></td>
        <td><?=date_format(date_create($row->created_at), "M d, Y h:i A")?></td>
      </tr>
    <?php } }?>
  </tbody>
</table>