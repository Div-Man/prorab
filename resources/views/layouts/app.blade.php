<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8" />
        
        <link rel="stylesheet" href="/css/normalize.css">
        <link rel="stylesheet" href="/css/style.css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/masters.css') }}" rel="stylesheet">
       
       
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        
        <script src="/js/vendor/jquery.js"></script>
        <script src="/js/jquery.maskedinput.min.js"></script>
      

        
        
         <link rel="stylesheet" href="/css/blueimp-gallery.css">
        <link rel="stylesheet" href="/css/blueimp-gallery-indicator.css">
        
        
        <link rel="stylesheet" href="/css/blueimp-gallery.css">
    <link rel="stylesheet" href="/css/blueimp-gallery-indicator.css">
        
        
        <meta class="token" name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Прораб') }}</title>
        
        <script src="{{ asset('js/app.js') }}" defer></script>
        
        
        <style>
            
            
           .blueimp-gallery > .description {
  position: absolute;
  top: 30px;
  left: 15px;
  color: #fff;
  display: none;
}
.blueimp-gallery-controls > .description {
  display: block;
}
            
            
            select {
                width: 200px;
                -webkit-appearance: none;
            }     
            
.modal, .modal2 {
  display: block;
  width: 800px;
  max-width: 100%;
  
  height: 600px;
  max-height: 100%;
  
  position: fixed;
  
  z-index: 100;
  
  left: 50%;
  top: 50%;
  
  transform: translate(-50%, -50%);

  background: white;
  box-shadow: 0 0 60px 10px rgba(0, 0, 0, 0.9);
}
.closed {
  display: none;
}

.modal-overlay, .modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 50;
  
  background: rgba(0, 0, 0, 0.6);
}
.modal-guts {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  padding: 20px 50px 20px 20px;
}

.modal .close-button, .modal2 .close-button2 {
  position: absolute;
  z-index: 1;
  top: 10px;
  right: 20px;
  
  border: 0;
  background: black;
  color: white;
  padding: 5px 10px;
  font-size: 1.3rem;
}

.clear-button {
  position: absolute;
  z-index: 1;
  top: 100px;
  right: 20px;
  
  border: 0;
  background: red;
  color: white;
  padding: 5px 10px;
  font-size: 1.3rem;
}





/*Для личного кабинета*/

.modal, .modal2 {
  display: block;
  width: 800px;
  max-width: 100%;
  
  height: 600px;
  max-height: 100%;
  
  position: fixed;
  
  z-index: 100;
  
  left: 50%;
  top: 50%;
  
  transform: translate(-50%, -50%);

  background: white;
  box-shadow: 0 0 60px 10px rgba(0, 0, 0, 0.9);
}
.closed {
  display: none;
}

.modal-overlay, .modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 50;
  
  background: rgba(0, 0, 0, 0.6);
}
.modal-guts {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  padding: 20px 50px 20px 20px;
}

.modal .close-button, .modal2 .close-button2 {
  position: absolute;
  z-index: 1;
  top: 10px;
  right: 20px;
  
  border: 0;
  background: black;
  color: white;
  padding: 5px 10px;
  font-size: 1.3rem;
}


.specialization {
    background: yellow;
    display: inline-block;
    vertical-align: top;
    padding: 5px 10px;
    border-radius: 10px;
}


.checked {
    background: yellow;
}


.photo {
    width: 600px;
}
.image{
    display: inline-block;
    vertical-align: top;
    margin-right: 10px;
    margin-bottom: 10px;
}

/*Для просмтора профидя любого мастера*/


.specialization {
    background: yellow;
    display: inline-block;
    vertical-align: top;
    padding: 5px 10px;
    border-radius: 10px;
}

.photo {
    width: 600px;
}

.image{
    display: inline-block;
    vertical-align: top;
    margin-right: 10px;
    margin-bottom: 10px;
}

.ocenka span {
    background: #f3f3f3;
}

.star-rating{
	font-size: 0;
}
.star-rating__wrap{
	display: inline-block;
	font-size: 1rem;
}
.star-rating__wrap:after{
	content: "";
	display: table;
	clear: both;
}
.star-rating__ico{
	float: right;
	padding-left: 2px;
	cursor: pointer;
	color: #FFB300;
}
.star-rating__ico:last-child{
	padding-left: 0;
}
.star-rating__input{
	display: none;
}
.star-rating__ico:hover:before,
.star-rating__ico:hover ~ .star-rating__ico:before,
.star-rating__input:checked ~ .star-rating__ico:before
{
	content: "\f005";
}

