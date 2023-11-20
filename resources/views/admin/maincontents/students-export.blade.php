<?php
use App\Models\GeneralSetting;
$generalSetting = GeneralSetting::find('1');
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment;Filename=Students_Report.xls');
?>
<table border="1" cellpadding="5" cellspacing="3" style="border-collapse: collapse;">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Intro</th>
            <th scope="col">About Yourself</th>
            <th scope="col">City</th>
            <th scope="col">Registered At</th>


        </tr>
    </thead>
    <tbody>
        <?php if($rows){ $sl=1; foreach($rows as $row){?>
        <tr>
            <th scope="row"><?= $sl++ ?></th>
            <td><?= $row->first_name ?></td>
            <td><?= $row->last_name ?></td>
            <td><?= $row->email ?></td>
            <td><?= $row->phone ?></td>
            <td><?= $row->stumento_intro ?></td>
            <td><?= $row->about_yourself ?></td>
            <td><?= $row->city ?></td>
            <td><?= date_format(date_create($row->created_at), 'M d, Y h:i A') ?></td>
        </tr>
        <?php } }?>
    </tbody>
</table>
