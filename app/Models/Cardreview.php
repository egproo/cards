<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $order_id
 * @property integer $user_id
 * @property integer $card_id
 * @property boolean $rate
 * @property string $reviewtxt
 * @property string $created_at
 * @property string $updated_at
 * @property Card $card
 * @property Order $order
 * @property User $user
 */
class Cardreview extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['order_id', 'user_id', 'card_id', 'rate', 'reviewtxt', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function card()
    {
        return $this->belongsTo('App\Models\Card');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
