<x-layout>
<inner-column>
    <div class="article-form-page">
        <h1 class="attention-voice">Create Account</h1>

        @if ($errors->any())
            <div class="article-form__errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="article-form" action="/register" method="POST">
            @csrf

            <div class="article-form__field">
                <label class="article-form__label" for="name">Name</label>
                <input
                    class="article-form__input @error('name') article-form__input--error @enderror"
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    autocomplete="name"
                >
            </div>

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

            <div class="article-form__row">
                <div class="article-form__field">
                    <label class="article-form__label" for="password">Password</label>
                    <input
                        class="article-form__input @error('password') article-form__input--error @enderror"
                        type="password"
                        id="password"
                        name="password"
                        autocomplete="new-password"
                    >
                </div>

                <div class="article-form__field">
                    <label class="article-form__label" for="password_confirmation">Confirm Password</label>
                    <input
                        class="article-form__input"
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        autocomplete="new-password"
                    >
                </div>
            </div>

            <div class="article-form__actions">
                <x-submit-btn href="#" variant="secondary">Create Account</x-submit-btn>
                <a class="btn btn--secondary" href="{{ route('login') }}">Already have an account?</a>
            </div>
        </form>
    </div>
</inner-column>
</x-layout>
