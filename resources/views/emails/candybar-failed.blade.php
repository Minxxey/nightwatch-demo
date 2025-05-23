@component('mail::message')
    {{$subject}}

    **Candybar:** {{ $candybarName }}

    **Fehlermeldung:**
    {{ $error }}

@endcomponent
