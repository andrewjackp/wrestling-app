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

                      <a
                           href="{{ url(request()->path()) }}"
                           class="dropdown-all-link {{ empty($selectedPromotions ?? []) ? 'dropdown-all-link--active' : '' }}"
                        >
                           All Promotions
                        </a>

                        <fieldset>
                           <legend>Filter by Promotion</legend>
                           <select name="promotions[]" multiple size="{{ $promotions->count() }}">
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
               <li class="nav-item nav-search">
                  <form method="GET" action="{{ route('search') }}" class="nav-search-form" role="search">
                     <input
                        type="search"
                        name="q"
                        class="nav-search-input"
                        placeholder="Search wrestlers, articles, events…"
                        value="{{ request('q') }}"
                        aria-label="Search"
                     >
                     <button type="submit" class="nav-search-btn" aria-label="Submit search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                     </button>
                  </form>
               </li>

               @auth
                  <li class="nav-item nav-auth">
                     <span class="nav-user soft-voice">{{ auth()->user()->name }}</span>
                  </li>
                  <li>
                     <form method="POST" action="{{ route('logout') }}" class="nav-logout-form">
                        @csrf
                        <button type="submit" class="nav-logout-btn">Sign Out</button>
                     </form>
                  </li>
               @else
                  <li><a href="{{ route('login') }}">Sign In</a></li>
               @endauth
            </ul>
         </nav>
      </inner-column>
   </header>