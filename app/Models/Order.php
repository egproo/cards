<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $promocode_id
 * @property float $total
 * @property string $note
 * @property string $currentstatus
 * @property string $editd_at
 * @property string $edit_by
 * @property string $created_at
 * @property string $updated_at
 * @property Cardreview[] $cardreviews
 * @property Promocode $promocode
 * @property User $user
 */
class Order extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'promocode_id', 'total', 'note', 'currentstatus', 'editd_at', 'edit_by', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cardreviews()
    {
        return $this->hasMany('App\Models\Cardreview');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function promocode()
    {
        return $this->belongsTo('App\Models\Promocode');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
