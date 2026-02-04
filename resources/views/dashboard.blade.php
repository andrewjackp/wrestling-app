<x-layout>
	<inner-column>

		<form method="GET" action="{{ route('dashboard') }}" class="dashboard-controls">
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
		</form>
		<div class="dashboard">			
			<section class="promotions">
				<h1 class='attention-voice'>PROMOTIONS</h1>
        		<ul>	
           		@foreach($promotions as $promotion)
     					@if(empty($selectedPromotions) || in_array($promotion->id, $selectedPromotions))
        					<li>
         					<a href="/promotions/{{ $promotion->id }}">
            					{{ $promotion->name }}
          					</a>
        					</li>
      				@endif
            @endforeach   
        		</ul> 			
			</section>

			<section class="articles">
				<h1 class="attention-voice">Featured Articles</h1>
    			<ul class='article-list'>
      			@foreach($articles as $article)
        				<x-article-card :article="$article" />
      			@endforeach
    			</ul>			
			</section>

			<section class="wrestlers">
				<h1 class="attention-voice">RASSLERZ</h1>
				<ul>
            	@foreach($wrestlers as $wrestler)
                	<li>
                		<a href="/wrestler/{{$wrestler->id}}">
                			{{$wrestler->name}}
                		</a>
                	</li>
            	@endforeach   
        		</ul>		
			</section>			
		</div>
	</inner-column>
</x-layout>