<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8" />
        <title>Прораб</title>
        <link rel="stylesheet" href="/css/normalize.css">
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body>
        <div class="top-header-block clearfix">
            <div class="top-left-block">
                <div class="globus">
                    <span></span>
                </div>
            </div>
            <div class="top-right-block">
                
                  @if (Auth::check())
                  
                   <div class="menu">
                    <div class="login">
                        <span>{{ Auth::user()->name}}</span> 
                        <img src="img/ava.jpg">
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

        <div class="main-header clearfix">
            <div class="wrap clearfix">
                <div class="logo">
                    <a href="{{url('/') }}"><img src="img/logo.jpg"></a>
                </div>
                <div class="contacts">
                    <div class="email">admin@prorab-service.ru</div>
                    <div class="phone">+++++++++79880000000</div>
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

        </div>

        <div class="main-slider">
            <h3>слайдер</h3>
        </div>

        <div class="main-reklama">
            Возможность установить контекстную рекламу
        </div>

        <div class="main-categories">
            <div class="row-block">
                <div class="category">
                    <a href="{{route('masters')}}">
                        <img class="" src="img/category.jpg">
                        <span>Мастера</span>
                    </a>
                </div>
                <div class="category">
                    <a href="">
                        <img class="" src="img/category.jpg">
                        <span>Галерея</span>
                    </a>
                </div>
                <div class="category">
                    <a href="">
                        <img class="" src="img/category.jpg">
                        <span>Стройматериалы</span>
                    </a>
                </div>
                <div class="category">
                    <a href="">
                        <img class="" src="img/category.jpg">
                        <span>Инструменты</span>
                    </a>
                </div>
            </div>
            <div class="row-block row-block-hidden hidden">
                <div class="category">
                    <a href="">
                        <img class="" src="img/category.jpg">

                    </a>
                </div>
                <div class="category">
                    <a href="">
                        <img class="" src="img/category.jpg">

                    </a>
                </div>
                <div class="category">
                    <a href="">
                        <img class="" src="img/category.jpg">

                    </a>
                </div>
                <div class="category">
                    <a href="">
                        <img class="" src="img/category.jpg">

                    </a>
                </div>
            </div>

            <div class="open-category">
                <span class="ico-category" data-ico-id="1"></span>
            </div>
        </div>

        <div class="construction-stages">
            <h2>Основные этапы стротельства</h2>

            <div class="stages"></div>
            <div class="stages"></div>
            <div class="stages"></div>
            <div class="stages"></div>
            <div class="stages"></div>
        </div>

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