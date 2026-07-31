<x-layout>
  <inner-column>
    <div class="page-header">
      <h1 class="attention-voice">Matches</h1>
    </div>

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
