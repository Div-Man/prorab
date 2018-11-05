<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryLetter extends Model
{
     public function masters()
    {
        return $this->belongsToMany(Master::class);
    }
    
   
}
