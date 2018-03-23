<?php

namespace App;

use App\Seller;
use App\Category;
use App\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
	const PRODUCT_AVAILABLE = 'YES';
	const PRODUCT_NO_AVAILABLE = 'NO';

    protected $fillable = [
    	'name',
    	'description',
    	'quantity',
    	'status',
    	'image',
    	'seller_id'
    ];

    public function isAvailable()
    {
    	return $this->status == Product::PRODUCT_AVAILABLE;
    }

    public function categories()
    {
    	return $this->belongsToMany( Category::class );
    }

    public function seller()
    {
    	return $this->belongsTo( Seller::class );
    }

    public function transactions()
    {
    	return $this->hasMany( Transaction::class );
    }
}
