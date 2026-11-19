<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'client_name',
        'industry',
        'location',
        'summary',
        'challenge_solution',
        'hardware_used',
        'results_metric',
        'image',
        'deployed_at',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'hardware_used' => 'array',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderByDesc('is_featured')->orderBy('sort_order')->orderByDesc('id');
    }

    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        return asset(ltrim($this->image, '/'));
    }

    public function getDescriptionAttribute(): ?string
    {
        return $this->summary;
    }

    public function getSolutionAttribute(): ?string
    {
        return $this->challenge_solution;
    }
}