<?php

namespace App\Repositories;

interface ImageResizeRepositoryInterface
{
    public function resizing($thumbnailImage, $thumbnailPath, $originalPath, $originalImage,$size);
}
