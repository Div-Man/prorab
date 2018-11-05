@extends('layouts.app')
@section('content')

<div class="container">
    <div style="
         border: 1px solid;
         display: inline-block;
         vertical-align: top;
         ">
        <div class="form-group">
            <img src="/{{$myInfo->image}}" alt="" class="img-responsive" width="100">
            <br>
            <br>
            <div class="custom-file" style="width:250px">
                <input type="file" class="custom-file-input" id="customFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
        </div>
        <br>
        <br>
        <div class="rating">
            рейтинг <span class="specialization">{{$myInfo->rating}}</span>
        </div>
         <br>
        <br>
        <a href="/myprofile/gallery">Моя галлерея</a>
    </div>
    
    <div style="
         border: 1px solid;
         display: inline-block;
         vertical-align: top;
         ">
        <h2>{{$myInfo->name}}</h2>
        
        <div class="data-reg">
            Дата регистрации: <span>{{$myInfo->created_at}}</span>
        </div>
        <br>
        
       
        
        <div>
            
            @php
               $myCat = [];
            @endphp
            <form  action="/myprofile/update/{{$myInfo->id}}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                {{csrf_field()}}
                
                <div class="outwards">
                Выезд за пределы своего города
                <select name="outwards" onchange="outwardsFoo(this.value)">
                    @if($myInfo->outwards == 1)
                        <option selected value="1">Нет</option>
                        <option value="2">Да</option>
                    @elseif ($myInfo->outwards == 2)
                        <option value="1">Нет</option>
                        <option selected value="2">Да</option>
                    @endif
                    
              </select>
                
                <span class="save-outwards" style="color: green; display: none;">Сохранено</span>
                </div>
                <br>
  
                <div class="data-reg">
                    Ссылка на социальную сеть:  <input type="text" name="linkSocial" value="{{$myInfo->social}}">
                    
                    
                </div>
                <br>
                 <div class="data-reg">
                    Номер телефона 1: 
                    <input id="phone1" name="number1" type="text" value="{{$myInfo->number1}}">	
                </div>
                
                <div class="data-reg">
                    Номер телефона 2: 
                    <input id="phone2" name="number2" type="text" value="{{$myInfo->number2}}">	
                </div>
                
                <div class="data-reg">
                    Номер телефона 3: 
                    <input id="phone3" name="number3" type="text" value="{{$myInfo->number3}}">	
                </div>
                
                <script>
               $(document).ready(function($){
               $(function(){

                 $("#phone1").mask("8(999) 999-9999", {autoclear: false});
                 $("#phone2").mask("8(999) 999-9999", {autoclear: false});
                 $("#phone3").mask("8(999) 999-9999", {autoclear: false});
               });
               });
           </script>

                
               <br>
                <span>Город</span> 
                <input class="my-city" type="text" value="{{$city}}">
                <input class="my-city-id" name="myCityId" type="hidden" value="{{$cityId}}">
                <span id="open-button-update-pofil" class="open-button">Выбрать</span>
                
                <br>
                <br>
                
               
                
                 <span>Категория</span> 
                 @foreach($categories as $category)
                    @foreach($category->masters as $catego)
                     @php
                        $myCat[]=$catego->id;
                      @endphp
                         <span class="specialization">{{$catego->specialization}}</span>
                    @endforeach
                 @endforeach
                  <span id="open-button2" class="open-button">Изменить</span>
                 <br>
                <br>
                
                <label>О себе
                    <textarea name="description" cols="40" rows="10">{{$myInfo->description}}</textarea>
                </label>
                 <br>
                <br>
                <input type="submit">
            </form>
            
            
            
           
        </div>
        
        
       
        <a class="photo-link" href="">Фото</a>
         
        
    <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
   
         <div id="links" class="links">
              <div class="photo"> 
                  
              </div>
              </div>
    
    
     <div id="blueimp-gallery" class="blueimp-gallery">
        <div class="slides"></div>
        <h3 class="title"></h3>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="close">×</a>
        <a class="play-pause"></a>
        <ol class="indicator"></ol>
    </div>
    
      
       
    </div>
   
</div>


<script>
    var modal = document.querySelector("#modal"),
    modalOverlay = document.querySelector("#modal-overlay"),
    closeButton = document.querySelector("#close-button"),
    openButtonProfileUpdate = document.querySelector("#open-button-update-pofil");

    closeButton.addEventListener("click", function() {
      modal.classList.add("closed");
      modalOverlay.classList.add("closed");
    });

    openButtonProfileUpdate.addEventListener("click", function() {
      modal.classList.toggle("closed");
      modalOverlay.classList.toggle("closed");
    });

</script>




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
         
                 
        @foreach($allCategory as $cat)
        
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
                    if (in_array($master->id, $myCat)) {
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
    
   
    specialization.forEach(function(element, i){
        specialization[i].addEventListener('click', function(e) {
            e.preventDefault();
            var idSpec = e.target.dataset.specId;
            xmlhttp=new XMLHttpRequest();
							
               xmlhttp.onreadystatechange=function() {
                        if (this.readyState==4 && this.status==200) { 
                           if(e.target.parentElement.classList.contains('checked')){
                               e.target.parentElement.classList.remove("checked");
                           }
                           else {
                               e.target.parentElement.classList.add("checked");
                           }
                            
                          }
                   }
                 
                 
                 
                 xmlhttp.open("POST","/",true);
                 xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                 xmlhttp.setRequestHeader('X-CSRF-Token', token);
                 
		xmlhttp.send('id=' + idSpec);	
                
                 
        });
    });
</script>

<script>
    
    
   var photoLink = document.querySelector(".photo-link"),
            
   photo = document.querySelector(".photo");

        photoLink.addEventListener('click', function(e) {
            e.preventDefault();        
            xmlhttp=new XMLHttpRequest();
							
               xmlhttp.onreadystatechange=function() {
                        if (this.readyState==4 && this.status==200) {                
                           photo.innerHTML =this.responseText;
 				  
                          }
                   }
                 xmlhttp.open("GET","/myprofile/my-gallery",true);
                 xmlhttp.send();
                
        });
    
</script>

<script>
    
    function outwardsFoo(id) {
        var token = document.querySelector('.token').getAttribute('content');

        var saveOutwards = document.querySelector('.save-outwards');
         xmlhttp=new XMLHttpRequest();
							
               xmlhttp.onreadystatechange=function() {
                        if (this.readyState==4 && this.status==200) {  
                            saveOutwards.style.display = 'inline';
                          }
                   }
                 
                 
                 xmlhttp.open("POST","/outwards",true);
                 xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                 xmlhttp.setRequestHeader('X-CSRF-Token', token);
                 
                xmlhttp.send('id=' + id);
               
    }
 
    
</script>

 <script src="/js/blueimp-helper.js"></script>
        <script src="/js/blueimp-gallery.js"></script>
        <script src="/js/blueimp-gallery-fullscreen.js"></script>
        <script src="/js/blueimp-gallery-indicator.js"></script>
        <script src="/js/vendor/jquery.js"></script>
        <script src="/js/jquery.blueimp-gallery.js"></script>
        
        
        
        @endsection