@props([
  'as' => 'card-header'
])

@php
  $class = $class ?? null;
@endphp

<{{ $as }} {{ $attributes->merge(['class' => $class]) }}>
  {{ $slot }}
</{{ $as }} >