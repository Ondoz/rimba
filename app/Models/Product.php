<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'regular_price',
        'discount_type',
        'discount',
        'unit_type',
        'unit',
        'stock',
        'description',
        'product_image'
    ];

    protected $appends = [
        'after_price_regular',
        'after_price_regular_format',
        'discount_format'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($q) {
            $q->uuid = Str::uuid();
        });
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function transaction_item()
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function getImageAttribute()
    {
        if ($this->attributes['product_image'] != null) {
            $path = Storage::url('product/' . $this->attributes['product_image']);
            return $path;
        } else {
            return 'https://ui-avatars.com/api/?name=' . urlencode($this->attributes['name']);
        }
    }

    public function getDiscountFormatAttribute()
    {
        if ($this->attributes['discount_type'] != null) {
            if ($this->attributes['discount_type'] === 'percentage') {
                return $this->attributes['discount'] . ' %';
            } else {
                return 'Rp ' . number_format($this->attributes['discount']);
            }
        } else {
            return null;
        }
    }

    public function getUnitFormatAttribute()
    {
        if ($this->attributes['unit_type'] != null) {
            if ($this->attributes['unit_type'] === 'kg') {
                return $this->attributes['unit'] . ' Kg';
            } else {
                return $this->attributes['unit'] . ' Pcs';
            }
        } else {
            return null;
        }
    }

    public function getAfterPriceRegularAttribute()
    {
        if ($this->attributes['discount_type'] != null) {
            if ($this->attributes['discount_type'] === 'percentage') {
                $calc = round($this->attributes['regular_price'] * (1 - $this->attributes['discount'] / 100), 2);
            } else {
                $calc = $this->attributes['regular_price'] - $this->attributes['discount'];
            }
            return $calc;
        } else {
            return $this->attributes['regular_price'];
        }
    }

    public function getAfterPriceRegularFormatAttribute()
    {
        return 'Rp ' . number_format($this->getAfterPriceRegularAttribute());
    }
}
