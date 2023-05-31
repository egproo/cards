<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $region_id
 * @property integer $category_id
 * @property string $name
 * @property string $fulldesc
 * @property string $desc
 * @property string $slug
 * @property string $image
 * @property string $created_at
 * @property string $updated_at
 * @property Cardreview[] $cardreviews
 * @property Category $category
 * @property Region $region
 * @property Cardvariant[] $cardvariants
 */
class Card extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['region_id', 'category_id', 
    'name_en',
    'fulldesc_en',
    'desc_en',
    'slug_en',
    'image_en',
    'name_ar',
    'fulldesc_ar',
    'desc_ar',
    'slug_ar',
    'image_ar',
     'created_at', 'updated_at'];

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
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cardvariants()
    {
        return $this->hasMany('App\Models\Cardvariant');
    }
    public function cardserials()
    {
        return $this->hasManyThrough(
            'App\Models\Cardserial',
            'App\Models\Cardvariant',
            'card_id',
            'cardvariant_id',
            'id');
    }   
}
