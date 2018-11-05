<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Master;
use App\CategoryLetter;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Country;
use App\Region;
use App\City;
use Illuminate\Support\Facades\DB;
use App\MasterUser;
use Carbon\Carbon;


class MasterController extends Controller
{
    /*
     * 1 - по стажу, по убыванию
     * 2 - по стажу, по возрастанию
     * 3 - по рейтингу, по убыванию
     * 4 - по рейтингу, по по возрастанию
     */
      const SORT_EXPERIENCE_TOP = ['created_at', 'asc']; 
      const SORT_EXPERIENCE_BOTTOM = ['created_at', 'desc']; //
      const SORT_RATING_TOP = ['rating', 'desc']; //
      const SORT_RATING_BOTTOM = ['rating', 'asc'];
      
      
      
      
    public function index(Request $request)
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
        COUNT(*) AS count_in_city

        FROM master_user

        LEFT JOIN masters ON master_user.master_id = masters.id
        LEFT JOIN category_letter_master ON category_letter_master.master_id = master_user.master_id 

        WHERE ' . $chooiseId . ' = ' . $cityId . ' GROUP 

        BY master_user.master_id, master_letter');
        
        
        
        $collection = $alfabet->each(function ($item, $key) use(&$mastersInCity) {
        $idLetter = $item->id;
          
          foreach($mastersInCity as $master){
              if($idLetter == $master->master_letter) {    
                  foreach($item->masters as $specialization) {
                      if($master->master_id == $specialization->id) {
                        array_add($specialization, 'countMaster', $master->count_in_city);
                       }
                  } 
              } 
          }
        });
        
      
        
        
       $collection->map(function ($item, $key) {
           $count = 0;
           foreach($item->masters as $category) {
               $count = $count + $category->countMaster;   
           }
           array_add($item, 'countAllMaster', $count);

      });
      
      
      $breadcrumbs = 'Главная / Мастера';
       
