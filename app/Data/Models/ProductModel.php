<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App\Data\Models
 */
class ProductModel extends Model
{
    protected $table = "products";

    protected $fillable = [];

    protected $hidden = [];

    protected $casts = [];

    protected $visible = ['sku', 'name', 'category', 'price', 'price_object'];

    protected $appends = ['price_object'];

    protected $with = [];

    public function getPriceObjectAttribute()
    {
        $discount = null;
        if ($this->category == 'insurance')
            $discount = 0.3;
        elseif ($this->sku == '000003')
            $discount = 0.15;

        return [
            'original'            => $this->price,
            'final'               => $discount ? $this->price * $discount : $this->price,
            'discount_percentage' => $discount ? $discount * 100: null,
            'currency'            => 'EUR'
        ];

    }
}
