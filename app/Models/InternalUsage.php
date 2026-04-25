<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InternalUsage extends Model
{
    /** @use HasFactory<\Database\Factories\InternalUsageFactory> */
    use HasFactory;

    protected $fillable = [
        'patch_id',
        'weight',
        'type',
        'recipient',
        'notes',
        'occurred_at',
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
            'occurred_at' => 'datetime',
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
