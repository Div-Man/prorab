<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Gallery;
use Illuminate\Support\Facades\Auth;

use App\CategoryLetter;
use App\Master;
use App\GalleryMaster;

use Illuminate\Support\Facades\DB;
use App\User;

use App\City;
use App\Country;
use App\Region;

//use Illuminate\Support\Facades\Input;
//use Illuminate\Pagination\LengthAwarePaginator;




class GalleryController extends Controller
{
    private $gallery;
    
    public function __construct(Gallery $gallery)
    {
        $this->gallery = $gallery;
    }
    public function index()
    {
        $userId = Auth::id();
        $myImages = Gallery::where('user_id', $userId)->get();
        return view('gallery.index', [
            'myImages' => $myImages
        ]);
    }
    
    public function store(Request $request)
 {
         $rules = [
            'image' => 'required|image|mimes:jpg,jpeg,png',
            'title' => 'min:5'
        ];
        $messages = [
            'title.min' => 'Зоголовок должнен содержать минимум :min символов.',
            'image.required' => 'Изображение загружать обязательно.',
            'image.image' => 'Вы загрузили не изображение.',
            'image.mimes' => 'Допустимые форматы: jpg, jpeg, png.',
        ];

        Validator::make(
                $request->all(), $rules, $messages
        )->validate();
   
        $image = $request->file('image');
        $title = $request->title;
        $fileName = $image->store('uploads/gallery');
        $this->gallery->image = $fileName;
        $this->gallery->title = $title;

        
        $this->gallery->user_id = Auth::id();
        $this->gallery->save();
        return redirect('/myprofile/gallery');
    }
    
    public function edit($id)
    {
        //надо загрузить свои категории для галереи
        
         $userId = Auth::user()->id;

         $myCategories = User::with("masters")->where('id', $userId)->get();
         

         $categoriesForImage = GalleryMaster::where('gallery_id', $id)->get();
  
         
         $myImage = $this->gallery::find($id);
         return view('gallery.edit', [
             'imageInView' => $myImage,
             'categories' => $myCategories,
             'categoriesForImage' =>  $categoriesForImage
             ]);
    }
    
    public function update(Request $request, $id)
    {
       
        $rules = [
            'title' => 'min:5'
        ];
        $messages = [
            'title.min' => 'Зоголовок должнен содержать минимум :min символов.',
        ];
        
         Validator::make(
                $request->all(), $rules, $messages
        )->validate();
   
         
        $title = $request->title;
         $imgOld = $this->gallery::find($id);
        
        //Назвать метод update нелья, так как будет 
        //конфликт с ларавеловскими готовыми методами. 
       
        $imgOld->updateImage($request->image, $imgOld);
        $imgOld->title = $title;
        $imgOld->save();
        
         return redirect('/myprofile/gallery');
    }
    
    public function delete($id) {
       
      $currentImage = $this->gallery::find($id);
      $this->gallery->deleteImage($currentImage);
    
      return redirect('/myprofile/gallery');
    }
    
    public function showMyPhoto()
    {
        $userId = Auth::id();
        $myImages = Gallery::where('user_id', $userId)->get();
       $myImages->each(function ($item, $key) {
              echo '<a href="/'. $item->image .'" title="'.$item->title.'" data-gallery=""><img src="/'. $item->image .'" width="100"></a>';    
        });
    }
    
    public function showMasterPhoto($id)
    {
        $images = Gallery::where('user_id', $id)->get();
        $images->each(function ($item, $key) {
             echo '<a href="/'. $item->image .'" title="'.$item->title.'" data-gallery=""><img src="/'. $item->image .'" width="100"></a>';    
        });
    }
    
    public function galleryCategory(Request $request)
    {
        
        $userCity = Auth::user()->user_city_id;
        $userRegion = Auth::user()->user_region_id;
        $userCountry = Auth::user()->user_country_id;
        
        
        $categoryId = $request->idSpec;
        $imageId = $request->idImage;
        
         $category = GalleryMaster::where('master_id',  $categoryId)->where('gallery_id', $imageId)->get();
   
        $relation = Master::find($categoryId);
        
         if($category->isEmpty()) {
           $relation->images()->attach($imageId); 
           
            return ;
        }
           $relation->images()->detach($imageId);
           return ;
       
    }
    
