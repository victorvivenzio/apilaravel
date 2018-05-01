<?php

namespace App\Http\Controllers\Product;

use App\Product;
use App\Transaction;
use App\Transformers\TransactionTransformer;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;

class ProductBuyerTransactionController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('transform.input:'. TransactionTransformer::class )->only(['store']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product, User $buyer)
    {

        $rules = [
            'quantity' => 'required|integer|min:1'
        ];

        $this->validate($request, $rules);

        if($buyer->id == $product->seller_id) {
            return $this->errorsResponse('Buyer and Seller cannot be the same', 409);
        }

        if (!$buyer->isVerified()) {
            return $this->errorsResponse('Buyer not verified', 409);
        }

        if (!$product->seller->isVerified()) {
            return $this->errorsResponse('Seller not verified', 409);
        }

        if ( !$product->isAvailable() ) {
            return $this->errorsResponse('Product not Available', 409);
        }

        if ( $product->quantity < $request->quantity ) {
            return $this->errorsResponse('Product not Available', 409);
        }

        return DB::transaction(
            function() use ($request, $product, $buyer) {
            $product->quantity -= $request->quantity;
            $product->save();

            $transaction = Transaction::create([
                'quantity' => $request->quantity,
                'buyer_id' => $buyer->id,
                'product_id' => $product->id
            ]);
            return $this->showOne($transaction);
        });
    }

}
