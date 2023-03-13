<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return  [
            'id_result_option' => $this->id_result_option,
            'result_id' => $this->result_id,
            'question' => $this->question,
            'answer' => $this->answer,
            'ans_correct' => $this->ans_correct,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
