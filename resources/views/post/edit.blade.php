<x-layout>
<inner-column>
    <div class="article-form-page">
        <h1 class="attention-voice">Edit Article</h1>

        @if ($errors->any())
            <div class="article-form__errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="article-form" action="{{ route('articles.update', $article) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="article-form__field">
                <label class="article-form__label" for="article_title">Title</label>
                <input
                    class="article-form__input @error('article_title') article-form__input--error @enderror"
                    type="text"
                    id="article_title"
                    name="article_title"
                    value="{{ old('article_title', $article->article_title) }}"
                >
            </div>

            <div class="article-form__field">
                <label class="article-form__label" for="excerpt">Excerpt <span class="article-form__optional">(optional)</span></label>
                <textarea
                    class="article-form__textarea @error('excerpt') article-form__input--error @enderror"
                    id="excerpt"
                    name="excerpt"
                    rows="3"
                >{{ old('excerpt', $article->excerpt) }}</textarea>
            </div>

            <div class="article-form__field">
                <label class="article-form__label" for="content">Body</label>
                <textarea
                    class="article-form__textarea article-form__textarea--tall @error('content') article-form__input--error @enderror"
                    id="content"
                    name="content"
                    rows="16"
                >{{ old('content', $article->content) }}</textarea>
            </div>

            <div class="article-form__row">
                <div class="article-form__field">
                    <label class="article-form__label" for="promotion_id">Promotion <span class="article-form__optional">(optional)</span></label>
                    <select class="article-form__select" id="promotion_id" name="promotion_id">
                        <option value="">— None —</option>
                        @foreach($promotions as $promotion)
                            <option value="{{ $promotion->id }}" @selected(old('promotion_id', $article->promotion_id) == $promotion->id)>
                                {{ $promotion->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="article-form__field">
                    <label class="article-form__label" for="category">Category</label>
                    <select class="article-form__select" id="category" name="category">
                        <option value="">— None —</option>
                        @foreach(['News', 'Review', 'Opinion', 'Results', 'Feature'] as $cat)
                            <option value="{{ $cat }}" @selected(old('category', $article->category) === $cat)>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="article-form__field">
                    <label class="article-form__label" for="status">Status</label>
                    <select class="article-form__select" id="status" name="status">
                        <option value="published" @selected(old('status', $article->status) === 'published')>Published</option>
                        <option value="draft" @selected(old('status', $article->status) === 'draft')>Draft</option>
                    </select>
                </div>
            </div>

            <div class="article-form__field article-form__field--checkbox">
                <input type="hidden" name="featured" value="0">
                <input type="checkbox" id="featured" name="featured" value="1" @checked(old('featured', $article->featured))>
                <label class="article-form__label article-form__label--inline" for="featured">Feature this article on the homepage</label>
            </div>

            <div class="article-form__actions">
                <x-submit-btn href="#" variant="secondary">Save Changes</x-submit-btn>
                <a class="btn btn--secondary" href="{{ route('articles.show', $article) }}">Cancel</a>
            </div>
        </form>

        <form action="{{ route('articles.destroy', $article) }}" method="POST" class="article-form__delete">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn--danger" onclick="return confirm('Delete this article?')">Delete Article</button>
        </form>
    </div>
</inner-column>
</x-layout>
