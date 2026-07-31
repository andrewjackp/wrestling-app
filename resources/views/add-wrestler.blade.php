<x-layout>
<inner-column>
    <div class="article-form-page">
        <h1 class="attention-voice">Add Wrestler</h1>

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

        <form class="article-form" action="{{ route('addWrestler') }}" method="POST">
            @csrf

            <div class="article-form__row">
                <div class="article-form__field">
                    <label class="article-form__label" for="name">Name</label>
                    <input class="article-form__input @error('name') article-form__input--error @enderror"
                        type="text" id="name" name="name" value="{{ old('name') }}">
                </div>

                <div class="article-form__field">
                    <label class="article-form__label" for="promotion_id">Promotion</label>
                    <select class="article-form__select" id="promotion_id" name="promotion_id">
                        <option value="">— None —</option>
                        @foreach($promotions as $promotion)
                            <option value="{{ $promotion->id }}" @selected(old('promotion_id') == $promotion->id)>
                                {{ $promotion->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="article-form__field">
                <label class="article-form__label" for="image">Image URL <span class="article-form__optional">(optional)</span></label>
                <input class="article-form__input @error('image') article-form__input--error @enderror"
                    type="url" id="image" name="image" value="{{ old('image') }}" placeholder="https://...">
            </div>

            <div class="article-form__row">
                <div class="article-form__field">
                    <label class="article-form__label" for="hometown">Hometown <span class="article-form__optional">(optional)</span></label>
                    <input class="article-form__input" type="text" id="hometown" name="hometown" value="{{ old('hometown') }}" placeholder='e.g. Tampa, FL'>
                </div>

                <div class="article-form__field">
                    <label class="article-form__label" for="height">Height <span class="article-form__optional">(optional)</span></label>
                    <input class="article-form__input" type="text" id="height" name="height" value="{{ old('height') }}" placeholder='e.g. 6&apos;2"'>
                </div>

                <div class="article-form__field">
                    <label class="article-form__label" for="weight">Weight <span class="article-form__optional">(optional)</span></label>
                    <input class="article-form__input" type="text" id="weight" name="weight" value="{{ old('weight') }}" placeholder="e.g. 245 lbs">
                </div>
            </div>

            <div class="article-form__field">
                <label class="article-form__label" for="bio">Bio <span class="article-form__optional">(optional)</span></label>
                <textarea class="article-form__textarea" id="bio" name="bio" rows="5"
                    placeholder="Career overview, background, notable achievements...">{{ old('bio') }}</textarea>
            </div>

            <div class="article-form__actions">
                <x-submit-btn href="#" variant="secondary">Save Wrestler</x-submit-btn>
                <a class="btn btn--secondary" href="/wrestlers">Cancel</a>
            </div>
        </form>
    </div>
</inner-column>
</x-layout>
