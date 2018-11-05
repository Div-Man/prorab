@extends('layouts.app')
@section('content')

<h2 class="title-masters">{{$cityName}}</h2>

<div class="masters-alfabet">
    @foreach($categoryMasters as $cat)
        <a href="#{{$cat->letter}}" class="masters-category">{{$cat->letter}}</a>
    @endforeach
</div>



@foreach($categoryMasters as $cat)

<div class="masters-alfabet-category">
    <div class="alfabet-category">
        <a name="{{$cat->letter}}">{{$cat->letter}}</a>
          <span class="master-category-count">{{$cat->countAllMaster}}</span>
    </div>
    
  
    @foreach($cat->masters as $master)
        @if($master['id'])
            <div class="masters-specialization">
                <div class="countMaster">
                    @if($master['countMaster'])
                         {{$master['countMaster']}}
                    @else
                        0
                    @endif
                  
                </div>
                <div class="nameMaster">
                    <a href="/masters-list/{{$master['id']}}">{{$master['specialization']}}</a>
                </div>
                
            </div>
        
         
        
         @endif
    @endforeach
</div>
@endforeach



@endsection