<x-layout>
  <inner-column>
    <article class="bout-detail">
      <h1 class="attention-voice">{{ $bout->title }}</h1>

      @if($bout->event)
        <p class="soft-voice">
          Event: {{ $bout->event->name }}
        </p>
      @endif

      @if($bout->promotion)
         <p class="soft-voice">
            {{ $bout->promotion->name }}
         </p>
      @endif

      <h2>Wrestlers</h2>
      <ul>
        @foreach($bout->wrestlers as $wrestler)
         <li>
            <a href="{{ route('wrestler.show', $wrestler) }}">
               {{ $wrestler->name }}
         </a>
         </li>
        @endforeach
      </ul>

      <h2>Result</h2>

      @if($bout->result)
        <p>
          Winner: {{ $bout->result->winner?->name ?? 'No winner recorded' }}
        </p>

        <p>
          Finish: {{ $bout->result->finish_type ?? 'N/A' }}
        </p>

        <p>
          Duration: {{ $bout->result->duration ?? 'N/A' }}
        </p>

        @if($bout->result->notes)
          <p>
            Notes: {{ $bout->result->notes }}
          </p>
        @endif
      @else
        <p>No result recorded yet.</p>
      @endif
    </article>
  </inner-column>
</x-layout>