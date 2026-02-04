@props([
  'href',
  'variant' => 'primary',
])

@php
  $variantClass = match ($variant) {
    'secondary' => 'btn--secondary',
    'danger' => 'btn--danger',
    default => 'btn--primary',
  };
@endphp

<button href="{{ $href }}" {{ $attributes->merge([
  'class' => "btn {$variantClass}"]) }}>
  {{ $slot }}
</button>

{{--submit use 'button', link use 'a..' probably should make new submit btn components --}}
