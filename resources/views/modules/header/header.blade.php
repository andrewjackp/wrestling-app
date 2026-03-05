{{request()->getRequestUri()}}

@php
  $promotions = \App\Models\Promotion::orderBy('name')->get();
@endphp

   <header>
      <inner-column>
         <nav>
            <ul>
               <li><a href="/">Home</a></li>
               <li><a href="/dashboard">Dashboard</a></li>
               <li><a href="/articles">Articles</a></li>
               <li><a href="/wrestlers">Wrestlers</a></li>
               <li><a href="/bouts">Matches</a></li>
               
               <li class="nav-item nav-dropdown">
                  <span class="nav-link">Promotions ▾</span>

                  <div class="dropdown-panel">

                     <form method="GET" action="{{ route('dashboard') }}" class="dashboard-controls">

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
                     Update dashboard
                     </button>

                  </form>

        </div>
      </li>
            </ul>
         </nav>
      </inner-column>
   </header>