@props([
  'result',
])

<li {{ $attributes->merge(['class' => 'result-list__item']) }}>
  <x-card class="result-card">

    <x-card.header>
      <x-card.title class="result-card__title">
        <a class="link" href="{{ route('bout.show', $result->bout) }}">{{ $result->bout->title }}</a>
      </x-card.title>

      @if($result->finish_type)
        <x-tag class="tag--success">{{ $result->finish_type }}</x-tag>
      @endif
    </x-card.header>

    <x-card.body class="result-card__body">
      <p class="result-card__winner">
        Winner: <strong>{{ $result->winner?->name ?? 'No winner recorded' }}</strong>
      </p>

      @if($result->duration)
        <p class="result-card__duration">Duration: {{ $result->duration }}</p>
      @endif

      @if($result->notes)
        <p class="result-card__notes">{{ $result->notes }}</p>
      @endif
    </x-card.body>

    <x-card.footer>
      <x-button-link href="{{ route('bout.show', $result->bout) }}">
        View Bout
      </x-button-link>
    </x-card.footer>

  </x-card>
</li>
