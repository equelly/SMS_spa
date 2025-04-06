<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
    'number'=>$this->resource->mashine->number,
    'category'=>$this->resource->category->title,
    'id' => $this->resource->id,
    'content' => $this->resource->content,
    
];
    }
}
