@extends('layouts.app')
@section('content')

<h2 class="title-masters">Общая галерея</h2>





@foreach($categoryMasters as $cat)

<div class="masters-alfabet-category">
    <div class="alfabet-category">
        <a name="{{$cat->letter}}">{{$cat->letter}}</a>
          
    </div>
    
  
    @foreach($cat->masters as $master)
        @if($master->img)
            <div class="masters-specialization">
                 <div class="nameMaster">
                    <a href="/gallery/show/{{$master['id']}}" style="position: relative; padding-bottom: 20px;">
                       <img src="/{{$master->img}}" width="200" class="img-thumbnail">
                       <span style="
                             position: absolute;
                             bottom: 0;
                             left: 0;
                             ">{{$master['specialization']}}</span>
                    </a>
                </div>

            </div>

         @endif
    @endforeach
</div>
@endforeach



@endsection