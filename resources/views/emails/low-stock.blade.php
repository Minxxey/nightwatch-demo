@component('mail::message')
    # Low Stock Alert

    The following candybars are below their stock threshold:

    @foreach ($lowStockCandybars as $candybar)
        - {{ $candybar['name'] }}: {{ $candybar['amount'] }} in stock (Threshold: {{ $candybar['candybarTreshhold'] }})
    @endforeach

@endcomponent
