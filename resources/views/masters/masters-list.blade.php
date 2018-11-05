@extends('layouts.app')
@section('content')

    <h1 align="center">{{$category->specialization}}</h1>
    
    <div style="text-align: center;"class="sortirovka">
        Сортировать: 
       по стажу
       <a href="/masters-list/{{$category->id}}/1">по убыванию</a>
       <a href="/masters-list/{{$category->id}}/2">по возрастанию</a>
        по рейтингу
        <a href="/masters-list/{{$category->id}}/3">по убыванию</a>
       <a href="/masters-list/{{$category->id}}/4">по возрастанию</a>
        
    </div>
   <br>
    
@foreach($masters as $master)
<div class="master-block clearfix">
<div class="left">
    <div class="master-ava">
        <img src="/img/user-ava.jpg">
    </div>
    <div class="master-rating">
        <span class="bold">Рейтинг:</span> <span class="master-digit">{{$master->rating}}</span>
    </div>
    <div class="master-rating">
         <span class="bold">Стаж:</span> <span class="master-digit">{{\Carbon\Carbon::now()->diffInYears($master->created_at)}}</span>
    </div>
</div>
    
    <div class="right">
        <h2><a href="/masters/profile/{{$master->id}}">{{$master->name}}</a></h2>
        
        <div> <span class="bold">Имя</span></div>
        <div> <span class="bold">Город</span>: <span class="city">{{$master->city[0]->name}}</span></div>
        <div> <span class="bold">Категория:</span>
        
         @foreach($master->specialization as $spec)
            {{$spec->specialization}},
        @endforeach
        </div>
        <div> <span class="bold">Выезд за приделы:</span> 
            @if($master->outwards ==1)
                    нет
                @elseif($master->outwards ==2)
                да
                @endif
        </div>

        
        <br>
        <br>
        <br>
        <br>
        <br>
        
        О себе:
        <div class="description">{{$master->description}}</div>
    </div>
   </div>
@endforeach

@endsection