@component('mail::message')
    # Daily Stock Snapshot

    Here is today's full candybar stock list:

    @foreach ($candybars as $candybar)
        - {{ $candybar['name'] }}: {{ $candybar['amount'] }} in stock (Threshold: {{ $candybar['candybarTreshhold'] }})
    @endforeach

    Thanks,
    Your Candybar Monitor
@endcomponent
