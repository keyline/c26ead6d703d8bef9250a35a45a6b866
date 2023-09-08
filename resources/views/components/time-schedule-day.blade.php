@props(['day', 'slots', 'action', 'icon'
]
)
<div>
    <div class="slots_section_parent slots-select-box">
                                       <div class="slots_section_item slot_starttime">
                                          <select id="selectbox" name="availability[from][{{ $day->id }}][]">
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
                                       <div class="slot_endtime">
                                          <select id="selectbox2" name="availability[to][{{ $day->id }}][]">
                                             @foreach($slots AS $option)
                                             <option value="{{ $option['value'] }}"
                                             {{ ($option['selected_to'] == $option['value']) ? 'selected' : '' }}>
                                             {{ $option['name'] }}</option>
                                             @endforeach
                                          </select>
                                       </div>
                                       <button type="button" class="add-slot-btn {{ $action }}" data-container="{{ strtolower($day->day_text) }}"><span style="pointer-events: none;"><i class="fa-solid fa-{{ $icon }}"></i></span></button>
                                    </div>
</div>