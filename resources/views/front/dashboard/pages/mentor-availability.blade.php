<?php
use App\Models\MentorAvailability;
use App\Helpers\Helper;
?>
<div class="account_wrapper">
   <?=$sidebar;?>
   <div class="wrapper account_inner_section d-flex flex-column min-vh-100 bg-light">
      <header class="header header-sticky mb-4">
         <div class="container-fluid">
            <button class="header-toggler px-md-0 me-md-3 d-md-none" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <i class="fa-solid fa-bars"></i>
            </button>
            <h4 class="pagestitle-item mb-0">Availability</h4>
            <ul class="header-nav ms-auto"></ul>
         </div>
      </header>
      <div class="body flex-grow-1 px-3">
         <div class="container-lg">
            <div class="row">
               <div class="col-sm-12 col-lg-12">
                  @if ($errors->any())         
                  <div class="invalid-feedback d-block" role="alert">
                     <ul>
                        @foreach (json_decode($errors) as $file_index => $error)
                        <li>
                           <strong>
                              {{$file_index.': '}} 
                              <ul>
                                 @foreach ($error as $error_item)
                                 <li>{{$error_item}}</li>
                                 @endforeach
                              </ul>
                           </strong>
                        </li>
                        @endforeach
                     </ul>
                  </div>
                  @endif
                  <form action="" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                    @csrf
                    <div class="ant-col ant-col-24 add-slots mentoe_admin_section">
								<div class="row slot-item hide_tabmobile">
									<div class="col-md-3"></div>
									<div class="col-md-9">
										<div class="row">
											<div class="col-md-3 text-left"><span class="fw-bold" style="color: #f9233f;">Start</span></div>
											<div class="col-md-3 text-left"><span class="fw-bold" style="color: #f9233f;">Duration</span></div>
											<div class="col-md-3 text-left"><span class="fw-bold" style="color: #f9233f;">No. Of Slots</span></div>
											<div class="col-md-3 text-left"><span class="fw-bold" style="color: #f9233f;">End</span></div>
											<div class="col-md-3 text-left"><span class="fw-bold" style="color: #f9233f;"></span></div>
										</div>
									</div>
								</div>
                     	@foreach($days AS $day)
	                     	<div class="row slot-item">
	                        <div class="col-md-3">
	                           <div class="slot_weeksday">
	                            <div class="form-check">
	                             	<input class="form-check-input chk__slots__show__hide" type="checkbox" name="day_of_week[{{ $day->id }}]" value="{{ $day->day }}" data-chkcontainer="{{ strtolower($day->day_text) }}" id="flexCheckChecked_{{ $loop->index }}"
	                                {{ (in_array($day->id, $mentor_days)) ? 'checked' : '' }}>
	                               <label class="form-check-label" for="flexCheckChecked_{{ $loop->index }}">
	                                {{ $day->day_text }}
	                               </label>
	                            </div>
	                           </div>
	                      	</div>
	                        <div class="col-md-9 slots__parent">
	                         	@if(in_array($day->id, $mentor_days))
	                           	<div class="slots-section">
	                           		<?php
	                           		$mentorAvlDaywises      = MentorAvailability::select('day_of_week_id', 'duration', 'no_of_slot', 'avail_from', 'avail_to')->where('mentor_user_id', '=', $userId)->where('is_active', '=', 1)->where('day_of_week_id', '=', $day->id)->get();
	                           		if($mentorAvlDaywises){ foreach($mentorAvlDaywises as $mentorAvlDaywise){
	                           		?>
		                              <div class="slots-select-box">
		                                 <div class="slot_starttime">
		                                 	<?php
		                                 	$avail_from = date_format(date_create($mentorAvlDaywise->avail_from), "Hi");
		                                 	$avail_to = date_format(date_create($mentorAvlDaywise->avail_to), "h:i A");
		                                 	?>
		                                    <select class="select2-frm" name="availability[from][{{ $day->id }}][]">
		                                       @foreach($slot_dropdown AS $option)
		                                       <option value="<?=$option['value']?>" <?=(($option['value'] == $avail_from)?'selected':'')?>><?=$option['name']?></option>
		                                       @endforeach
		                                    </select>
		                                 </div>
		                                 <div style="display: inline; margin: 0px 0.2em;">-</div>
		                                 <div class="slot__duration">
		                                  <select class="select__slot__duration" name="duration[{{ $day->id }}][]" style="width: 50%">
		                                  	<option value="30" <?=(($mentorAvlDaywise->duration == 30)?'selected':'')?>>30 minutes</option>
		                                  	<option value="60" <?=(($mentorAvlDaywise->duration == 60)?'selected':'')?>>60 minutes</option>
		                                  </select>
		                                 </div>
		                                 <div style="display: inline; margin: 0px 0.2em;">-</div>

		                                 <div class="no__of__slots">
		                                  <select class="select__no__ofslot" name="no_of_slot[{{ $day->id }}][]" style="width: 50%">
		                                  	<option value="1" <?=(($mentorAvlDaywise->no_of_slot == 1)?'selected':'')?>>x 1 slot</option>
		                                  	<option value="2" <?=(($mentorAvlDaywise->no_of_slot == 2)?'selected':'')?>>x 2 slots</option>
		                                  	<option value="3" <?=(($mentorAvlDaywise->no_of_slot == 3)?'selected':'')?>>x 3 slots</option>
		                                  	<option value="4" <?=(($mentorAvlDaywise->no_of_slot == 4)?'selected':'')?>>x 4 slots</option>
		                                  	<option value="5" <?=(($mentorAvlDaywise->no_of_slot == 5)?'selected':'')?>>x 5 slots</option>
		                                  	<option value="6" <?=(($mentorAvlDaywise->no_of_slot == 6)?'selected':'')?>>x 6 slots</option>
		                                  	<option value="7" <?=(($mentorAvlDaywise->no_of_slot == 7)?'selected':'')?>>x 7 slots</option>
		                                  	<option value="8" <?=(($mentorAvlDaywise->no_of_slot == 8)?'selected':'')?>>x 8 slots</option>
		                                  	<option value="9" <?=(($mentorAvlDaywise->no_of_slot == 9)?'selected':'')?>>x 9 slots</option>
		                                  	<option value="10" <?=(($mentorAvlDaywise->no_of_slot == 10)?'selected':'')?>>x 10 slots</option>
		                                  	<option value="11" <?=(($mentorAvlDaywise->no_of_slot == 11)?'selected':'')?>>x 11 slots</option>
		                                  </select>
		                                 </div>
		                                 <div style="display: inline; margin: 0px 0.2em;">-</div>
		                                 <div class="slot_endtime">
		                                  <input type="text" class="slot__endtime__txt" name="availability[to][{{ $day->id }}][]" value="<?=$avail_to?>" readonly="readonly">
		                                  </div>
		                                 <button class="add-slot-btn add__slot__parent" data-container="{{ strtolower($day->day_text) }}"><span style="pointer-events: none;"><i class="fa-solid fa-plus"></i></span></button>
		                              </div>
		                            <?php } }?>
	                           	</div>
	                          @else
	                          	<div class="ant-typography slots-unavailable">Unavailable</div>
	                          @endif
	                          <div class="slot__items__component" id="item-list-container-{{ strtolower($day->day_text) }}">
	                          </div>
	                        </div>
	                     	</div>
                     	@endforeach
                    </div>                  
                    <div class="input-group ml-0 mb-3 mt-4">
                     	<button class="btn btn-primary"><i class="fa fa-paper-plane"></i> Save</button>
                    </div>
                 </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>