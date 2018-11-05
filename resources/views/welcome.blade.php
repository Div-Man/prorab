@extends('layouts.app')
@section('content')

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
            <a href="{{route('gallery')}}">
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

<script>
            var icoCategory = document.querySelector('.ico-category');
            var allCategories = document.querySelector('.row-block-hidden');

            icoCategory.addEventListener('click', function (e) {
                allCategories.classList.toggle('hidden');

                var icoId = e.target.dataset.icoId;

                if (icoId == '1') {
                    e.target.style.backgroundImage = 'url("img/close-category.jpg")';
                    e.target.dataset.icoId = 2
                }
                else {
                    e.target.dataset.icoId = 1
                    e.target.style.backgroundImage = 'url("img/open-category.jpg")';
                }

            });
        </script>

@endsection