<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public const STATUS_ACTIVE    = 'active';
    public const STATUS_PENDING   = 'pending';
    public const STATUS_SUSPENDED = 'suspended';

    public const STATUSES = [
        self::STATUS_ACTIVE,
        self::STATUS_PENDING,
        self::STATUS_SUSPENDED,
    ];

    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'latitude'  => 'decimal:7',
            'longitude' => 'decimal:7',
        ];
    }

    // -------------------------------------------------------------------------
    // Scopes
    // -------------------------------------------------------------------------

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeByStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    public function scopeSearch(Builder $query, string $term): Builder
    {
        return $query->where(function (Builder $q) use ($term) {
            $q->where('name', 'like', "%{$term}%")
              ->orWhere('status', 'like', "%{$term}%");
        });
    }

    // -------------------------------------------------------------------------
    // Accessors
    // -------------------------------------------------------------------------

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }
}
