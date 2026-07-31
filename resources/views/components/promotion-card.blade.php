@props(['promotion'])

<li {{ $attributes->merge(['class' => 'promotion-list__item']) }}>
    <x-card class="promotion-card">

        <x-card.header>
            <div class="promotion-card__heading">
                @if($promotion->logo)
                    <img class="promotion-card__logo" src="{{ $promotion->logo }}" alt="{{ $promotion->name }}">
                @endif
                <x-card.title class="promotion-card__title">
                    <a class="link" href="{{ route('promotion.show', $promotion) }}">{{ $promotion->name }}</a>
                </x-card.title>
            </div>
        </x-card.header>

        <x-card.body class="promotion-card__body">
            <p class="soft-voice">
                {{ $promotion->wrestlers_count ?? $promotion->wrestlers->count() }}
                {{ Str::plural('wrestler', $promotion->wrestlers_count ?? $promotion->wrestlers->count()) }}
            </p>
            @if(($promotion->championships_count ?? $promotion->championships->count()) > 0)
                <p class="soft-voice">
                    {{ $promotion->championships_count ?? $promotion->championships->count() }}
                    {{ Str::plural('championship', $promotion->championships_count ?? $promotion->championships->count()) }}
                </p>
            @endif
        </x-card.body>

        <x-card.footer>
            <x-button-link href="{{ route('promotion.show', $promotion) }}">
                View Promotion
            </x-button-link>
        </x-card.footer>

    </x-card>
</li>
