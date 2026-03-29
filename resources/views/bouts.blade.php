<x-layout>
  <inner-column>
    <h1>Bouts</h1>
    <ul class="bout-list">
      @foreach($bouts as $bout)
        <x-bout-card :bout="$bout" />
      @endforeach
    </ul>
  </inner-column>
</x-layout>
