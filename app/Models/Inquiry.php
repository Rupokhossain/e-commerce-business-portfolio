<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inquiry extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'company_name',
        'phone',
        'email',
        'subject',
        'message',
        'status',
        'admin_notes',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeRecent(Builder $query): Builder
    {
        return $query->orderByDesc('created_at');
    }
}