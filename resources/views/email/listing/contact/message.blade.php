@component('mail::message')
Hi {{ $listing->user->first_name }},

{{ $sender->name }} has contacted you about your listing _{{ $listing->title }}_.

@if($body)
They have left you this message:

{{ $body }}
@endif

Reply directly to this email to get back to them.

@component('mail::button', ['url' => route('listings.show', [$listing->area, $listing])])
View listing
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
