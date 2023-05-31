<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $invoice_id
 * @property string $card_id
 * @property string $cardvariant_id
 * @property integer $qty
 * @property float $price
 * @property float $total
 * @property string $created_at
 * @property string $updated_at
 * @property Invoice $invoice
 */
class Invoicecard extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['invoice_id', 'card_id', 'cardvariant_id', 'qty', 'price', 'total', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invoice()
    {
        return $this->belongsTo('App\Models\Invoice');
    }
}
