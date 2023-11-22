<?php
use App\Models\GeneralSetting;
$generalSetting = GeneralSetting::find('1');
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment;Filename=booking-export.xls');
?>
<table border="1" cellpadding="5" cellspacing="3" style="border-collapse: collapse;">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th>Booking No</th>
            <th>Booking Date</th>
            <th>Mentor</th>
            <th>Student</th>
            <th>Service Type</th>
            <th>Service</th>
            <th>Duration</th>
            <th>Student Pay</th>
            <th>GST</th>
            <th>Mentor Commission</th>
            <th>Admin Commission</th>
            <th>Payment Status</th>
            <th>Status</th>

        </tr>
    </thead>
    <tbody>
        <?php if($rows){ $sl=1; foreach($rows as $row){?>
        <tr>
            <th scope="row"><?= $sl++ ?></th>
            <td><?= $row['booking_no'] ?></td>
            <td><?= $row['booking_date'] ?></td>

            <td>
                <ul>
                    <li><?= $row['mentor']['name'] ?></li>
                    <li><?= $row['mentor']['email'] ?></li>
                    <li><?= $row['mentor']['phone'] ?></li>
                </ul>
            </td>
            <td>
                <ul>
                    <li><?= $row['student']['name'] ?></li>
                    <li><?= $row['student']['email'] ?></li>
                    <li><?= $row['student']['phone'] ?></li>
                </ul>
            </td>

            <td><?= $row['service_type'] ?></td>
            <td><?= $row['service'] ?></td>
            <td><?= $row['duration'] ?></td>
            <td><?= $row['student_pay'] ?></td>
            <td><?= $row['gst'] ?></td>
            <td><?= $row['mentor_commission'] ?></td>
            <td><?= $row['admin_commission'] ?></td>
            <td><?= $row['payment_status'] ?></td>
            <td><?= $row['status'] ?></td>

        </tr>
        <?php } }?>
    </tbody>
</table>
