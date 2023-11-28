<?php
use App\Models\GeneralSetting;
$generalSetting             = GeneralSetting::find('1');
?>
<!doctype html>
<html lang="en">
  <head>
      <title><?=$generalSetting->site_name?></title>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  </head>
  <body style="padding: 0; margin: 0; box-sizing: border-box;">
      <section style="padding: 80px 0; height: 80vh; margin: 0 15px;">
          <div style="max-width: 600px; background: #ffffff; margin: 0 auto; border-radius: 15px; padding: 20px 15px; box-shadow: 0 0 30px -5px #ccc;">
              <div style="text-align: center;">
                  <img src="https://keylines.net.in/dev/stumento_html/assets/images/logo.png" alt="" style=" width: 100%; max-width: 250px;">
              </div>
              <div>
                  <h3 style="text-align: center; font-size: 25px; color: #5c5b5b; font-family: sans-serif;">Meeting</h3>
                  <table style="width: 100%;  border-spacing: 2px;">
                      <tbody>
                          <tr>
                              <th style="background: #ccc; color: #000; width: 30%; padding: 10px; text-align: left; font-family: sans-serif; font-size: 14px;">Mentor Name</th>
                              <td style="padding: 10px; background: #ccc; text-align: left; color: #000;font-family: sans-serif;font-size: 15px;"><?=$mentor?></td>
                          </tr>
                          <tr>
                              <th style="background: #cccccc42; color: #000; width: 30%; padding: 10px; text-align: left; font-family: sans-serif; font-size: 14px;">Student Name</th>
                              <td style="padding: 10px; background: #cccccc42; text-align: left; color: #000;font-family: sans-serif;font-size: 15px;"><?=$student?></td>
                          </tr>
                          <tr>
                              <th style="background: #cccccc; color: #000; width: 30%; padding: 10px; text-align: left; font-family: sans-serif; font-size: 14px;">Booking Id</th>
                              <td style="padding: 10px; background: #cccccc; text-align: left; color: #000;font-family: sans-serif;font-size: 15px;"><?=$booking_no?></td>
                          </tr>
                          <tr>
                              <th style="background: #cccccc42; color: #000; width: 30%; padding: 10px; text-align: left; font-family: sans-serif; font-size: 14px;">Booking Date, Time</th>
                              <td style="padding: 10px; background: #cccccc42; text-align: left; color: #000;font-family: sans-serif;font-size: 15px;"><?=$booking_date?> <?=$booking_time?></td>
                          </tr>
                          <tr>
                              <th style="background: #cccccc42; color: #000; width: 30%; padding: 10px; text-align: left; font-family: sans-serif; font-size: 14px;">Duration</th>
                              <td style="padding: 10px; background: #cccccc42; text-align: left; color: #000;font-family: sans-serif;font-size: 15px;"><?=$meeting_duration?> Mins</td>
                          </tr>
                          <tr>
                              <th style="background: #cccccc; color: #000; width: 30%; padding: 10px; text-align: left; font-family: sans-serif; font-size: 14px;">Payment Date, Time</th>
                              <td style="padding: 10px; background: #cccccc; text-align: left; color: #000;font-family: sans-serif;font-size: 15px;"><?=$payment_date_time?></td>
                          </tr>
                          <tr>
                              <th style="background: #cccccc42; color: #000; width: 30%; padding: 10px; text-align: left; font-family: sans-serif; font-size: 14px;">Payment Amount</th>
                              <td style="padding: 10px; background: #cccccc42; text-align: left; color: #000;font-family: sans-serif;font-size: 15px;">&#8377; <?=$payment_amount?></td>
                          </tr>
                          <tr>
                              <th style="background: #cccccc; color: #000; width: 30%; padding: 10px; text-align: left; font-family: sans-serif; font-size: 14px;">Payment Status</th>
                              <td style="padding: 10px; background: #cccccc; text-align: left; color: #000;font-family: sans-serif;font-size: 15px;"><?=$payment_status?></td>
                          </tr>
                          <tr>
                              <th style="background: #cccccc42; color: #000; width: 30%; padding: 10px; text-align: left; font-family: sans-serif; font-size: 14px;">Meeting Link</th>
                              <td style="padding: 10px; background: #cccccc42; text-align: left; color: #000;font-family: sans-serif;font-size: 15px;"><a href="<?=$meeting_link?>" style="background: #f9233f; color: #fff; padding: 8px 13px; border-radius: 5px; text-decoration: none;">Join Now</a></td>
                          </tr>
                          <tr>
                              <th style="background: #cccccc; color: #000; width: 30%; padding: 10px; text-align: left; font-family: sans-serif; font-size: 14px;">Passcode</th>
                              <td style="padding: 10px; background: #cccccc; text-align: left; color: #000;font-family: sans-serif;font-size: 15px;"><?=$meeting_passcode?></td>
                          </tr>
                      </tbody>
                  </table>
              </div>
          </div>
          <div style="border-top: 2px solid #ccc; margin-top: 50px; text-align: center; font-family: sans-serif;">
              <div style="text-align: center; margin: 15px 0 10px;">All right reserved: © 2023 Stumento</div>
              </div>
          </div>
      </section>
      
  </body>
</html>
