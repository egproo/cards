<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property integer $id
 * @property integer $card_id
 * @property string $name
 * @property float $price
 * @property float $price3
 * @property float $price3
 * @property string $image
 * @property string $created_at
 * @property string $updated_at
 * @property Cardserial[] $cardserials
 * @property Card $card
 */
class Cardvariant extends Pivot
{
    /**
     * @var array
     */
    protected $fillable = ['card_id', 'name_ar','name_en', 'price','price2','price3', 'image_ar','image_en', 'created_at', 'updated_at'];
    protected $table = 'cardvariants';
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cardserials()
    {
        return $this->hasMany('App\Models\Cardserial');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function card()
    {
        return $this->belongsTo('App\Models\Card');
    }
}
