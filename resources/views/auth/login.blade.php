<x-layout>
<inner-column>
    <div class="article-form-page">
        <h1 class="attention-voice">Sign In</h1>

        @if ($errors->any())
            <div class="article-form__errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="article-form" action="/login" method="POST">
            @csrf

            <div class="article-form__field">
                <label class="article-form__label" for="email">Email</label>
                <input
                    class="article-form__input @error('email') article-form__input--error @enderror"
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    autocomplete="email"
                >
            </div>

            <div class="article-form__field">
                <label class="article-form__label" for="password">Password</label>
                <input
                    class="article-form__input @error('password') article-form__input--error @enderror"
                    type="password"
                    id="password"
                    name="password"
                    autocomplete="current-password"
                >
            </div>

            <div class="article-form__actions">
                <x-submit-btn href="#" variant="secondary">Sign In</x-submit-btn>
                <a class="btn btn--secondary" href="{{ route('register') }}">Create Account</a>
            </div>
        </form>
    </div>
</inner-column>
</x-layout>
