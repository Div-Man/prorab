<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    public $timestamps = false;
    
    public function updateImage($image, $imgOld)
    {
        //если пользователь загрузил новую картинку, то заменить её
        //если нет, то оставить старую
         if($image) {
            Storage::delete($imgOld->image);
            $fileName = $image->store('uploads/gallery');
            
            $this->image = $fileName;
         }                
    }
    
    public function deleteImage($image)
    {    
      Storage::delete($image->image);
      $this->destroy($image->id);
    }
    
}
