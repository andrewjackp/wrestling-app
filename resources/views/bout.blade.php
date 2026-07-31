<x-layout>
  <inner-column>
    <article class="bout-detail">

      <header class="bout-detail__header">
        <div class="bout-detail__meta">
          @if($bout->promotion)
            <x-tag>{{ $bout->promotion->name }}</x-tag>
          @endif
          @if($bout->match_type)
            <x-tag class="tag--success">{{ $bout->match_type }}</x-tag>
          @endif
        </div>

        <h1 class="attention-voice">{{ $bout->title }}</h1>

        @if($bout->event)
          <p class="soft-voice">
            <a href="{{ route('event.show', $bout->event) }}">{{ $bout->event->name }}</a>
            @if($bout->event->event_date)
              &middot; {{ \Carbon\Carbon::parse($bout->event->event_date)->format('F j, Y') }}
            @endif
          </p>
        @endif
      </header>

      <section class="bout-detail__wrestlers">
        <h2 class="loud-voice">Participants</h2>
        <ul class="bout-detail__wrestler-list">
          @foreach($bout->wrestlers as $wrestler)
            <li>
              <a href="{{ route('wrestler.show', $wrestler) }}">{{ $wrestler->name }}</a>
            </li>
          @endforeach
        </ul>
      </section>

      <section class="bout-detail__result">
        <h2 class="loud-voice">Result</h2>
        @if($bout->result)
          <dl class="bout-detail__result-details">
            <div class="bout-detail__result-row">
              <dt class="soft-voice">Winner</dt>
              <dd>
                @if($bout->result->winner)
                  <a href="{{ route('wrestler.show', $bout->result->winner) }}">{{ $bout->result->winner->name }}</a>
                @else
                  No winner recorded
                @endif
              </dd>
            </div>
            @if($bout->result->finish_type)
              <div class="bout-detail__result-row">
                <dt class="soft-voice">Finish</dt>
                <dd>{{ $bout->result->finish_type }}</dd>
              </div>
            @endif
            @if($bout->result->duration)
              <div class="bout-detail__result-row">
                <dt class="soft-voice">Duration</dt>
                <dd>{{ $bout->result->duration }}</dd>
              </div>
            @endif
            @if($bout->result->notes)
              <div class="bout-detail__result-row">
                <dt class="soft-voice">Notes</dt>
                <dd>{{ $bout->result->notes }}</dd>
              </div>
            @endif
          </dl>
        @else
          <p class="soft-voice">No result recorded yet.</p>
        @endif
      </section>

      <footer class="article-detail__footer">
        <a class="btn btn--secondary" href="/bouts">← All Matches</a>
        @if($bout->event)
          <a class="btn btn--secondary" href="{{ route('event.show', $bout->event) }}">View Event</a>
        @endif
      </footer>

    </article>
  </inner-column>
</x-layout>
