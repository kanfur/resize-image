<?php


namespace App\Repositories;


use Intervention\Image\Facades\Image;

class ImageResizeRepository implements ImageResizeRepositoryInterface
{

    public function resizing($thumbnailImage,$thumbnailPath,$originalPath,$originalImage){

        $thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
        //TODO burası dinamik olacak dropdown menuden gelene göre, validation yazılacak eğer menuden birşey seçmemiş olursa diye
        $canvas = Image::canvas(400, 400,'#fff');
        $thumbnailImage->resize(400, 400, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $canvas->insert($thumbnailImage, 'center');
        $canvas->save($thumbnailPath.time().$originalImage->getClientOriginalName());
        return $canvas;
    }

}
