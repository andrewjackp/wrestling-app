@props([
	'wrestler',
	'name',
	'promotion'
])

@php 
@endphp

<x-card {{ $attributes->merge(['class' => 'wrestler-card']) }}>
	<x-card.header>
		<div class="wrestler-card-heading">
			<x-card.title class="wrestler-card-title">
				{{ $wrestler->name }}
			</x-card.title>
		</div>
	</x-card.header>

	<x-card.body>
		<p class="wrestler-card-content">
			Wrestles for: {{ $wrestler->promotion->name }}
		</p>
	</x-card.body>

	<x-card.footer>
		<div class="wrestler-card-footer-left">
			<x-button-link href="/wrestler/{{$wrestler->id}}/edit">Edit</x-button-link>
		</div>
	</x-card.footer>
</x-card>