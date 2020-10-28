<?php


namespace App\Repositories;


use Intervention\Image\Facades\Image;

class ImageResizeRepository implements ImageResizeRepositoryInterface
{

    public function resizing($thumbnailImage,$thumbnailPath,$originalPath,$originalImage,$size){

        $thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
        //TODO burası dinamik olacak dropdown menuden gelene göre, validation yazılacak eğer menuden birşey seçmemiş olursa diye
        $data = getimagesize($originalImage);
        $width = $data[0];
        $height = $data[1];

        if ($size=='square image'){
            if ($width>$height){
                $height=$width;
            }elseif ($width<$height){
                $width=$height;
            }
        }
        elseif ($size=='small image (256x256)'){
            $width=256;
            $height=256;
        }
        elseif ($size=='all'){


        }

        $canvas = Image::canvas($width, $height,'#fff');
        $thumbnailImage->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $canvas->insert($thumbnailImage, 'center');
        $canvas->save($thumbnailPath.time().$originalImage->getClientOriginalName());
        return $canvas;
    }


}
