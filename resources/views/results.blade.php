<x-layout>
  <inner-column>
    <h1>Results</h1>
    <ul class="result-list">
      @foreach($results as $result)
        <x-result-card :result="$result" />
      @endforeach
    </ul>
  </inner-column>
</x-layout>
