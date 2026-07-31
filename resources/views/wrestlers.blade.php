<x-layout>
    <inner-column>
        <div class="page-header">
            <h1 class="attention-voice">Wrestlers</h1>
            <a class="btn btn--secondary" href="/add/wrestler">Add Wrestler</a>
        </div>

        @if(session('success'))
            <p class="article-form__success">{{ session('success') }}</p>
        @endif

        <ul class="wrestler-list">
            @foreach($wrestlers as $wrestler)
                <x-wrestler-card :wrestler="$wrestler" />
            @endforeach
        </ul>

        <div class="pagination-wrap">
            {{ $wrestlers->links() }}
        </div>
    </inner-column>
</x-layout>
