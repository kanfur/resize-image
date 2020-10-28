<?php


namespace App\Services;

use App\Repositories\ImageUploadRepositoryInterface;

class ImageUploadService
{
    protected $imageUploadRepository;

    public function __construct(ImageUploadRepositoryInterface $imageUploadRepository)
    {
        $this->imageUploadRepository=$imageUploadRepository;
    }

    public function uploadImage($originalImage,$resizedImage){

        $originalExtension= $originalImage->getClientOriginalExtension();
        $originalName=$originalImage->getClientOriginalName();

        $image = base64_encode($resizedImage->encode($originalExtension, 75));
        $imageName = time().pathinfo($originalName, PATHINFO_FILENAME);

        return $this->imageUploadRepository->uploading($imageName,$image);

    }

}
