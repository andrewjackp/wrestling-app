<?php

use Illuminate\Support\HtmlString;

if (!function_exists('formatCode')) {
    function formatCode(string $string): HtmlString
    {
        return new HtmlString("<pre><code>{$string}</code></pre>");
    }
}

if (!function_exists('selectedPromotions')) {
    function selectedPromotions(): array
    {
        return collect(request()->input('promotions', []))
            ->filter()
            ->map(fn ($id) => (int) $id)
            ->values()
            ->all();
    }
}

if (!function_exists('promotionQuery')) {
    function promotionQuery(): string
    {
        $selected = selectedPromotions();
        return $selected ? '?' . http_build_query(['promotions' => $selected]) : '';
    }
}