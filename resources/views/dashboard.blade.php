<x-layout>
	<inner-column>

{{-- 		<form method="GET" action="{{ route('dashboard') }}" class="dashboard-controls">
			<fieldset>
  				<legend>Promotions</legend>
  				<p class="help">Hold Cmd/Ctrl to select multiple.</p>

  					<select name="promotions[]" multiple size="6">
    					@foreach($promotions as $promotion)
      				<option
        					value="{{ $promotion->id }}"
       						@selected(in_array($promotion->id, $selectedPromotions ?? []))
      				>
        					{{ $promotion->name }}
      				</option>
    					@endforeach
  					</select>
			</fieldset>

		<button type="submit" class="btn btn--secondary">Update dashboard</button>
		</form> --}}

		<div class="dashboard">
			<section class="events">
				<h1 class='attention-voice'>EVENTS</h1>
        		<ul class="event-list">
           		@foreach($events as $event)
        				<x-event-card :event="$event" />
            	@endforeach
        		</ul>
			</section>

			<section class="articles" x-data="{ expanded: false }" :class="{ 'articles--expanded': expanded }">
				<h1 class="attention-voice">Featured Articles</h1>
				<ul class='article-list'>
					@foreach($articles as $article)
						<x-article-card :article="$article" />
					@endforeach
				</ul>
				<button class="load-more-btn" @click="expanded = true" x-show="!expanded">
					Load More
				</button>
			</section>

			<section class="results">
  				<h1 class="attention-voice">RESULTS</h1>
  				<ul class="result-list">
    				@foreach($results as $result)
      				<x-result-card :result="$result" />
    				@endforeach
  				</ul>
			</section>
		</div>
	</inner-column>
</x-layout>
