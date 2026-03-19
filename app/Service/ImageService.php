<?php

namespace App\Service;

use App\Contracts\IImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageService implements IImageService
{
    public function UploadImage(Request $request, string $key = "image")
    {
        if ($request->hasFile($key)) {
            /*
             * 300 на 300
             * Водяной знак - метку Shop в правом нижнем углу
             */


            /// TODO: Neuro slop
            $image = $request->file($key);
            $imageInfo = getimagesize($request->file($key));
            $width = $imageInfo[0];
            $height = $imageInfo[1];
            $mime = $imageInfo['mime'];
            switch ($mime) {
                case 'image/jpeg' || 'image/jpg':
                    $source = imagecreatefromjpeg($image);
                    break;
                case 'image/png':
                    $source = imagecreatefrompng($image);
                    break;
            }
            $newWidth = 300;
            $newHeight = 300;
            $resized = imagecreatetruecolor($newWidth, $newHeight);
            if ($mime == "image/png") {
                imagealphablending($resized, false);
                imagesavealpha($resized, true);
                $transparent = imagecolorallocatealpha($resized, 255, 255, 255, 127);
            }
            imagecopyresampled(
                $resized, $source,
                0, 0, 0, 0,
                $newWidth, $newHeight,
                $width, $height
            );

            imagedestroy($source);
            imagedestroy($resized);
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->putFile("test/$filename", $resized);

        }

        return null;
    }
}
