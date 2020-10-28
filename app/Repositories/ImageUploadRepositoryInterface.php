<?php

namespace App\Repositories;

interface ImageUploadRepositoryInterface
{
    public function uploading($imageName, $image);
}
