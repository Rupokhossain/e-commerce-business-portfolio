<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BrandPartner extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'logo',
        'website_url',
        'specialty',
        'is_active',
        'sort_order',
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

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public function getLogoUrlAttribute(): ?string
    {
        if (! $this->logo) {
            return null;
        }

        if (str_starts_with($this->logo, 'http://') || str_starts_with($this->logo, 'https://')) {
            return $this->logo;
        }

        return asset(ltrim($this->logo, '/'));
    }
}