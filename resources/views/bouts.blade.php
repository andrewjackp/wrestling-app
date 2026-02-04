<x-layout>
   <ul>
      <inner-column>
            @foreach($bouts as $bout)
            <li>
               <a href="/bout/{{$bout->id}}">
                  {{$bout->title}}
               </a>
            </li>    
         @endforeach  
      </inner-column>
   </ul>      
</x-layout>