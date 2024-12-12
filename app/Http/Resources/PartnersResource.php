<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PartnersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
                'id' => $this.id,
                'partner_name' => $this.partner_name,
                'partner_img' => $this.partner_img,
                'created_at' => $this.created_at,
        ];
    }
}