    public function showGallery(Request $request)
    {
      
          if(
            !empty($request->cookie('idCountry')) &&
            !empty($request->cookie('idRegion')) &&
            !empty($request->cookie('cityId')) 
          ) {
             $cityId = $request->cookie('cityId');  
             $cityName = City::where('id', $cityId)->first()->name;
             $chooiseId = 'city_id';
        }
        
        elseif(
            !empty($request->cookie('idCountry')) &&
            !empty($request->cookie('idRegion'))
                
          ) {
             $cityId = $request->cookie('idRegion');
             $cityName = Region::where('region_id', $cityId)->first()->name;
             $chooiseId = 'region_id';
        }
        
        elseif(
            !empty($request->cookie('idCountry'))
                
          ) {
             $cityId = $request->cookie('idCountry');
             $cityName = Country::where('country_id', $cityId)->first()->name;
             $chooiseId = 'country_id';
        }
        
        
        else {
            $chooiseId = 'city_id';
            $cityId = 4400;
            $cityName = 'Москва';
        }
        
       
        
        
        
        $country = Country::all();
        
         $alfabet = CategoryLetter::with("masters")->get();
        
         
         $mastersInCity = DB::select('SELECT
        master_user.master_id,
        masters.specialization,
        category_letter_master.category_letter_id AS master_letter,
gallery_master.gallery_id, 
galleries.image


        FROM master_user

        LEFT JOIN masters ON master_user.master_id = masters.id
        LEFT JOIN category_letter_master ON category_letter_master.master_id = master_user.master_id 
	LEFT JOIN gallery_master ON gallery_master.master_id = masters.id 
	LEFT JOIN galleries ON galleries.id = gallery_master.gallery_id

        GROUP BY master_user.master_id, master_letter, gallery_master.id ORDER BY gallery_master.id DESC
    ');
           
         
    $collection = $alfabet->each(function ($item, $key) use(&$mastersInCity) {
       
        foreach($item->masters as $master) {
            
             foreach($mastersInCity as $image) {

                 if($master->id == $image->master_id && !empty($image->gallery_id)) {
                    
                     array_add($master, 'img', $image->image);
                     //dump($image);
                     //dump($master);
                  }
                 
             }
            
        }
        
        });
        
         $breadcrumbs = 'Главная / <span class="green"> Галерея<span>';
        
          return view('gallery/main', [
            'breadcrumbs' => $breadcrumbs,
            'categoryMasters' => $collection,
            'countryAll' => $country,
              'myLocation' => $cityName //потом это надо объединить

        ]);
         
    }
    
    public function showAllImageForCategory($id, Request $request)
    {
        
          if(
            !empty($request->cookie('idCountry')) &&
            !empty($request->cookie('idRegion')) &&
            !empty($request->cookie('cityId')) 
          ) {
             $cityId = $request->cookie('cityId');  
             $cityName = City::where('id', $cityId)->first()->name;
             $chooiseId = 'city_id';
        }
        
        elseif(
            !empty($request->cookie('idCountry')) &&
            !empty($request->cookie('idRegion'))
                
          ) {
             $cityId = $request->cookie('idRegion');
             $cityName = Region::where('region_id', $cityId)->first()->name;
             $chooiseId = 'region_id';
        }
        
        elseif(
            !empty($request->cookie('idCountry'))
                
          ) {
             $cityId = $request->cookie('idCountry');
             $cityName = Country::where('country_id', $cityId)->first()->name;
             $chooiseId = 'country_id';
        }
        
        
        else {
            $chooiseId = 'city_id';
            $cityId = 4400;
            $cityName = 'Москва';
        }
         $country = Country::all();
        
        $category = Master::find($id);
        
        $images = DB::table('galleries')
        ->leftJoin('gallery_master', 'gallery_master.gallery_id', '=', 'galleries.id')
        ->leftJoin('users', 'users.id', '=', 'galleries.user_id')
        ->select('galleries.user_id', 'galleries.image', 'galleries.title', 'users.name')
        ->where('gallery_master.master_id', '=', $id)
        ->orderBy('galleries.id', 'desc')
        ->paginate(2);
        
        $breadcrumbs = 'Главная / Галерея / <span class="green">' . $category->specialization . '<span>';
        
        
        //dd($images->all());
        
        return view('gallery/list-image', [
            'breadcrumbs' => $breadcrumbs,
            'images' => $images,
            'countryAll' => $country,
            'category' =>  $category->specialization,
             'myLocation' => $cityName 

        ]);
        
        //dd($images->links());
    }
    
  
}
