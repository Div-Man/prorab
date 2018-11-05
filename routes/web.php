<?php

use App\Country;

use Illuminate\Http\Request;
use App\City;
use App\Region;





/*
 * Список роутов для проверки
 * Что бы пользователи могли 
 * выбрать для себя ЧПУ
 * 
 * но пока не используется
 */

$routes = [
    'home',
    'masters',
    'myprofile',
    'outwards',
    'transport'
];


Route::get('/', function (Request $request) {
    $country = Country::all();
    
    
    if(
            !empty($request->cookie('idCountry')) &&
            !empty($request->cookie('idRegion')) &&
            !empty($request->cookie('cityId')) 
          ) {
             $cityId = $request->cookie('cityId');  
             $cityName = City::where('id', $cityId)->first()->name;
             
        }
        
        elseif(
            !empty($request->cookie('idCountry')) &&
            !empty($request->cookie('idRegion'))
                
          ) {
             $cityId = $request->cookie('idRegion');
             $cityName = Region::where('region_id', $cityId)->first()->name;
        }
        
        elseif(
            !empty($request->cookie('idCountry'))
                
          ) {
             $cityId = $request->cookie('idCountry');
             $cityName = Country::where('country_id', $cityId)->first()->name;
        }
        
        
        else {
            $cityName = 'Москва';
        }
    
    
   $breadcrumbs = 'Главная';
    
    return view('welcome', [
        'breadcrumbs' => $breadcrumbs,
        'countryAll' => $country,
        'myLocation' => $cityName
        ]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');







Route::get('/masters', 'MasterController@index')->name('masters');



Route::get('/masters-list/{d}/{sort?}', 'MasterController@masterList');
Route::get('/masters/profile/{d}', 'MasterController@masterProfile');
Route::get('/myprofile', 'MasterController@myprofile')->middleware('user')->name('myprofile');
Route::get('/region/{d}', 'MasterController@showRegion');
Route::get('/city/{d}', 'MasterController@showCity');

Route::put('/myprofile/update/{id}', 'MasterController@profileUpdate');

Route::post('/', 'MasterController@updateSpecialization');
Route::post('/galleryCategory', 'GalleryController@galleryCategory');
Route::get('/aaa', 'GalleryController@galleryCategory');




Route::post('/outwards', 'MasterController@updateOutwards');
//Route::post('/profile-save/myvizitka', 'MasterController@updateVizitka');


Route::get('myprofile/gallery', 'GalleryController@index')->middleware('user');
Route::post('/gallery/store', 'GalleryController@store');

Route::get('/myprofile/gallery/edit/{d}', 'GalleryController@edit');
Route::put('/myprofile/gallery/update/{id}', 'GalleryController@update');
Route::delete('/myprofile/gallery/delete/{id}', 'GalleryController@delete');

Route::get('/myprofile/my-gallery', 'GalleryController@showMyPhoto');
Route::get('/masters/gallery/{d}', 'GalleryController@showMasterPhoto');

Route::post('/masters/rating', 'MasterController@addRating');


////////////////////////////////////////////////////////////////

Route::get('/gallery', 'GalleryController@showGallery')->name('gallery');
Route::get('/gallery/show/{d}', 'GalleryController@showAllImageForCategory');

//Route::get('/{userProfile}', 'MasterController@masterProfile')->where('userProfile', '[A-Za-z0-9-]+');