@props([
  'bout',
])

<li {{ $attributes->merge(['class' => 'bout-list__item']) }}>
  <x-card class="bout-card">

    <x-card.header>
      <x-card.title class="bout-card__title">
        <a class="link" href="{{ route('bout.show', $bout) }}">{{ $bout->title }}</a>
      </x-card.title>

      @if($bout->promotion)
        <x-tag>{{ $bout->promotion->name }}</x-tag>
      @endif
    </x-card.header>

    <x-card.body class="bout-card__body">
      @if($bout->event)
        <p class="bout-card__event">{{ $bout->event->name }}</p>
      @endif

      <ul class="bout-card__wrestlers">
        @foreach($bout->wrestlers as $wrestler)
          <li class="bout-card__wrestler">
            <a class="link" href="{{ route('wrestler.show', $wrestler) }}">{{ $wrestler->name }}</a>
          </li>
        @endforeach
      </ul>
    </x-card.body>

    <x-card.footer>
      <x-button-link href="{{ route('bout.show', $bout) }}">
        View Bout
      </x-button-link>
    </x-card.footer>

  </x-card>
</li>
