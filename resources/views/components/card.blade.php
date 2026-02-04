@props([
	'as' => 'card'
])

<{{ $as }} {{ $attributes }}>
	{{ $slot }}
</{{ $as }} >