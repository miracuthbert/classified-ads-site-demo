@component('mail::message')
Hi {{ $listing->user->first_name }},

{{ $sender->first_name }} {{ $sender->last_name }} has contacted you about your listing,

@component('mail::button', ['url' => route('listings.show', [$listing->area, $listing])])
{{ $listing->title }}
@endcomponent

Reply directly to this email to get back to them.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
