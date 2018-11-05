
@extends('layouts.app')
@section('content')

<div class="container">
    <div style="
         border: 1px solid;
         display: inline-block;
         vertical-align: top;
         ">
        <div class="form-group">
            <img src="/" alt="" class="img-responsive" width="100">
            <br>
            <br>
            <div class="custom-file" style="width:250px">
                <input type="file" class="custom-file-input" id="customFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
        </div>
        <br>
        <div class="rating">
           <div class="star-rating">
      <div class="star-rating__wrap">
            @for ($i = 5; $i >= 1; $i--)
                @if($i == $myVote)
                    <input class="star-rating__input" id="star-rating-{{$i}}" checked type="radio" name="rating" value="{{$i}}">
                    <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-{{$i}}" title="{{$i}} out of {{$i}} stars"></label>
               @else
                <input class="star-rating__input" id="star-rating-{{$i}}" type="radio" name="rating" value="{{$i}}">
                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-{{$i}}" title="{{$i}} out of {{$i}} stars"></label>
              @endif
              @endfor
              ваш голос 
              <div style="color: red; font-weight: bold; display: none" class="no-auth">Авторизируйтесь</div>
              <div style="color: red; font-weight: bold; display: none" class="self-rating">Нельзя самому себе ставить рейтинг</div>
          </div>
    </div>
           <br> 
            общий рейтинг <span class="specialization">{{$user->rating}}</span>
        </div>
        
       
        
    </div>
    
    <div style="
         border: 1px solid;
         display: inline-block;
         vertical-align: top;
         ">
        <h2>{{$user->name}}</h2>
        <span class="user-id" style="display: none;">{{$user->id}}</span>
        
        
       
        
        <div class="data-reg">
            Дата регистрации: <span>{{$user->created_at}}</span>
        </div>
        <br>
         Стаж: {{$experience}}
        <br>
        <br>
        <div>

                <div class="outwards">
                Выезд за пределы своего города
                
                @if($user->outwards ==1)
                    нет
                @elseif($user->outwards ==2)
                да
                @endif
                </div>
                <br>
                
                <div class="data-reg">
                 Номера телефонов: 
                 <br>
                 {{$user->number1}}
                 <br>
                 {{$user->number2}}
                 <br>
                 {{$user->number3}}
                </div>
                <br>
                
                <div class="data-reg">
                 Ссылка на социальную сеть: <a href="{{$user->social}}" target="_blank">{{$user->social}}</a>
                </div>
               <br>
                <span>Город:</span> 
                {{$user->city[0]->name}}
                <br>
                
                 <span>Категория:</span> 
                
                    @foreach($user->masters as $master)
                         <span class="specialization">{{$master->specialization}}</span>
                    @endforeach
                 
                 <br>
                <br>
                
                <label>О себе
                    <textarea name="description" cols="40" rows="10">{{$user->description}}</textarea>
                </label>
                 <br>
                <br>
                
            
            
            
            
           
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
   

<script>
    
    
   var photoLink = document.querySelector(".photo-link"),
            
   photo = document.querySelector(".photo");
   userId = document.querySelector(".user-id").innerHTML;

        photoLink.addEventListener('click', function(e) {
            e.preventDefault(); 
            
            xmlhttp=new XMLHttpRequest();
							
               xmlhttp.onreadystatechange=function() {
                        if (this.readyState==4 && this.status==200) {                
                          photo.innerHTML =this.responseText;  
                          }
                   }
                 xmlhttp.open("GET","/masters/gallery/" + userId,true);
                 xmlhttp.send();
                 
                
        });
    
</script>


 <script>
            var input = document.querySelectorAll('.star-rating__input');
            var token = document.querySelector('.token').getAttribute('content');
            var userId = document.querySelector(".user-id").innerHTML;
            var noAuth = document.querySelector('.no-auth');
            var selfRating = document.querySelector('.self-rating');
            
            input.forEach(function(element, i){
                input[i].addEventListener('click', function(e) {
                    var rating = e.target.getAttribute('value');
                   
                      xmlhttp=new XMLHttpRequest();
                      
                    
							
                        xmlhttp.onreadystatechange=function() {
                                 if (this.readyState==4 && this.status==200) {  
                                     console.log(this.responseText);
                                     if(this.responseText == 'Авторизируйтесь') {
                                         noAuth.style.display = 'block';
                                     }
                                     if(this.responseText == 'накрутка') {
                                         selfRating.style.display = 'block';
                                     }
                                    
                                   }
                            }
                          xmlhttp.open("POST","/masters/rating",true);
                          xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                          xmlhttp.setRequestHeader('X-CSRF-Token', token);
                          
                         
                         xmlhttp.send('rating=' + rating + '&userId=' + userId);
                      
               
                   
                });
            });
            
        </script>
        
        <script src="/js/blueimp-helper.js"></script>
        <script src="/js/blueimp-gallery.js"></script>
        <script src="/js/blueimp-gallery-fullscreen.js"></script>
        <script src="/js/blueimp-gallery-indicator.js"></script>
        <script src="/js/vendor/jquery.js"></script>
        <script src="/js/jquery.blueimp-gallery.js"></script>
        
         @endsection