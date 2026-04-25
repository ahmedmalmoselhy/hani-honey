<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patch extends Model
{
    /** @use HasFactory<\Database\Factories\PatchFactory> */
    use HasFactory;

    protected $fillable = [
        'year',
        'patch_number',
        'total_weight',
        'remaining_weight',
        'current_price_per_kg',
        'status',
        'notes',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'total_weight' => 'decimal:2',
            'remaining_weight' => 'decimal:2',
            'current_price_per_kg' => 'decimal:2',
        ];
    }

    /**
     * @return HasMany<PriceHistory, $this>
     */
    public function priceHistories(): HasMany
    {
        return $this->hasMany(PriceHistory::class);
    }

    /**
     * @return HasMany<Sale, $this>
     */
    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    /**
     * @return HasMany<BulkOrder, $this>
     */
    public function bulkOrders(): HasMany
    {
        return $this->hasMany(BulkOrder::class);
    }

    /**
     * @return HasMany<InternalUsage, $this>
     */
    public function internalUsages(): HasMany
    {
        return $this->hasMany(InternalUsage::class);
    }
}
