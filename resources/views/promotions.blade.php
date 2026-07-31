<x-layout>
    <inner-column>
        <div class="page-header">
            <h1 class="attention-voice">Promotions</h1>
        </div>

        <ul class="promotion-list">
            @foreach($promotions as $promotion)
                <x-promotion-card :promotion="$promotion" />
            @endforeach
        </ul>
    </inner-column>
</x-layout>
