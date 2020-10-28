<?php


namespace App\Services;


use App\Repositories\ImageResizeRepository;
use App\Repositories\ImageResizeRepositoryInterface;
use Intervention\Image\Facades\Image;

class ImageResizeService
{
    protected $imageResizeRepository;

    public function __construct(ImageResizeRepositoryInterface $imageResizeRepository)
    {
        $this->imageResizeRepository=$imageResizeRepository;
    }

    public function resizeImage($originalImage,$size){

        $thumbnailImage = Image::make($originalImage);
        $thumbnailPath = public_path().'/thumbnail/';
        $originalPath = public_path().'/images/';

        return $this->imageResizeRepository->resizing($thumbnailImage,$thumbnailPath,$originalPath,$originalImage,$size);
    }


}
