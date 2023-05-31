<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $activity
 * @property string $note
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 */
class Log extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'activity', 'note','username', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
