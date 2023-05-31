<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $cardvariant_id
 * @property string $serial
 * @property boolean $used
 * @property integer $invoicecard_id
 * @property string $created_at
 * @property string $updated_at
 * @property Cardvariant $cardvariant
 */
class Cardserial extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['cardvariant_id', 'serial', 'used', 'invoicecard_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cardvariant()
    {
        return $this->belongsTo('App\Models\Cardvariant');
    }
}
