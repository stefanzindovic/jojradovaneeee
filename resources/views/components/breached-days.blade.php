@props(['current_date' => \Carbon\Carbon::now(), 'deadline_date', 'default' => 'Nema prekoračenja'])

@php
$current_date = Carbon\Carbon::parse($current_date);
$deadline_date = Carbon\Carbon::parse($deadline_date);

$diff = $deadline_date->diffInDays($current_date, false);

// Final string
$dayFinalForm = null;

// Days versioning
$daysLastDigit = $diff % 10;
$daysVersionOne = [1];

// Day final string logic
if ($diff > 0) {
    if (in_array($daysLastDigit, $daysVersionOne) && $diff != 11) {
        $dayFinalForm = $diff . ' dan';
    } else {
        $dayFinalForm = $diff . ' dana';
    }
}

// Does not have holding (issued today)
if ($dayFinalForm === null) {
    $dayFinalForm = $default;
}

// Styles check
$deadlineBreachedDate = $deadline_date->addDay();
@endphp

<div
    @if ($current_date->gt($deadlineBreachedDate)) class="inline-block px-[6px] py-[2px] font-medium bg-red-200 rounded-[10px]" @endif>
    <small @if ($current_date->gt($deadlineBreachedDate)) class="text-red-800" @endif>{{ $dayFinalForm }}</small>
</div>
