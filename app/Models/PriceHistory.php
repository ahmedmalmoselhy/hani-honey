<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PriceHistory extends Model
{
    /** @use HasFactory<\Database\Factories\PriceHistoryFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'patch_id',
        'price_per_kg',
        'changed_at',
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
            'price_per_kg' => 'decimal:2',
            'changed_at' => 'datetime',
        ];
    }

    /**
     * @return BelongsTo<Patch, $this>
     */
    public function patch(): BelongsTo
    {
        return $this->belongsTo(Patch::class);
    }
}
