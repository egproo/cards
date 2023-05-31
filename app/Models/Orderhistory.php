<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $order_id
 * @property string $status
 * @property string $statusby
 * @property string $created_at
 * @property string $updated_at
 */
class Orderhistory extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'orderhistory';

    /**
     * @var array
     */
    protected $fillable = ['order_id', 'status', 'statusby', 'created_at', 'updated_at'];
}
