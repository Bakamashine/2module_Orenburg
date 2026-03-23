<?php

namespace App\Service;

use App\Contracts\IImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageService implements IImageService
{
    /**
     * @throws \Exception UnsupportedMediaTypeHttpException
     */
    public function UploadImage(Request $request, string $path, string $key = "image"): ?string
    {
        if ($request->hasFile($key)) {
            /*
             * 300 на 300
             * Водяной знак - метку Shop в правом нижнем углу
             */

            if ($request->hasFile($key)) {
                $image = $request->file($key);

                $pathTmp = $image->getRealPath();
                $imageInfo = getimagesize($pathTmp);
                [$width, $height] = $imageInfo;
                $mime = $imageInfo['mime'];

                switch ($mime) {
                    case 'image/jpeg':
                    case 'image/jpg':
                        $source = imagecreatefromjpeg($pathTmp);
                        $extension = 'jpg';
                        break;

                    case 'image/png':
                        $source = imagecreatefrompng($pathTmp);
                        $extension = 'png';
                        break;

                    default:
                        throw new \Exception('Unsupported type');
                }

                $newWidth = 300;
                $newHeight = 300;

                $resized = imagecreatetruecolor($newWidth, $newHeight);

                if ($mime === 'image/png') {
                    imagealphablending($resized, false);
                    imagesavealpha($resized, true);
                    $transparent = imagecolorallocatealpha($resized, 0, 0, 0, 127);
                    imagefill($resized, 0, 0, $transparent);
                }

                imagecopyresampled(
                    $resized, $source,
                    0, 0, 0, 0,
                    $newWidth, $newHeight,
                    $width, $height
                );

                ob_start();

                if ($mime === 'image/png') {
                    imagepng($resized);
                } else {
                    imagejpeg($resized, null, 90);
                }

                $imageBinary = ob_get_clean();

                $filename = time() . '_' . uniqid() . '.' . $extension;
                $filePath = "$path/$filename";
                Storage::disk('public')->put($filePath, $imageBinary);

                imagedestroy($source);
                imagedestroy($resized);
                return $filePath;
            }
        }

        return null;
    }
}
