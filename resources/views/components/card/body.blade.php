@props([
  'as' => 'card-body'
])

@php
  $class = $class ?? null;
@endphp

<{{ $as }} {{ $attributes->merge(['class' => $class]) }}>
  {{ $slot }}
</{{ $as }} >