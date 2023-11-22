<?php
use App\Models\GeneralSetting;
$generalSetting = GeneralSetting::find('1');
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment;Filename=Transaction-export.xls');
?>
<table border="1" cellpadding="5" cellspacing="3" style="border-collapse: collapse;">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Type</th>
            <th scope="col">Date</th>
            <th scope="col">Booking No</th>
            <th scope="col">Mentor</th>
            <th scope="col">Student</th>
            <th scope="col">Opening Balance</th>
            <th scope="col">Transaction Amount</th>
            <th scope="col">Closing Balance</th>



        </tr>
    </thead>
    <tbody>
        <?php if($rows){ $sl=1; foreach($rows as $row){?>
        <tr>
            <th scope="row"><?= $sl++ ?></th>
            <td><?= $row['type'] ?></td>
            <td><?= $row['request_date'] ?></td>
            <td><?= $row['booking_no'] ?></td>
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

            <td><?= $row['opening_balance'] ?></td>
            <td><?= $row['transaction_amount'] ?></td>
            <td><?= $row['closing_balance'] ?></td>

        </tr>
        <?php } }?>
    </tbody>
</table>
