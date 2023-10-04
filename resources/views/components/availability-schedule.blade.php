
    @foreach($daysOfWeek AS $day)
        <x-time-schedule-day-v2 
        :day="$day"
        :slots="$slots"
        :action="$action"
        :icon="$icon"
        />
    @endforeach    
