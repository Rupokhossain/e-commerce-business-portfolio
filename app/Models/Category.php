<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'short_description',
        'image',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public function getImageUrlAttribute(): ?string
    {
        if (empty($this->image)) {
            return null;
        }

        $path = ltrim($this->image, '/');

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (str_starts_with($path, 'storage/')) {
            return asset($path);
        }

        if (str_starts_with($path, 'images/')) {
            return asset($path);
        }

        return asset('storage/' . $path);
    }
}
