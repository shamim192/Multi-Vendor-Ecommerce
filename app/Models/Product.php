<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'slug',
        'thumb_image',
        'vendor_id',
        'category_id',
        'sub_category_id',
        'child_category_id',
        'brand_id',
        'qty',
        'short_description',
        'long_description',
        'video_link',
        'sku',
        'price',
        'offer_price',
        'offer_start_price',
        'offer_end_price',
        'is_top',
        'is_best',
        'is_featured',
        'status',
        'is_approved',
        'seo_title',
        'seo_description',
    ];
}