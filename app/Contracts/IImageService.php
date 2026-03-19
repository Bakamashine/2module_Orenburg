<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface IImageService
{
    public function UploadImage(Request $request, string $key = "image");
}
