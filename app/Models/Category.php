<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'region_id',
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

        
}
