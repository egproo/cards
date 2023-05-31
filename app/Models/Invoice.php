<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $order_id
 * @property float $total
 * @property string $invoicenote
 * @property boolean $payed
 * @property string $payed_at
 * @property string $payed_by
 * @property string $created_at
 * @property string $updated_at
 * @property Invoicecard[] $invoicecards
 */
class Invoice extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['order_id', 'total', 'invoicenote', 'payed', 'payed_at', 'payed_by', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoicecards()
    {
        return $this->hasMany('App\Models\Invoicecard');
    }
}
