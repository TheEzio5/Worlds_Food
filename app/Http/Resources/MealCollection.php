<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\MealResource;

class MealCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'meta'  => [
                'currentPage'   => $this->currentPage(),
                'totalItems'    => $this->total(),
                'itemsPerPage'  => $this->perPage(),
                'totalPages'    => $this->lastPage()
            ],
            'data'  => MealResource::collection($this->items()),
            'links' => [
                'first' => $this->url(1),
                'last'  => $this->url($this->lastPage()),
                'prev'  => $this->previousPageUrl(),
                'next'  => $this->nextPageUrl(),
                'self'  => $this->url($this->currentPage())
            ]
        ];
    }
}
