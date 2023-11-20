<?php
use App\Models\GeneralSetting;
$generalSetting = GeneralSetting::find('1');
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment;Filename=Mentors_Report.xls');
?>
<table border="1" cellpadding="5" cellspacing="3" style="border-collapse: collapse;">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Display Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Languages</th>
            <th scope="col">Subjects</th>
            <th scope="col">Institute</th>
            <th scope="col">Education Title</th>
            <th scope="col">Education Year</th>
            <th scope="col">Work Institute</th>
            <th scope="col">Work Title</th>
            <th scope="col">Work Year</th>
            <th scope="col">Award Title</th>
            <th scope="col">Award Year</th>
            <th scope="col">Registration Intent</th>
            <th scope="col">Qualification</th>
            <th scope="col">Experience</th>
            <th scope="col">Bank Name</th>

            <th scope="col">Branch Name</th>
            <th scope="col">Account Number</th>
            <th scope="col">Ifsc Code</th>
            <th scope="col">City</th>
            <th scope="col">Registered At</th>


        </tr>
    </thead>
    <tbody>
        <?php if($rows){ $sl=1; foreach($rows as $row){
             $language_arr=$subject_arr=$institute_arr=$eduTitle_arr=$edu_year=[];
             $work_institute=$work_title=$work_year=$award_title=$award_year=[];

             $language_arr= json_decode($row->languages);
             $subject_arr=json_decode($row->subjects);
             $institute_arr=$row->edu_institute!=null? json_decode($row->edu_institute):[];
             $eduTitle_arr=$row->edu_title!=null? json_decode($row->edu_title):[];
             $edu_year=$row->edu_year!=null? json_decode($row->edu_year):[] ;
             $work_institute=$row->work_institute!=null? json_decode($row->work_institute):[];
             $work_title=$row->work_title!=null? json_decode($row->work_title):[];
             $work_year=$row->work_year!=null? json_decode($row->work_year):[];
             $award_title=$row->award_title!=null? json_decode($row->award_title):[];
             $award_year=$row->award_year!=null? json_decode($row->award_year):[];

?>
        <tr>
            <th scope="row"><?= $sl++ ?></th>
            <td><?= $row->first_name ?></td>
            <td><?= $row->last_name ?></td>
            <td><?= $row->display_name ?></td>
            <td><?= $row->email ?></td>
            <td><?= $row->phone ?></td>
            <td><?= $row->title ?></td>
            <td><?= $row->description ?></td>
            <td><?= count($language_arr) ? implode(', ', $language_arr) : '' ?></td>
            <td><?= count($subject_arr) ? implode(', ', $subject_arr) : '' ?></td>
            <td><?= count($institute_arr) ? implode(', ', $institute_arr) : '' ?></td>
            <td><?= count($eduTitle_arr) ? implode(', ', $eduTitle_arr) : '' ?></td>
            <td><?= count($edu_year) ? implode(', ', $edu_year) : '' ?></td>
            <td><?= count($work_institute) ? implode(', ', $work_institute) : '' ?></td>
            <td><?= count($work_title) ? implode(', ', $work_title) : '' ?></td>
            <td><?= count($work_year) ? implode(', ', $work_year) : '' ?></td>
            <td><?= count($award_title) ? implode(', ', $award_title) : '' ?></td>
            <td><?= count($award_year) ? implode(', ', $award_year) : '' ?></td>
            <td><?= $row->registration_intent ?></td>
            <td><?= $row->qualification ?></td>
            <td><?= $row->experience ?></td>
            <td><?= $row->bank_name ?></td>
            <td><?= $row->branch_name ?></td>
            <td><?= $row->account_number ?></td>
            <td><?= $row->ifsc_code ?></td>
            <td><?= $row->city ?></td>
            <td><?= date_format(date_create($row->created_at), 'M d, Y h:i A') ?></td>
        </tr>
        <?php } }?>
    </tbody>
</table>
