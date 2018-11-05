<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryMaster extends Model
{
    
     protected $table = 'gallery_master';
    
      public function images()
      {
         return $this->belongsToMany(Master::class);
      }
}
