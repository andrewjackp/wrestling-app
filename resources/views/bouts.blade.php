<x-layout>
  <inner-column>
    <div class="page-header">
      <h1 class="attention-voice">Matches</h1>
    </div>

    @if($matchTypes->isNotEmpty())
      <div class="filter-bar">
        <a
          class="filter-bar__item {{ !$selectedMatchType ? 'filter-bar__item--active' : '' }}"
          href="/bouts{{ promotionQuery() }}"
        >All</a>
        @foreach($matchTypes as $type)
          <a
            class="filter-bar__item {{ $selectedMatchType === $type ? 'filter-bar__item--active' : '' }}"
            href="/bouts?{{ http_build_query(array_merge(request()->except(['match_type', 'page']), ['match_type' => $type])) }}"
          >{{ $type }}</a>
        @endforeach
      </div>
    @endif

    <ul class="bout-list">
      @foreach($bouts as $bout)
        <x-bout-card :bout="$bout" />
      @endforeach
    </ul>

    <div class="pagination-wrap">
      {{ $bouts->links() }}
    </div>
  </inner-column>
</x-layout>
