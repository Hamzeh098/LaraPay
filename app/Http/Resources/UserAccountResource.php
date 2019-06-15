<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return
            [
                'account_id'    => $this->user_account_id,
                'user_id'       => $this->user_account_user_id,
                'account_title' => $this->user_account_title,
            ];
    }
}
