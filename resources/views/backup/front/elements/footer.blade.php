<div class="container">
    <div class="row justify-content-center align-items-start">
        <div class="col-lg-6">
            <div class="f_logo">
                <img src="<?=env('UPLOADS_URL').$generalSetting->site_logo?>" class="img-fluid" alt="<?=$generalSetting->site_name?>">
            </div>
            <p class="abt_footer"><?=$generalSetting->description?></p>
        </div>
        <?php
        $footer_link_name   = (($generalSetting->footer_link_name != '')?json_decode($generalSetting->footer_link_name):[]);
        $footer_link        = (($generalSetting->footer_link != '')?json_decode($generalSetting->footer_link):[]);
        ?>
        <div class="col-lg-3">
            <h3>Quick Link</h3>
            <ul>
                <?php if(!empty($footer_link_name)){ for($i=0;$i<count($footer_link_name);$i++){?>
                    <li><a href="<?=$footer_link[$i]?>"><?=$footer_link_name[$i]?></a></li>
                <?php } }?>
            </ul>
        </div>
        <?php
        $footer_link_name2  = (($generalSetting->footer_link_name2 != '')?json_decode($generalSetting->footer_link_name2):[]);
        $footer_link2       = (($generalSetting->footer_link2 != '')?json_decode($generalSetting->footer_link2):[]);
        ?>
        <div class="col-lg-3">
            <h3>Quick Link</h3>
            <ul>
                <?php if(!empty($footer_link_name2)){ for($i=0;$i<count($footer_link_name2);$i++){?>
                    <li><a href="<?=$footer_link2[$i]?>"><?=$footer_link_name2[$i]?></a></li>
                <?php } }?>
            </ul>
        </div>
    </div>
    <div class="row justify-content-center align-items-start">
        <div class="col-lg-12">
            <hr>
            <p class="abt_footer" style="width: 100%; text-align: center;color: #666; font-size: 13px;">All right reserved: <?=$title?>. Copyright @ <?=date('Y')?>-<?=(date('Y')+1)?></p>
        </div>
    </div>
</div>