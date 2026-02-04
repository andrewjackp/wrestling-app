<x-layout>
	<inner-column>
	@if (Session::has('failed'))
		<span>{{Session::get('failed')}}</span>
	@endif
	<form method="POST" action="/wrestlers/{{ $wrestler->id }}">
    @csrf
    @method('PUT')
    <input type="text" name="name" value="{{ $wrestler->name }}">
    	<select name="promotion_id" id="">
			@foreach($promotions as $promotion)
			<option name="promotion_id" value="{{ $promotion->id}}">{{ $promotion->name }}</option>
			@endforeach
		</select>
    <button type="submit">Update</button>
</form>

@if ($errors->any())
	<ul>
	   @foreach ($errors->all() as $error)
	      <li>{{ $error }}</li>
	   @endforeach
	</ul>
@endif

<a href="/wrestler/{{$wrestler->id}}/delete">Delete</a>
	</inner-column>
</x-layout>