</style>
        
        
        
    </head>
    <body>
        <div class="top-header-block clearfix">
            <div class="top-left-block">
                <div id="open-button" class="open-button globus">
                    <span class="ico-globus"></span>
                    <span class="my-location" style="color: red; font-weight: bold">
                        @php
                        if(isset($myLocation)) {
                            echo $myLocation;
                        }
                        
                        else {
                            echo 'Москва';
                        }
                             
                        @endphp
                       
                    </span>
                </div>
            </div>
            <div class="top-right-block">
                
                  @if (Auth::check())
                  
                   <div class="menu">
                    <div class="login">
                        <span>{{ Auth::user()->name}}</span> 
                        <img src="/img/ava.jpg">
                    </div>
                    <div class="top-categories hidden">
                        <a href="{{ route('myprofile') }}">Личный кабинет</a>
                        <a href="">Объявления</a>
                        <a href="">Пункт</a>
                        <a href="">Пункт</a>
                        <a href="">Пункт</a>
                        <a href="">Пункт</a>
                        <a href="">Пункт</a>
                        <a href="">Пункт</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            {{ __('Выйти') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                    </div>
                </div>
                   
                @else
                    <div class="login-register">
                        <a href="{{ route('login') }}">Вход</a>
                        <a href="{{ route('register') }}">Зарегистрироваться</a>
                    </div>
                @endif
            </div>
        </div>
        
        
        
 <div class="modal-overlay closed" id="modal-overlay"></div>

<div class="modal closed" id="modal" aria-hidden="true" aria-labelledby="modalTitle" aria-describedby="modalDescription" role="dialog">
  <button class="close-button" id="close-button" title="Закрыть модальное окно">Закрыть</button>

  <script>
      
     function deleteCookie(name) { 
         var cookieDate = new Date(); 
         cookieDate.setTime(cookieDate.getTime() - 1); 
         var cookie = name += "=; expires=" + cookieDate.toGMTString(); 
         document.cookie = cookie; 
     }


      
  </script>
  
  <div class="modal-guts" role="document">
      
      <div class="titles">
          

          
            <div class="chooise-title" style="
              background: #03A9F6;
              padding: 10px;
              border-radius: 10px;
              border: 1px solid;
                          text-transform: uppercase;
               width: 200px;
               display: inline-block;
               vertical-align: top;
               margin-bottom: 15px;
              ">Выбрать страну</div> 
              
                <div class="chooise-title" style="
              background: #03A9F6;
              padding: 10px;
              border-radius: 10px;
              border: 1px solid;
              text-transform: uppercase;
               width: 200px;
               display: inline-block;
               vertical-align: top;
                 margin-bottom: 15px;
              ">Выбрать Регион</div> 
              
                <div class="chooise-title" style="
              background: #03A9F6;
              padding: 10px;
              border-radius: 10px;
              border: 1px solid;
              text-transform: uppercase;
              width: 200px;
              display: inline-block;
              vertical-align: top;
                margin-bottom: 15px;
              ">Выбрать Город</div> 
              
              
      </div>
      
     
      <div style="
         
           width: 200px;
           display: inline-block;
           vertical-align: top;
           ">
          
        
          
          <select name="users" onchange="showCountry(this.value)">
              
               @php
            if(isset($countryAll)) {
                 foreach($countryAll as $county){
                      echo '<option class="strana" value='.$county->country_id.'|'.$county->name.'>'.$county->name.'</option>';
                 } 
            }
         @endphp
              
            </select>
          
      </div>
      
      <div class="regions" style="
           width: 200px;
           display: inline-block;
           vertical-align: top;
           ">
          
            <select></select>
         
      </div>
      
    
      
      <div class="cities" style="
          
           width: 200px;
           display: inline-block;
           vertical-align: top;
           ">
          
           <select class="all-cities"></select>
          
     
      </div>
      
  </div>
</div>
 
 
 <script>
     
   

     
    var modal = document.querySelector("#modal"),
    modalOverlay = document.querySelector("#modal-overlay"),
    closeButton = document.querySelector("#close-button"),
    openButton = document.querySelector("#open-button");

    closeButton.addEventListener("click", function() {
      modal.classList.toggle("closed");
      modalOverlay.classList.toggle("closed");
    });

    openButton.addEventListener("click", function() {
      modal.classList.toggle("closed");
      modalOverlay.classList.toggle("closed");
    });
    
    document.onclick = function(e) {
        if(e.target == modalOverlay) {
             modal.classList.toggle("closed");
             modalOverlay.classList.toggle("closed");
        }
     }
    
    
    
      //всё равно из русских символов будет помойка   
    function setCookie(name, value, days, path) {
    
    path = path || '/'; // заполняем путь если не заполнен
    days = days || 10;  // заполняем время жизни если не получен параметр

    var last_date = new Date();
    last_date.setDate(last_date.getDate() + days);
    var value = escape(value) + ((days==null) ? "" : "; expires="+last_date.toUTCString());
    document.cookie = name + "=" + value + "; path=" + path; // вешаем куки
    
    }
    

</script>

<script>

     var myLocation = document.querySelector('.my-location');
     var regions = document.querySelector('.regions');
     
    
    function test() {
        document.querySelector('.all-cities').innerHTML='';
    };

    
     
    function showCountry(str) {
        
       test();
        
        var arr = str.split('|');
        myLocation.innerHTML = arr[1];

         var idCountry = arr[0];

         xmlhttp=new XMLHttpRequest();
            
             setCookie('idCountry', idCountry, 10, '/'); 
							
               xmlhttp.onreadystatechange=function() {
                        if (this.readyState==4 && this.status==200) {                
                            regions.innerHTML = this.responseText;
 				  
                          }
                   }
                 xmlhttp.open("GET","/region/"+idCountry,true);
                 xmlhttp.send();
                 
                 
                 
         deleteCookie('idRegion');
        deleteCookie('cityId');
    
    }
     
  
</script>

<script>
    
    
    function showRegions(str) {
        
 
        var cities = document.querySelector('.cities');
         var arr = str.split('|');
            myLocation.innerHTML = arr[1];

         var idCountry = arr[0];
           
            var idRegion = arr[0];
            setCookie('idRegion', idRegion, 10, '/'); 
            
            xmlhttp=new XMLHttpRequest();
							
               xmlhttp.onreadystatechange=function() {
                        if (this.readyState==4 && this.status==200) {                
                            cities.innerHTML = this.responseText;
 				  
                          }
                   }
                 xmlhttp.open("GET","/city/"+idRegion,true);
                 xmlhttp.send();
                    
    }
    
    
</script>

     <script>
        

    function showCities(str){
         var cit = document.querySelectorAll('.cities');
        
          var arr = str.split('|');
          myLocation.innerHTML = arr[1];
        
        
         var idCity = arr[0];
         var name = arr[1];
        
        // это для изменения профиля
        var myCity = document.querySelector('.my-city');
        var myCityId = document.querySelector('.my-city-id');
        
        
         setCookie('cityId', idCity, 10, '/'); 
   
            
            if(myCity && myCityId) {
                myCity.value = name;
                myCityId.value = idCity;
            }
    }
    

</script>
        
        
        

        <div class="main-header clearfix">
            <div class="wrap clearfix">
                <div class="logo">
                    <a href="{{url('/') }}"><img src="/img/logo.jpg"></a>
                </div>
                <div class="contacts">
                    <div class="email">admin@prorab-service.ru</div>
                    <div class="phone">+79880000000</div>
                </div>
            </div>
            <div class="social">
                <span class="description">Мы в:</span>
                <div class="ico-block">
                    <span class="social-ico ico-instagram"></span>
                    <span class="social-ico ico-facebook"></span>
                    <span class="social-ico ico-twitter"></span>
                    <span class="social-ico ico-vk"></span>
                </div>

            </div>
        </div>

        <div class="main-search">
            @php
            if(isset($breadcrumbs)) {
                echo $breadcrumbs;
            }
            @endphp
            
           
               
        </div>

         @yield('content')

        <footer>
            <span>Прораб Сервис</span>
        </footer>


        <script>
            var login = document.querySelector('.login');
            var topCategories = document.querySelector('.top-categories')

            login.addEventListener('click', function (e) {
                topCategories.classList.toggle('hidden');
            });
            
            
            
            
        </script>

        

    </body>
</html>
      
           
        

