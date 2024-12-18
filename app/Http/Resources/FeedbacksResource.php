<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FeedbacksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' =>$this->id,
            'feedback' =>$this->feedback,
            'rating'=>$this->rating,
            'voice' =>$this->voice->voice,
            'test_id' =>$this->voice->test_id,
            'created_at' =>$this->created_at,
        ];
    }
}
