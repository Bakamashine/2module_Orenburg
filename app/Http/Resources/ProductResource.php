<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

/**
 * @property int id
 * @property string title
 * @property string description
 * @property int price
 * @property string image
 */
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'image_url' => Storage::disk('public')->url($this->image)
        ];
    }
}
