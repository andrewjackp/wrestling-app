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
          </dl>
        </div>
      </div>

      @if($wrestler->bio)
        <section class="wrestler-detail__bio">
          <h2 class="loud-voice">Biography</h2>
          <p>{{ $wrestler->bio }}</p>
        </section>
      @endif

      <footer class="article-detail__footer">
        <a class="btn btn--secondary" href="/wrestlers">← All Wrestlers</a>
        <a class="btn btn--secondary" href="/wrestler/{{ $wrestler->id }}/edit">Edit</a>
      </footer>

    </article>
  </inner-column>
</x-layout>
