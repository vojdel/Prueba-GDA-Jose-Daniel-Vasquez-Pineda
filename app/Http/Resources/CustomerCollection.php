<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CustomerCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }

    // get
    public function getCustomer(Request $request, string $id)
    {
        print_r($id);
        return response()->json(['message' => 'Hello World!']);
    }

    // post

    // delete
}
