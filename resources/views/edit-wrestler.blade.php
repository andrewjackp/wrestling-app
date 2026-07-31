<x-layout>
<inner-column>
    <div class="article-form-page">
        <h1 class="attention-voice">Edit Wrestler</h1>

        @if (session('fail'))
            <div class="article-form__errors">
                <ul><li>{{ session('fail') }}</li></ul>
            </div>
        @endif

        @if ($errors->any())
            <div class="article-form__errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="article-form" action="/wrestlers/{{ $wrestler->id }}" method="POST">
            @csrf
            @method('PUT')

            <div class="article-form__row">
                <div class="article-form__field">
                    <label class="article-form__label" for="name">Name</label>
                    <input class="article-form__input @error('name') article-form__input--error @enderror"
                        type="text" id="name" name="name" value="{{ old('name', $wrestler->name) }}">
                </div>

                <div class="article-form__field">
                    <label class="article-form__label" for="promotion_id">Promotion</label>
                    <select class="article-form__select" id="promotion_id" name="promotion_id">
                        <option value="">— None —</option>
                        @foreach($promotions as $promotion)
                            <option value="{{ $promotion->id }}" @selected(old('promotion_id', $wrestler->promotion_id) == $promotion->id)>
                                {{ $promotion->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="article-form__field">
                <label class="article-form__label" for="image">Image URL <span class="article-form__optional">(optional)</span></label>
                <input class="article-form__input @error('image') article-form__input--error @enderror"
                    type="url" id="image" name="image" value="{{ old('image', $wrestler->image) }}" placeholder="https://...">
            </div>

            <div class="article-form__row">
                <div class="article-form__field">
                    <label class="article-form__label" for="hometown">Hometown <span class="article-form__optional">(optional)</span></label>
                    <input class="article-form__input" type="text" id="hometown" name="hometown" value="{{ old('hometown', $wrestler->hometown) }}">
                </div>

                <div class="article-form__field">
                    <label class="article-form__label" for="height">Height <span class="article-form__optional">(optional)</span></label>
                    <input class="article-form__input" type="text" id="height" name="height" value="{{ old('height', $wrestler->height) }}">
                </div>

                <div class="article-form__field">
                    <label class="article-form__label" for="weight">Weight <span class="article-form__optional">(optional)</span></label>
                    <input class="article-form__input" type="text" id="weight" name="weight" value="{{ old('weight', $wrestler->weight) }}">
                </div>
            </div>

            <div class="article-form__field">
                <label class="article-form__label" for="bio">Bio <span class="article-form__optional">(optional)</span></label>
                <textarea class="article-form__textarea" id="bio" name="bio" rows="5">{{ old('bio', $wrestler->bio) }}</textarea>
            </div>

            <div class="article-form__actions">
                <x-submit-btn href="#" variant="secondary">Save Changes</x-submit-btn>
                <a class="btn btn--secondary" href="/wrestler/{{ $wrestler->id }}">Cancel</a>
            </div>
        </form>

        <form action="/wrestler/{{ $wrestler->id }}/delete" method="GET" class="article-form__delete" style="margin-top: 1em;">
            <button type="submit" class="btn btn--danger" onclick="return confirm('Delete this wrestler?')">Delete Wrestler</button>
        </form>
    </div>
</inner-column>
</x-layout>
