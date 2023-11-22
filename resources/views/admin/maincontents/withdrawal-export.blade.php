<?php
use App\Models\GeneralSetting;
$generalSetting = GeneralSetting::find('1');
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment;Filename=Withdrawal_Report.xls');
?>
<table border="1" cellpadding="5" cellspacing="3" style="border-collapse: collapse;">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Request Date</th>
            <th scope="col">Booking Number</th>
            <th scope="col"> Name</th>
            <th scope="col"> Email</th>
            <th scope="col"> Number</th>
            <th scope="col">Requested Amount</th>
            <th scope="col">Status</th>
            <th scope="col">Approve/Reject Date</th>



        </tr>
    </thead>
    <tbody>
        <?php if($rows){ $sl=1; foreach($rows as $row){?>
        <tr>
            <th scope="row"><?= $sl++ ?></th>
            <td><?= $row['request_date'] ?></td>
            <td><?= $row['booking_no'] ?></td>
            <td><?= $row['mentor']['name'] ?></td>
            <td><?= $row['mentor']['email'] ?></td>
            <td><?= $row['mentor']['phone'] ?></td>
            <td><?= $row['amount'] ?></td>
            <td><?= $row['Status'] ?></td>
            <td><?= $row['status_update_date'] ?></td>

        </tr>
        <?php } }?>
    </tbody>
</table>
