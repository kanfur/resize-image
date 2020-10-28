<?php


namespace App\Repositories;


use App\Models\Http\Status;
use Illuminate\Support\Facades\Storage;

class ImageUploadRepository implements ImageUploadRepositoryInterface
{

    public function uploading($imageName,$image){

        Storage::disk('s3')->put('images/resizedBase64/' . $imageName, $image, 'public');

        return response()->json(['status' => 'ok'], Status::CODE["Success"]);
    }
}
