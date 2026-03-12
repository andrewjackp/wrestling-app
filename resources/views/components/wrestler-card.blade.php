@props([
	'wrestler',
	'name',
	'promotion'
])

@php 
@endphp

<li {{ $attributes->merge(['class' => 'wrestler-card']) }}>
<x-card>
	<li>
  {{ $wrestler->id }} — {{ $wrestler->name }} — {{ $wrestler->promotion->name }}
</li>
	<x-card.header>
		<div class="wrestler-card-heading">
			<x-card.title class="wrestler-card-title">
				{{ $wrestler->name }}
			</x-card.title>
		</div>
	</x-card.header>

	<x-card.body class="wrestler-card-body">

		<div class="wrestler-card-text">
			<p class="wrestler-card-content">
				Wrestles for: {{ $wrestler->promotion->name }}
			</p>
		</div>

		<picture class="wrestler-card-media">
			<img
				src="{{ $wrestler->image_url ?? 'https://peprojects.dev/images/landscape.jpg' }}"
				alt="{{ $wrestler->name }}"
			>
		</picture>

	</x-card.body>

	<x-card.footer>
		<div class="wrestler-card-footer-left">
			<x-button-link href="/wrestler/{{$wrestler->id}}/edit">
				Edit
			</x-button-link>
		</div>
	</x-card.footer>

</x-card>
</li>