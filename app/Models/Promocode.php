<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $currency_id
 * @property integer $region_id
 * @property string $promocode
 * @property string $promotype
 * @property float $promovalue
 * @property boolean $active
 * @property string $validfrom
 * @property string $validto
 * @property string $created_at
 * @property string $updated_at
 * @property Order[] $orders
 * @property Currency $currency
 * @property Region $region
 */
class Promocode extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['currency_id', 'region_id', 'promocode', 'promotype', 'promovalue', 'active', 'validfrom', 'validto', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo('App\Models\Currency');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }
}
