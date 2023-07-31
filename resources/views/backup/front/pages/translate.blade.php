<h3><?=$page_header?></h3>
<div class="form-group">
  <ul class="translate-btn-list">
    <li><span>English</span></li>
    <li>
      <img src="<?=env('FRONT_ASSETS_URL')?>assets/img/translate.png">
    </li>
    <li>
      <select>
        <option>Select Language</option>
      </select>
    </li>
  </ul>
</div>
<div class="form-group">
  <div class="row">
    <div class="col-lg-6">
      <textarea class="form-control" placeholder="Enter yout text here.." rows="6">
        
      </textarea>
    </div>
    <div class="col-lg-6">
      <textarea class="form-control" placeholder="Your translate text" rows="6">

      </textarea>
    </div>
  </div>
</div>
<div class="form-group">
  <button type="submit" class="theme-btn">
    Translate
  </button>
</div>