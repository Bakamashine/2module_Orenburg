<?php

namespace App\Service;

use App\Contracts\IImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class ImageService implements IImageService
{

    function test(Request $request, string $path, string $key) {
        if ($request->hasFile($key)) {
            $image = $request->file($key);
            $variables = getimagesize($image);
            [$width, $height] = $variables;
            $mime_type = $variables['mime'];
            if ($mime_type == "image/jpeg" || $mime_type == "image/jpg") {
                $source = imagecreatefromjpeg($image->getRealPath());
            }
            $newWidth = 300;
            $newHeight= 300;
            ob_start();
            $resized = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($resized, $source, 0,0,0,0,$width, $height, $newWidth, $newHeight);
            $filename = "mtp-" . uniqid() . ".".$image->extension();
            $color = imagecolorallocate($resized, 255,255,255,255);
            imagettftext(
                $resized,
                25,
                0,
                200,200,
                $color,
                public_path(''),
                "sus",
            );
            $binary = ob_get_clean();
            Storage::disk('public')->put("sus/$filename", $binary);
        }
        return null;
    }

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

                $color = imagecolorallocate($source, 255,255,255);
                $text = "Shop";

                imagettftext(
                    $resized,
                    24,
                    0,
                    200,250,
                    $color,
                    public_path('fonts/Roboto_Condensed-Bold.ttf'),
                    $text,
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
