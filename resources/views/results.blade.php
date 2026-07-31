<x-layout>
  <inner-column>
    <div class="page-header">
      <h1 class="attention-voice">Results</h1>
    </div>

    <ul class="result-list">
      @foreach($results as $result)
        <x-result-card :result="$result" />
      @endforeach
    </ul>

    <div class="pagination-wrap">
      {{ $results->links() }}
    </div>
  </inner-column>
</x-layout>
