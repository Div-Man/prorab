@extends('layouts.app')
@section('content')

<h1>Моя галлерея</h1>

<form action="/gallery/store" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    
    @if ($errors->has('title'))
        <span style="color: red; font-weight: bold;">{{$errors->first('title')}}</span>
    @endif
    
    <div>
        <label>Заголовок  <input type="text" name="title" value="{{ old('title') }}"></label>
    </div>
  @if ($errors->has('image'))
        <span style="color: red; font-weight: bold;">{{$errors->first('image')}}</span>
    @endif
    <div>
        <input type="file" name="image">
    </div>
    <br>
    <button type="submit" class="btn btn-success">Добавить</button>
    
    
    </form>
    <br>
    <br>
    
    @foreach($myImages as $image)
    <div style="display: inline-block; vertical-align: top; margin-right: 10px;">
        <img src="/{{$image->image}}" width="300">
         <a style="display: block; padding: 5px;" href="/myprofile/gallery/edit/{{$image->id}}" class="btn btn-warning my-button">Edit</a>
         
         <form style="display: block; padding: 5px;" action="/myprofile/gallery/delete/{{$image->id}}" method="post" enctype="multipart/form-data">
             {{csrf_field()}}
             <input type="hidden" name="_method" value="DELETE">
             <button onclick="return confirm('are you sure?')" type="submit" class="delete">
                Удалить
             </button>
         </form>
    
    </div>

    @endforeach
    
@endsection