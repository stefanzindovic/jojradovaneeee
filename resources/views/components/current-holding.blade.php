@props(['current_date' => \Carbon\Carbon::now(), 'deadline_date', 'indicator' => 'true'])

@php
$current_date = Carbon\Carbon::parse($current_date);
$deadline_date = Carbon\Carbon::parse($deadline_date);

$diff = $deadline_date->diff($current_date, false);

// Diff values
$days = $diff->d;
$months = $diff->m;
$years = $diff->y;

// Final strings
$dayFinalForm = null;
$monthFinalForm = null;
$yearFinalForm = null;

// Days versioning
$daysLastDigit = $days % 10;
$daysVersionOne = [1];

// Months versioning
$monthsLastDigit = $months % 10;
$monthsVersionOne = [1];
$monthsVersionTwo = [2, 3, 4];

// Years versioning
$yearsLastDigit = $years % 10;
$yearsVersionOne = [2, 3, 4];

// Day final string logic
if ($days > 0) {
    if (in_array($daysLastDigit, $daysVersionOne) && $days != 11) {
        $dayFinalForm = $days . ' dan';
    } else {
        $dayFinalForm = $days . ' dana';
    }
}

// Months final string logic
if ($months > 0) {
    if (in_array($monthsLastDigit, $monthsVersionOne) && $months != 11) {
        $monthFinalForm = $months . ' mjesec';
    } elseif (in_array($monthsLastDigit, $monthsVersionTwo)) {
        $monthFinalForm = $months . ' mjeseca';
    } else {
        $monthFinalForm = $months . ' mjeseci';
    }
}

// Years final string logic
if ($years > 0) {
    if (in_array($yearsLastDigit, $yearsVersionOne)) {
        $yearFinalForm = $years . ' godine';
    } else {
        $yearFinalForm = $years . ' godina';
    }
}

// Does not have holding (issued today)
if ($dayFinalForm === null && $monthFinalForm === null && $yearFinalForm === null) {
    $yearFinalForm = 'Nema zadržavanja';
}
@endphp

<div
    @if ($indicator === 'true' && $current_date->gt($deadline_date)) class="inline-block px-[6px] py-[2px] font-medium bg-red-200 rounded-[10px]" @endif>
    <span @if ($indicator === 'true' && $current_date->gt($deadline_date)) class="text-red-800" @endif>{{ $yearFinalForm }}
        {{ $monthFinalForm }} {{ $dayFinalForm }}</span>
</div>
