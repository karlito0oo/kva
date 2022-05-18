@component('mail::message')
# Hello!

Please click the button below to fully verify your email address.

@component('mail::button', ['url' => url("/api/students/fully-verify/".$student->id)])
Verify Now
@endcomponent

If you did not request for this, no further action is required.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
