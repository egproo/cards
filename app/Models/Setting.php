<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $key
 * @property string $value
 * @property string $created_at
 * @property string $updated_at
 */
class Setting extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['key', 'value','notes', 'created_at', 'updated_at'];
}
