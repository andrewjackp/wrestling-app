<x-layout>
  <inner-column>
    <article class="event-detail">
      <h1 class="attention-voice">{{ $event->name }}</h1>

      <div class="event-detail-meta">
        @if($event->promotion)
          <p class="soft-voice">
            <a href="{{ route('promotion.show', $event->promotion) }}">{{ $event->promotion->name }}</a>
          </p>
        @endif

        @if($event->event_date)
          <p class="soft-voice">{{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y') }}</p>
        @endif

        @if($event->venue || $event->city)
          <p class="soft-voice">
            {{ implode(', ', array_filter([$event->venue, $event->city, $event->country])) }}
          </p>
        @endif

        @if($event->description)
          <p>{{ $event->description }}</p>
        @endif
      </div>

      <h2 class="loud-voice">Bouts</h2>

      @forelse($event->bouts as $bout)
        <div class="event-detail-bout">
          <h3>
            <a href="{{ route('bout.show', $bout) }}">{{ $bout->title }}</a>
          </h3>

          @if($bout->wrestlers->isNotEmpty())
            <ul class="event-detail-bout-wrestlers">
              @foreach($bout->wrestlers as $wrestler)
                <li>
                  <a href="{{ route('wrestler.show', $wrestler) }}">{{ $wrestler->name }}</a>
                </li>
              @endforeach
            </ul>
          @endif

          @if($bout->result)
            <p>
              Winner: <strong>{{ $bout->result->winner?->name ?? 'No winner recorded' }}</strong>
              @if($bout->result->finish_type)
                &middot; {{ $bout->result->finish_type }}
              @endif
              @if($bout->result->duration)
                &middot; {{ $bout->result->duration }}
              @endif
            </p>
          @else
            <p class="soft-voice">No result recorded.</p>
          @endif
        </div>
      @empty
        <p>No bouts recorded for this event.</p>
      @endforelse
    </article>
  </inner-column>
</x-layout>
