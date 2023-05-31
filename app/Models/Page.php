<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $slug
 * @property string $image
 * @property string $created_at
 * @property string $updated_at
 */
class Page extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title_en', 'content_en', 'slug_en', 'image_en',
        'title_ar', 'content_ar', 'slug_ar', 'image_ar',
        'created_at', 'updated_at'];
}
