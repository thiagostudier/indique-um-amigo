<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class IndicationCollection extends ResourceCollection
{

    public function toArray($request)
    {
        return [
            'count' => count($this->collection),
            'data' => $this->collection,
        ];
    }
}
