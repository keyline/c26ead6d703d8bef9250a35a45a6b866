@props(['day', 'slots', 'action', 'icon'])


<div class="slots_section_item slot_starttime">
    <select class="select2-frm" name="availability[from][{{ $day->id }}][]">
        @foreach ($slots as $option)
            <option value="{{ $option['value'] }}" {{ $option['selected_from'] == $option['value'] ? 'selected' : '' }}>
                {{ $option['name'] }}</option>
        @endforeach

    </select>
</div>
<div style="display: inline; margin: 0px 0.2em;">-</div>
<div class="slot__duration">
    <select class="select__slot__duration" name="duration[{{ $day->id }}][]" style="width: 50%">
    </select>
</div>
<div style="display: inline; margin: 0px 0.2em;">-</div>

<div class="no__of__slots">
    {{-- onchange="handleOptionChange(this)" --}}
    <select class="select__no__ofslot"  name="no_of_slot[{{ $day->id }}][]"
        style="width: 50%">
    </select>
</div>
<div style="display: inline; margin: 0px 0.2em;">-</div>
<div class="slot_endtime">
    <input type="text" class="slot__endtime__txt" name="availability[to][{{ $day->id }}][]"
        value="{{ date('g:i A', strtotime($option['selected_to'])) }}" readonly="readonly">
</div>
<button type="button" class="add-slot-btn {{ $action }}" data-container="{{ strtolower($day->day_text) }}"><span
        style="pointer-events: none;"><i class="fa-solid fa-{{ $icon }}"></i></span></button>
</div>