        return view('masters/index', [
            'breadcrumbs' => $breadcrumbs,
            'categoryMasters' => $collection,
            'countryAll' => $country,
            'cityName' => $cityName,
            'myLocation' => $cityName //потом это надо объединить
        ]);
    }
    
    public function masterList($id, $sort = null, Request $request) {
     
     switch ($sort) {
         case 1:
           $sortBy = self::SORT_EXPERIENCE_TOP;
            break;
        case 2:
           $sortBy = self::SORT_EXPERIENCE_BOTTOM;
            break;
        case 3:
           $sortBy = self::SORT_RATING_TOP;
            break;
         case 4:
           $sortBy = self::SORT_RATING_BOTTOM;
            break;
        default:
            $sortBy = self::SORT_RATING_TOP;
    }
        
    
    
    
    
     if(
            !empty($request->cookie('idCountry')) &&
            !empty($request->cookie('idRegion')) &&
            !empty($request->cookie('cityId')) 
          ) {
             $cityId = $request->cookie('cityId');  
             $cityName = City::where('id', $cityId)->first()->name;
             $chooiseId = 'user_city_id';
        }
        
        elseif(
            !empty($request->cookie('idCountry')) &&
            !empty($request->cookie(''))
                
          ) {
             $cityId = $request->cookie('idRegion');
              $cityName = Region::where('region_id', $cityId)->first()->name;
             $chooiseId = 'user_region_id';
        }
        
        elseif(
            !empty($request->cookie('idCountry'))
                
          ) {
             $cityId = $request->cookie('idCountry');
              $cityName = Country::where('country_id', $cityId)->first()->name;
             $chooiseId = 'user_country_id';
        }
        
        
        else {
            $chooiseId = 'user_city_id';
            $cityId = 4400;
        }
    
    
   
        $country = Country::all();
        $category = Master::find($id);
        $masters = Master::find($id)
                ->users()->with('city')
                ->with('specialization')
                ->orderBy($sortBy[0], $sortBy[1])
                ->where($chooiseId, $cityId)->get();
        
        
        $breadcrumbs = 'Главная / Мастера / <span class="green">' . $category->specialization . '<span>';

        return view('masters/masters-list', [
            'breadcrumbs' => $breadcrumbs,
            'masters' => $masters,
            'category' => $category,
            'countryAll' => $country,
            'myLocation' => $cityName
        ]);
    }

    public function masterProfile($id, Request $request)
    {
        
        
          if(
            !empty($request->cookie('idCountry')) &&
            !empty($request->cookie('idRegion')) &&
            !empty($request->cookie('cityId')) 
          ) {
             $cityId = $request->cookie('cityId');  
             $cityName = City::where('id', $cityId)->first()->name;
             $chooiseId = 'user_city_id';
        }
        
        elseif(
            !empty($request->cookie('idCountry')) &&
            !empty($request->cookie(''))
                
          ) {
             $cityId = $request->cookie('idRegion');
              $cityName = Region::where('region_id', $cityId)->first()->name;
             $chooiseId = 'user_region_id';
        }
        
        elseif(
            !empty($request->cookie('idCountry'))
                
          ) {
             $cityId = $request->cookie('idCountry');
              $cityName = Country::where('country_id', $cityId)->first()->name;
             $chooiseId = 'user_country_id';
        }
        
        
        else {
            $chooiseId = 'user_city_id';
            $cityId = 4400;
            $cityName = 'Москва';
        }
    
    
   
        $country = Country::all();
        

        if(!Auth::check()) {
            $userAuth = 0;
        }
        else {
             $userAuth = Auth::user()->id;
        }
        
        $fromStringToNumber = (int)$id;
        
        
        if($fromStringToNumber == 0){
             $routeName = User::with('city')->with("masters")->where('route', $id)->get();
             
             if($routeName->isNotEmpty()) {
                 $user = $routeName->first();
             }
             
             else {
                 abort(404);
             }   
        }
        
        
         else {
                $user = User::with('city')->with("masters")->where('id', $id)->get()->first();
            }
            
        $experience = Carbon::now()->diffInYears($user->created_at);
        
        
        
          $myVote = DB::table('user_rating')
                     ->where('master_id', '=', $id)
                     ->where('user_id', '=', $userAuth)
                     ->get()->first();
          
          if($myVote != null) {
              $myVote = $myVote->valuation;
          }
        
        
         return view('masters/master-profile', [
            'user' => $user,
              'countryAll' => $country,
            'myVote' => $myVote,
            'experience' => $experience
        ]);
    }
    
    
  
    public function myprofile()
    {
        
        $userId = Auth::user()->id;

        $user = User::with('city')->where('id', $userId)->get()[0];
        $cityId = $user->city[0]->id;
        $city = $user->city[0]->name;



        $myCategories = User::with("masters")->where('id', $userId)->get();
       
       
        
        $country = Country::all();
        $categories = CategoryLetter::with("masters")->get();


        return view('profile/index', [
            'myInfo' => $user,
            'countryAll' => $country,
            'city' => $city,
            'categories' => $myCategories,
            'allCategory' => $categories,
            'cityId' => $cityId
        ]);
    }
    
    public function showRegion($id)
    {
        $regions = Region::where('country_id', $id)->get()->toArray();

        echo '<select onchange="showRegions(this.value)">';

        foreach($regions as $reg){

           echo '<option value='. $reg['region_id'].'|'.$reg['name'].'>'.$reg['name']
                   .'</option>';
        }   
         echo '</select>';
         
    }
    
     public function showCity($id)
    {
         
        $cities = City::where('region_id', $id)->get()->toArray();
        
         echo '<select class="all-cities" onchange="showCities(this.value)">';
        
        foreach($cities as $city){

            echo '<option value='. $city['id'].'|'.$city['name'].'>'.$city['name']
                   .'</option>';
            
        }  
        
         echo '</select>';
         
    }
    
    public function profileUpdate(Request $request, $id) {
        
        $regionId = City::where('id', $request->myCityId)->get()->first()->region_id;
        $countryId = Region::where('region_id', $regionId)->get()->first()->country_id;
        
       
        $user = User::with('city')->where('id', $id)->get()[0];
       
        $relation = User::find($id);
        $relation->city()->detach($user->city[0]->id);
        $relation->city()->attach($request->myCityId);
        
        $user->description = $request->description;
        $user->user_city_id = $request->myCityId;
        $user->user_region_id = $regionId;
        $user->user_country_id = $countryId;
        $user->social = $request->linkSocial;
        
        
        $user->number1 = $request->number1;
        $user->number2 = $request->number2;
        $user->number3 = $request->number3;
        
        
        
         DB::table('master_user')->where('user_id', $id) ->update([
             'city_id' => $request->myCityId,
             'country_id' => $countryId,
             'region_id' => $regionId,
                 ]); 
        
        $user->save();
        
        return back();
    }

    public function updateSpecialization(Request $request)
    {

        $categoryId = $request->id;
        $userId = Auth::user()->id; 
            
        $userCity = Auth::user()->user_city_id;
        $userRegion = Auth::user()->user_region_id;
        $userCountry = Auth::user()->user_country_id;
        
        
        $relation = Master::find($categoryId);
        $category = MasterUser::where('master_id',  $categoryId)->where('user_id', $userId)->get();
        

       if($category->isEmpty()) {
           $relation->users()->attach($userId, [
               'city_id' => $userCity,
               'region_id' => $userRegion,
               'country_id' => $userCountry
                   ]);
            return ;
        }
           $relation->users()->detach($userId);
           return ;
    }
    
    public function updateOutwards(Request $request)
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);
        $user->outwards  = $request->id;
        $user->save();
        return;
    }
    
    
   
    
    public function addRating(Request $request)
    {   
        
      
        
        if(!Auth::check()) {
            return 'Авторизируйтесь';
        }
        
        
        
        $userAuth = Auth::user()->id;
        
        if($request->userId == $userAuth) {
            return 'накрутка';
        }
        
       
        
        //сначала узнаём, голосовал ли уже пользователь
        //этот пост
        
         $users = DB::table('user_rating')
                     ->where('master_id', '=', $request->userId)
                     ->where('user_id', '=', $userAuth)
                     ->groupBy('id')
                     ->get();
        
         
        
         
         //если голосовал, то обновляем его новый голос
         if($users->count() == 1) { 
             $this->updateRating($users[0]->id, $request);
         }
         
         
             
         // иначе первый раз голосуем
         else {
            
             
              $id = DB::table('user_rating')->insertGetId(
                [
                    'user_id' => $userAuth,
                    'master_id' => $request->userId, 
                    'valuation' =>  $request->rating
                ]);
             
              
               $this->updateRating($id, $request);
              
         }    
    }
    
    public function updateRating($id, $data)
    {
       
        //обновление рейтинга, для пользователя
          DB::table('user_rating')
            ->where('id', $id)
            ->update(['valuation' => $data->rating]);

       
         $collection =  DB::table('user_rating')
               ->where('master_id', '=', $data->userId)
               ->select(DB::raw('Round(AVG(valuation), 1) as average'))->get();

        $avg = $collection->first()->average;
       
         User::where('id', $data->userId) ->update(['rating' => $avg]);
        
    }
    
    
}
