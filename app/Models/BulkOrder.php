<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BulkOrder extends Model
{
    /** @use HasFactory<\Database\Factories\BulkOrderFactory> */
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'patch_id',
        'total_weight',
        'total_price',
        'amount_paid',
        'remaining_weight',
        'status',
        'ordered_at',
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
            'total_price' => 'decimal:2',
            'amount_paid' => 'decimal:2',
            'remaining_weight' => 'decimal:2',
            'ordered_at' => 'datetime',
        ];
    }

    /**
     * @return BelongsTo<Customer, $this>
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * @return BelongsTo<Patch, $this>
     */
    public function patch(): BelongsTo
    {
        return $this->belongsTo(Patch::class);
    }

    /**
     * @return HasMany<BulkOrderWithdrawal, $this>
     */
    public function withdrawals(): HasMany
    {
        return $this->hasMany(BulkOrderWithdrawal::class);
    }
}
