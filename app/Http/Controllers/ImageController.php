<?php

namespace App\Http\Controllers;

use App\Services\ImageResizeService;
use App\Services\ImageUploadService;
use http\Exception;
use Illuminate\Http\Request;
use App\Models\ImageModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    protected $imageResizeService;
    protected $imageUploadService;
    public function __construct(ImageResizeService $imageResizeService,ImageUploadService $imageUploadService)
    {
        $this->imageResizeService = $imageResizeService;
        $this->imageUploadService = $imageUploadService;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $image = ImageModel::latest()->first();
        return view('createimage', compact('image'));

    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'filename' => 'image|required|mimes:jpeg,png,jpg,gif,svg'

        ]);
        if (!$request->sizes){
            dd('fffd');
        }
        $size=$request->sizes;

        try {
            $originalImage= $request->file('filename');

            $resizedImage=$this->imageResizeService->resizeImage($originalImage,$size);

            $imagemodel= new ImageModel();
            $imagemodel->filename=time().$originalImage->getClientOriginalName();
            $imagemodel->save();

            $this->imageUploadService->uploadImage($originalImage,$resizedImage);

        }catch (\Exception $e){
            return $this->returnJsonException($e);
        }

        return back()->with('success', 'Your images have been successfully uploaded to S3 as base64 !');

    }

}
