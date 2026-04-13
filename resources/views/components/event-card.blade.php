@props([
    'event',
])

<li {{ $attributes->merge(['class' => 'event-card']) }}>
<x-card>
    <x-card.header>
        <x-card.title class="event-card-title">
            <a href="{{ route('event.show', $event) }}">{{ $event->name }}</a>
        </x-card.title>
        @if($event->event_date)
            <x-tag>{{ \Carbon\Carbon::parse($event->event_date)->format('M j, Y') }}</x-tag>
        @endif
    </x-card.header>

    <x-card.body class="event-card-body">
        @if($event->venue || $event->city)
            <p class="event-card-location">
                {{ implode(', ', array_filter([$event->venue, $event->city, $event->country])) }}
            </p>
        @endif
        @if($event->promotion)
            <p class="event-card-promotion">{{ $event->promotion->name }}</p>
        @endif
    </x-card.body>

    <x-card.footer>
        <x-button-link href="{{ route('event.show', $event) }}">
            View Event
        </x-button-link>
    </x-card.footer>

</x-card>
</li>
