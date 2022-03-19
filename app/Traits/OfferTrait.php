<?php
namespace App\Traits;

Trait OfferTrait{
     function saveImage($photo,$folder){
        //save photo in folder
        $file_extension =  $photo -> getClientoriginalExtension();
        $file_name = time().'.'.$file_extension;
        $path = $folder;
        $photo -> move($path,$file_name);

        return $file_name;
    }
}
