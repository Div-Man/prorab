<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    public function categories()
    {
        return $this->belongsToMany(CategoryLetter::class);
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
    public function images()
    {
         return $this->belongsToMany(Gallery::class);
    }
    
    

}
