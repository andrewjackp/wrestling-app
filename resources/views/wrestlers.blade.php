<x-layout>
    <inner-column>
        <h1>{{formatCode($wrestlers)}}</h1>

            @if (Session::has('success'))
                <span>{{Session::get('success')}}</span>
            @endif

    <h1 class='attention-voice'><a href="add/wrestler">Add Wrestlers</a></h1>
        <ul class="wrestler-list">
            @foreach($wrestlers as $wrestler)
                <x-wrestler-card :wrestler="$wrestler" />
            @endforeach
        </ul>
    </inner-column>
    
</x-layout>