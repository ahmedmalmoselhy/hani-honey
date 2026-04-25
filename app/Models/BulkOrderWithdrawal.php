<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BulkOrderWithdrawal extends Model
{
    /** @use HasFactory<\Database\Factories\BulkOrderWithdrawalFactory> */
    use HasFactory;

    protected $fillable = [
        'bulk_order_id',
        'weight',
        'withdrawn_at',
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
            'weight' => 'decimal:2',
            'withdrawn_at' => 'datetime',
        ];
    }

    /**
     * @return BelongsTo<BulkOrder, $this>
     */
    public function bulkOrder(): BelongsTo
    {
        return $this->belongsTo(BulkOrder::class);
    }
}
