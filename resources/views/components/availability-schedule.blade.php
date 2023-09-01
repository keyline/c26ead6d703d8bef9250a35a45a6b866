<div>
    @foreach($daysOfWeek AS $day)
        <x-time-schedule-day 
        :day="$day"
        :slots="$slots"
        :action="$action"
        :icon="$icon"
        />
    @endforeach    
</div>