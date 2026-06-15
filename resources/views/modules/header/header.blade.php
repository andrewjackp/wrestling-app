{{request()->getRequestUri()}}

@php
  $promotions = \App\Models\Promotion::orderBy('name')->get();
@endphp

   <header>
      <inner-column>
         <nav>
            <ul>
               <li><a href="/{{ promotionQuery() }}">Home</a></li>
               {{-- <li><a href="/dashboard{{ promotionQuery() }}">Dashboard</a></li> --}}
               <li><a href="/articles{{ promotionQuery() }}">Articles</a></li>
               <li><a href="/wrestlers{{ promotionQuery() }}">Wrestlers</a></li>
               <li><a href="/bouts{{ promotionQuery() }}">Matches</a></li>
               
               <li class="nav-item nav-dropdown">
                  <span class="nav-link">Promotions ▾</span>

                  <div class="dropdown-panel">

                     <form method="GET" action="{{ url()->current() }}" class="dashboard-controls">

                      <fieldset>
                        
                        <legend>Filter Promotions</legend>
                           <select name="promotions[]" multiple size="6">
                              @foreach($promotions as $promotion)
                                 <option
                                    value="{{ $promotion->id }}"
                                       @selected(in_array($promotion->id, $selectedPromotions ?? []))>
                                          {{ $promotion->name }}
                                 </option>
                              @endforeach
                           </select>
                     </fieldset>

                     <button type="submit" class="btn btn--secondary">
                     Update
                     </button>

                  </form>

        </div>
      </li>
            </ul>
         </nav>
      </inner-column>
   </header>