@extends('layouts.app')
@section('content')

<h1>Редактировать Image</h1>

<img src="/{{$imageInView->image}}" width="300" class="img-thumbnail">
<br>
<br>
<form action="/myprofile/gallery/update/{{$imageInView->id}}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="PUT">
    {{csrf_field()}}

    @if ($errors->has('title'))
       <span style="color: red; font-weight: bold;">{{$errors->first('title')}}</span>
    @endif
    
    <div>
        <label>Заголовок  <input type="text" name="title" value="{{$imageInView->title}}"></label>
    </div>
    
   
    
    <input type="file" name="image">
    <button type="submit" class="btn btn-warning">Edit</button>
</form>
<br>
 <div>
    <span id="open-button2" style="color: green; font-weight: bold">Добавить в общую галерею</span>
    <span class="image-id" style="display: none;">{{$imageInView->id}}</span>
 </div>
<br>


@php
    $categoryImage = [];
@endphp

@foreach($categoriesForImage as $category)         
    @php
        $categoryImage[]=$category->master_id;
    @endphp
 @endforeach

<div class="modal-overlay closed" id="modal-overlay2"></div>

<div class="modal closed" id="modal2" aria-hidden="true" aria-labelledby="modalTitle" aria-describedby="modalDescription" role="dialog">
  <button class="close-button" id="close-button2" title="Закрыть модальное окно">Закрыть</button>
  <div class="modal-guts" role="document">
      <div style="
           border: 1px solid; 
           width: 200px;
           display: inline-block;
           vertical-align: top;
           ">
         
                 
        @foreach($categories as $cat)
        
            <div style="margin-bottom: 20px;">
                <div style="
                     display: inline-block; 
                     vertical-align: top;
                     font-size: 35px;
                     color: green;

                     ">{{$cat->letter}}</div>
                <br>
                @foreach($cat->masters as $master)
                
                <br>
               
               
                    @php
                    if (in_array($master->id, $categoryImage)) {
                        echo ' <span class="checked" style="
                     display: inline-block;
                     vertical-align: top;
                     padding: 7px;
                     border: 2px solid;
                     border-radius: 5px;
                     margin-right: 10px;
                     ">
                        
                        <a class="specialization-item " data-spec-id = "' . $master->id .'" href="#">' . $master->specialization . '</a></span>';
                    }
                    else {
                        echo ' <span style="
                     display: inline-block;
                     vertical-align: top;
                     padding: 7px;
                     border: 2px solid;
                     border-radius: 5px;
                     margin-right: 10px;
                     "><a class="specialization-item " data-spec-id = "' . $master->id .'" href="#">' . $master->specialization .'</a></span>';
                    }
                    @endphp
       
                @endforeach
            </div>
        @endforeach
      </div>
      
  </div>
</div>

<script>
    var modal2 = document.querySelector("#modal2"),
    modalOverlay2 = document.querySelector("#modal-overlay2"),
    closeButton2 = document.querySelector("#close-button2"),
    openButton2 = document.querySelector("#open-button2");

    closeButton2.addEventListener("click", function() {
      modal2.classList.toggle("closed");
      modalOverlay2.classList.toggle("closed");
    });

    openButton2.addEventListener("click", function() {
      modal2.classList.toggle("closed");
      modalOverlay2.classList.toggle("closed");
    });

</script>


<script>
    var specialization = document.querySelectorAll('.specialization-item'); 
    var token = document.querySelector('.token').getAttribute('content');
    var imageId = document.querySelector('.image-id').innerHTML; 
    
   
    specialization.forEach(function(element, i){
        specialization[i].addEventListener('click', function(e) {
            e.preventDefault();
            var idSpec = e.target.dataset.specId;
            xmlhttp=new XMLHttpRequest();
              
               xmlhttp.onreadystatechange=function() {
                        if (this.readyState==4 && this.status==200) {
                             console.log(this.responseText);
                           if(e.target.parentElement.classList.contains('checked')){
                               e.target.parentElement.classList.remove("checked");
                           }
                           else {
                               e.target.parentElement.classList.add("checked");
                           }
                          
                            
                          }
                   }
                 
 
                 
                 xmlhttp.open("POST","/galleryCategory",true);
                 xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                 xmlhttp.setRequestHeader('X-CSRF-Token', token);
                 
		xmlhttp.send('idSpec=' + idSpec + '&idImage=' + imageId);	
               
                
                 
        });
    });
</script>



@endsection