<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImageModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $originalImage= $request->file('filename');
        $thumbnailImage = Image::make($originalImage);
        $thumbnailPath = public_path().'/thumbnail/';
        $originalPath = public_path().'/images/';
        $originalName=$originalImage->getClientOriginalName();
        $originalExtension= $originalImage->getClientOriginalExtension();
        //$thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());

        //TODO burası dinamik olacak dropdown menuden gelene göre
        $canvas = Image::canvas(400, 400,'#fff');
        $thumbnailImage->resize(400, 400, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $canvas->insert($thumbnailImage, 'center');
       ///$canvas->save($thumbnailPath.time().$originalImage->getClientOriginalName());
        $imagemodel= new ImageModel();
        $imagemodel->filename=time().$originalImage->getClientOriginalName();
        $imagemodel->save();

        $image = base64_encode($canvas->encode($originalExtension, 75));
        $imageName = time().pathinfo($originalName, PATHINFO_FILENAME);;
        Storage::disk('s3')->put('images/resizedBase64/' . $imageName, $image, 'public');

        return back()->with('success', 'Your images has been successfully Upload');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
