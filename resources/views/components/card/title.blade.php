@props(['as' => 'h2'])

<{{ $as }} {{ $attributes->merge(['class' => 'title']) }}>
	{{ $slot }}
</{{ $as }}>