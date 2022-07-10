<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait HandleImage
{
    protected $path = 'product_images/';

    protected $imageDefault = 'default.png';

    public function verifyImage($request)
    {
        return $request->hasFile('image');
    }

    public function saveImage($request)
    {
        if ($this->verifyImage($request)) {
            $file = $request->file('image');
            $name = time() . '.' . $file->getClientOriginalExtension();
            Image::make($file)->resize(300, 400)
                ->save($this->path . $name);
            return $name;
        }
        return $this->imageDefault;
    }

    public function updateImage($request, $currentImage)
    {
        if ($this->verifyImage($request)) {
            $this->deleteImage($currentImage);
            return $this->saveImage($request);
        }
        return $currentImage;
    }

    public function deleteImage($imageName)
    {
        $pathName = $this->path . $imageName;
        if (file_exists($pathName) && $imageName != $this->imageDefault && $imageName!=null ) {
            unlink($pathName);
        }
    }
}
