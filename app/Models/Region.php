<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $currency_id
 * @property string $image
 * @property string $name
 * @property string $isocode
 * @property string $created_at
 * @property string $updated_at
 * @property Card[] $cards
 * @property Category[] $categories
 * @property Promocode[] $promocodes
 * @property Currency $currency
 * @property User[] $users
 */
class Region extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['currency_id', 'name', 'isocode','image', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cards()
    {
        return $this->hasMany('App\Models\Card');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->hasMany('App\Models\Category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function promocodes()
    {
        return $this->hasMany('App\Models\Promocode');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo('App\Models\Currency');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
