<x-layout>
   <ul>
      <inner-column>
         @foreach($bout->wrestlers as $wrestler)
            <li>
               <a href="/wrestler/{{$wrestler->id}}">
                  {{$wrestler->name}}
               </a>
            </li>
      @endforeach
      </inner-column>
   </ul>
</x-layout>