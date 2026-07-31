<x-layout>
  <inner-column>
    <article class="wrestler-detail">

      <div class="wrestler-detail__hero">
        <picture class="wrestler-detail__media">
          <img
            src="{{ $wrestler->image ?? 'https://peprojects.dev/images/landscape.jpg' }}"
            alt="{{ $wrestler->name }}"
          >
        </picture>

        <div class="wrestler-detail__hero-info">
          <h1 class="attention-voice wrestler-detail__name">{{ $wrestler->name }}</h1>

          @if($wrestler->promotion)
            <p class="soft-voice">
              <a href="{{ route('promotion.show', $wrestler->promotion) }}">{{ $wrestler->promotion->name }}</a>
            </p>
          @endif

          <dl class="wrestler-detail__stats">
            @if($wrestler->hometown)
              <div class="wrestler-detail__stat">
                <dt class="soft-voice">Hometown</dt>
                <dd>{{ $wrestler->hometown }}</dd>
              </div>
            @endif
            @if($wrestler->height)
              <div class="wrestler-detail__stat">
                <dt class="soft-voice">Height</dt>
                <dd>{{ $wrestler->height }}</dd>
              </div>
            @endif
            @if($wrestler->weight)
              <div class="wrestler-detail__stat">
                <dt class="soft-voice">Weight</dt>
                <dd>{{ $wrestler->weight }}</dd>
              </div>
            @endif

            @if($record['total'] > 0)
              <div class="wrestler-detail__stat">
                <dt class="soft-voice">Record</dt>
                <dd class="wrestler-detail__record">
                  <span class="wrestler-detail__record-w">{{ $record['wins'] }}W</span>
                  <span class="wrestler-detail__record-sep"> – </span>
                  <span class="wrestler-detail__record-l">{{ $record['losses'] }}L</span>
                  @if($record['no_contests'] > 0)
                    <span class="wrestler-detail__record-sep"> – </span>
                    <span class="wrestler-detail__record-nc">{{ $record['no_contests'] }}NC</span>
                  @endif
                </dd>
              </div>
            @endif
          </dl>

          @if($wrestler->championships->isNotEmpty())
            <div class="wrestler-detail__titles">
              @foreach($wrestler->championships as $championship)
                <x-tag class="tag--success">{{ $championship->name }}</x-tag>
              @endforeach
            </div>
          @endif
        </div>
      </div>

      @if($wrestler->bio)
        <section class="wrestler-detail__bio">
          <h2 class="loud-voice">Biography</h2>
          <p>{{ $wrestler->bio }}</p>
        </section>
      @endif

      @if($bouts->isNotEmpty())
        <section class="wrestler-detail__history">
          <h2 class="loud-voice">Match History</h2>

          <table class="match-history">
            <thead class="match-history__head">
              <tr>
                <th class="soft-voice">Event</th>
                <th class="soft-voice">Match</th>
                <th class="soft-voice">Opponents</th>
                <th class="soft-voice">Result</th>
                <th class="soft-voice">Finish</th>
              </tr>
            </thead>
            <tbody>
              @foreach($bouts as $bout)
                @php
                  $result = $bout->result;
                  $opponents = $bout->wrestlers->where('id', '!=', $wrestler->id);

                  if (!$result) {
                    $outcome = 'pending';
                  } elseif ($result->winner_id === $wrestler->id) {
                    $outcome = 'win';
                  } elseif ($result->winner_id !== null) {
                    $outcome = 'loss';
                  } else {
                    $outcome = 'nc';
                  }
                @endphp
                <tr class="match-history__row match-history__row--{{ $outcome }}">
                  <td class="match-history__event">
                    @if($bout->event)
                      <a class="link" href="{{ route('event.show', $bout->event) }}">{{ $bout->event->name }}</a>
                      @if($bout->event->event_date)
                        <span class="soft-voice match-history__date">
                          {{ \Carbon\Carbon::parse($bout->event->event_date)->format('M j, Y') }}
                        </span>
                      @endif
                    @else
                      <span class="soft-voice">—</span>
                    @endif
                  </td>
                  <td class="match-history__title">
                    <a class="link" href="{{ route('bout.show', $bout) }}">{{ $bout->title }}</a>
                    @if($bout->match_type)
                      <span class="soft-voice match-history__type">{{ $bout->match_type }}</span>
                    @endif
                  </td>
                  <td class="match-history__opponents">
                    @foreach($opponents as $opponent)
                      <a class="link" href="{{ route('wrestler.show', $opponent) }}">{{ $opponent->name }}</a>@if(!$loop->last), @endif
                    @endforeach
                  </td>
                  <td class="match-history__outcome">
                    @if($outcome === 'win')
                      <span class="match-history__badge match-history__badge--win">W</span>
                    @elseif($outcome === 'loss')
                      <span class="match-history__badge match-history__badge--loss">L</span>
                    @elseif($outcome === 'nc')
                      <span class="match-history__badge match-history__badge--nc">NC</span>
                    @else
                      <span class="soft-voice">—</span>
                    @endif
                  </td>
                  <td class="match-history__finish soft-voice">
                    {{ $result?->finish_type ?? '—' }}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </section>
      @endif

      <footer class="article-detail__footer">
        <a class="btn btn--secondary" href="/wrestlers">← All Wrestlers</a>
        <a class="btn btn--secondary" href="/wrestler/{{ $wrestler->id }}/edit">Edit</a>
      </footer>

    </article>
  </inner-column>
</x-layout>
