<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class SiteSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'group',
    ];

    public const CACHE_KEY = 'site_settings.map';

    /**
     * Return all site settings as a key => value associative array.
     *
     * @return array<string, string|null>
     */
    public static function allMap(): array
    {
        if (! Schema::hasTable('site_settings')) {
            return [];
        }

        return Cache::rememberForever(self::CACHE_KEY, function (): array {
            return self::query()
                ->pluck('value', 'key')
                ->all();
        });
    }

    /**
     * Get a single setting value with a default fallback.
     */
    public static function getValue(string $key, ?string $default = null): ?string
    {
        $map = self::allMap();

        return array_key_exists($key, $map) && $map[$key] !== null && $map[$key] !== ''
            ? $map[$key]
            : $default;
    }

    /**
     * Persist a single setting value and refresh cache.
     */
    public static function setValue(string $key, ?string $value, string $group = 'general'): void
    {
        self::setMany([$key => $value], $group);
    }

    /**
     * Persist multiple settings and refresh cache.
     *
     * @param  array<string, string|null>  $values
     */
    public static function setMany(array $values, string $group = 'general'): void
    {
        foreach ($values as $key => $value) {
            self::query()->updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => $group],
            );
        }

        Cache::forget(self::CACHE_KEY);
    }
}
