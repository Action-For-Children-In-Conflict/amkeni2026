<x-mail::message>
# New {{ $contact->type->label() }} enquiry

**Name:** {{ $contact->name }}
**Email:** {{ $contact->email }}
@if ($contact->phone)
**Phone:** {{ $contact->phone }}
@endif
@if ($contact->organization)
**Organization:** {{ $contact->organization }}
@endif
@if ($contact->subject)
**Subject:** {{ $contact->subject }}
@endif
**Received:** {{ $contact->created_at?->format('d M Y, H:i') }} EAT

## Message

{{ $contact->message }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
