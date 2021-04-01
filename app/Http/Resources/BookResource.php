<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "title" => $this->title, 
            "author_id" => $this->author_id,
            "author" => $this->author->name,
            "genres" => $this->genres,
            "publication_year" => $this->publication_year,
            "pages_nb" => $this->pages_nb,
            "description" => $this->description,
        ];
    }
}
