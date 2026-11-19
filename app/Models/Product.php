<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'brand',
        'brand_url',
        'model_number',
        'sku',
        'availability_status',
        'short_description',
        'description',
        'show_details_tab',
        'image',
        'gallery',
        'key_features',
        'specifications',
        'datasheet_url',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'show_details_tab' => 'boolean',
            'gallery' => 'array',
            'key_features' => 'array',
            'specifications' => 'array',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
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
        return $query->orderByDesc('is_featured')->orderBy('sort_order')->orderBy('name');
    }

    public function getImageUrlAttribute(): ?string
    {
        return self::resolveMediaUrl($this->image);
    }

    /**
     * @return array<int, string>
     */
    public function getGalleryUrlsAttribute(): array
    {
        $items = collect([$this->image])
            ->merge(is_array($this->gallery) ? $this->gallery : [])
            ->filter()
            ->unique()
            ->map(fn (string $path): ?string => self::resolveMediaUrl($path))
            ->filter()
            ->values();

        return $items->all();
    }

    public function getAvailabilityLabelAttribute(): string
    {
        return match ($this->availability_status) {
            'pre_order' => 'Pre-Order',
            'on_request' => 'On Request',
            default => 'In Stock',
        };
    }

    public function getAvailabilityClassesAttribute(): string
    {
        return match ($this->availability_status) {
            'pre_order' => 'bg-amber-50 text-amber-700 border-amber-300',
            'on_request' => 'bg-brand-primary-soft text-brand-primary border-brand-primary/20',
            default => 'bg-[#ecfdf5] text-emerald-700 border-emerald-300',
        };
    }

    public function whatsappInquiryUrl(?string $whatsappNumber = null): ?string
    {
        $digits = preg_replace('/[^0-9]/', '', (string) ($whatsappNumber ?: SiteSetting::getValue('whatsapp_number', '8801712806237')));

        if ($digits === '') {
            return null;
        }

        $modelText = $this->model_number ? " (Model: {$this->model_number})" : '';
        $message = "Hello Proud Rock Limited, I would like to request pricing and details for {$this->name}{$modelText}. Product link: " . route('products.show', $this->slug);

        return 'https://wa.me/' . $digits . '?text=' . rawurlencode($message);
    }

    public static function resolveMediaUrl(?string $value): ?string
    {
        if (empty($value)) {
            return null;
        }

        $path = ltrim($value, '/');

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
