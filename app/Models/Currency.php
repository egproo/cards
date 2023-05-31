<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property string $symbol
 * @property boolean $default
 * @property float $value
 * @property boolean $status
 * @property string $created_at
 * @property string $updated_at
 * @property Currency $currency
 * @property Promocode[] $promocodes
 * @property Region[] $regions
 * @property User[] $users
 */
class Currency extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'code','symbol', 'default', 'value', 'status', 'created_at', 'updated_at'];
    public function canAccessFilament():bool{
        return true;
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
    public function promocodes()
    {
        return $this->hasMany('App\Models\Promocode');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function regions()
    {
        return $this->hasMany('App\Models\Region');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
