@php
    use App\Helpers;
@endphp

@component('mail::message')
Here are your daily random entries:

<!DOCTYPE html>
<html>

<head>
</head>

<body>
<ul>
@foreach ($entries as $entry)
<li>
<div style="display: flex;flex-direction: column;justify-content: center;">
<p style="font-style: italic">
{{ $entry->created_at }}
{{-- {{ convertTime($entry->created_at) }} --}}
</p>

<p style="margin-top: 12px">
{{ $entry->entry }}
</p>
</div>
</li>
@endforeach
</ul>
</body>

</html>

@component('mail::button', ['url' => 'https://randomjournal.brianmulaa.com/journal/random'])
    View on website
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
