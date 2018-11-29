@component('mail::message')
Hi there,

{{ $sender->name }} has shared this listing _{{ $listing->title }}_ with you.

@if($body)
They sent this message along:

{{ $body }}
@endif

@component('mail::button', ['url' => route('listings.show', [$listing->area, $listing])])
View listing
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
