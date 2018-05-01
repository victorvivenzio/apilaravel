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
            'image' => url("img/{$product->image}"),
            'seller' => (int)$product->seller_id,
            'creationDate' => (string)$product->created_at,
            'modificationDate' => (string)$product->updated_at,
            'deleteDate' => isset($product->deleted_at) ? (string)$product->deleted_at : null,
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('products.show', $product->id),
                ],
                [
                    'rel' => 'product.buyers',
                    'href' => route('products.buyers.index', $product->id),
                ],
                [
                    'rel' => 'product.categories',
                    'href' => route('products.categories.index', $product->id),
                ],
                [
                    'rel' => 'product.transactions',
                    'href' => route('products.transactions.index', $product->id),
                ],
                [
                    'rel' => 'sellers',
                    'href' => route('sellers.show', $product->seller_id),
                ],
            ],
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'identifier' => 'id',
            'title' => 'name',
            'details' => 'description',
            'availableQuantity' => 'quantity',
            'status' => 'status',
            'image' => 'image',
            'seller' => 'seller_id',
            'creationDate' => 'created_at',
            'modificationDate' => 'updated_at',
            'deleteDate' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [
            'id' => 'identifier' ,
            'name' => 'title' ,
            'description' => 'details' ,
            'quantity' => 'availableQuantity' ,
            'status' => 'status' ,
            'image' => 'image' ,
            'seller_id' => 'seller' ,
            'created_at' => 'creationDate' ,
            'updated_at' => 'modificationDate' ,
            'deleted_at' => 'deleteDate' ,
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
