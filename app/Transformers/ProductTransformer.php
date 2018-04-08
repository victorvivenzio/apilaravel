<?php

namespace App\Transformers;

use App\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Product $product)
    {
        return [
            'identifier' => (int)$product->id,
            'title' => (string)$product->name,
            'details' => (string)$product->description,
            'availableQuantity' => (int)$product->quantity,
            'status' => (string)$product->status,
            'image' => url("img/{$product->status}"),
            'seller' => (int)$product->seller_id,
            'creationDate' => (string)$product->created_at,
            'modificationDate' => (string)$product->updated_at,
            'deleteDate' => isset($product->deleted_at) ? (string)$product->deleted_at : null,
        ];
    }
}
