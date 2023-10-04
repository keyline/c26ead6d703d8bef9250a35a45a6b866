@props(['day', 'slots', 'action', 'icon'
]
)

    <div class="slots_section_parent slots-select-box">
                                       <div class="slots_section_item slot_starttime">
                                          <select class="select2-frm" name="availability[from][{{ $day->id }}][]">
                                             @foreach($slots AS $option)
                                             <option value="{{ $option['value'] }}" 
                                             {{ ($option['selected_from'] == $option['value']) ? 'selected' : '' }}>
                                              {{ $option['name'] }}</option>
                                             @endforeach
                                             <!-- <option value="1">12.00 AM</option>
                                             <option value="2">12.15 AM</option>
                                             <option value="3">12.30 AM</option>
                                             <option value="4">12.45 AM</option>
                                             <option value="5">1.00 AM</option>
                                             <option value="6">1.15 AM</option>
                                             <option value="7">1.30 AM</option>
                                             <option value="8">1.45 AM</option>
                                             <option value="9">2.00 AM</option> -->
                                          </select>
                                       </div>
                                       <div style="display: inline; margin: 0px 1em;">-</div>
                                       <div class="slot__duration">
                                        <select class="select__slot__duration" name="duration[{{ $day->id }}]" style="width: 50%">
                                        </select>
                                       </div>
                                       <div style="display: inline; margin: 0px 1em;">-</div>

                                       <div class="no__of__slots">
                                        <select class="select__no__ofslot" name="no_of_slot[{{ $day->id }}]" style="width: 50%">
                                        </select>
                                       </div>
                                       <div style="display: inline; margin: 0px 1em;">-</div>
                                       <div class="slot_endtime">
                                          <input type="text" class="slot__endtime__txt" name="availability[to][{{ $day->id }}][]" value="{{ date('g:i A', strtotime($option['selected_to'])) }}" readonly="readonly">
                                       </div>
                                       <button type="button" class="add-slot-btn {{ $action }}" data-container="{{ strtolower($day->day_text) }}"><span style="pointer-events: none;"><i class="fa-solid fa-{{ $icon }}"></i></span></button>
                                    </div>
</div>
