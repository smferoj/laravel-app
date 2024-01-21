<?php

namespace App\Manager;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class ImageUploadManager{
 /**
  * 
  */

  final public static function uploadImage(string $name, int $width, int $height, string $path, string $file){
      $manager = new ImageManager(new Driver());
        $image_file_name = $name.'.webp';
        $manager->read($file)
        ->resize($width, $height)
        ->save(public_path($path.$image_file_name, 50, 'webp'));
        return $image_file_name;
    }

    final public static function deletePhoto($path, $img):void
    {
             $path= public_path($path).$img;
             if($img != '' && file_exists($path)){
                unlink($path);
             }
    }
}