<x-layout>
    <inner-column>

        <div class="promotion-detail__hero">
            @if($promotion->logo)
                <img class="promotion-detail__logo" src="{{ $promotion->logo }}" alt="{{ $promotion->name }}">
            @endif
            <h1 class="attention-voice">{{ $promotion->name }}</h1>
        </div>

        @if($promotion->championships->isNotEmpty())
            <section class="promotion-championships">
                <h2 class="loud-voice">Championships</h2>
                <ul class="championship-list">
                    @foreach($promotion->championships as $championship)
                        <li class="championship-list__item">
                            <span class="championship-list__name">{{ $championship->name }}</span>
                            @if($championship->holder)
                                <span class="soft-voice">
                                    Held by <a href="{{ route('wrestler.show', $championship->holder) }}">{{ $championship->holder->name }}</a>
                                    @if($championship->won_date)
                                        since {{ $championship->won_date->format('M j, Y') }}
                                    @endif
                                </span>
                            @else
                                <span class="soft-voice">Vacant</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </section>
        @endif

        <section class="promotion-events">
            <div class="promotion-section-header">
                <h2 class="loud-voice">Recent Events</h2>
                <a class="btn btn--secondary" href="/bouts{{ promotionQuery() }}">All Matches</a>
            </div>
            <ul class="event-list">
                @forelse($recentEvents as $event)
                    <x-event-card :event="$event" />
                @empty
                    <p class="soft-voice">No events yet.</p>
                @endforelse
            </ul>
        </section>

        <section class="promotion-results">
            <div class="promotion-section-header">
                <h2 class="loud-voice">Recent Results</h2>
                <a class="btn btn--secondary" href="/results{{ promotionQuery() }}">All Results</a>
            </div>
            <ul class="result-list">
                @forelse($recentResults as $result)
                    <x-result-card :result="$result" />
                @empty
                    <p class="soft-voice">No results yet.</p>
                @endforelse
            </ul>
        </section>

        <section class="promotion-articles">
            <div class="promotion-section-header">
                <h2 class="loud-voice">Recent Articles</h2>
                <a class="btn btn--secondary" href="/articles{{ promotionQuery() }}">All Articles</a>
            </div>
            <ul class="article-list">
                @forelse($recentArticles as $article)
                    <x-article-card :article="$article" />
                @empty
                    <p class="soft-voice">No articles yet.</p>
                @endforelse
            </ul>
        </section>

        <section class="promotion-wrestlers">
            <h2 class="loud-voice">Roster</h2>
            <ul class="wrestler-list">
                @forelse($promotion->wrestlers as $wrestler)
                    <x-wrestler-card :wrestler="$wrestler" />
                @empty
                    <p class="soft-voice">No wrestlers on roster.</p>
                @endforelse
            </ul>
        </section>

    </inner-column>
</x-layout>
