@component('mail::message')
# User Query
Please check the user query Below.<br>

from<br>
{{$email}}

subject:<br>
{{$subject}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
