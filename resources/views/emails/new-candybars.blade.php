@component('mail::message')
    # New Candybars are available

    New Candybars were just announced. Order them now!

    @foreach ($candybars as $candybar)
        - {{ $candybar['name'] }} by {{ $candybar['manufacturer'] }}
    @endforeach

@endcomponent
