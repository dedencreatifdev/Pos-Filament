<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Penjualan extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'sma_sales';
    protected $guarded = [];

    /**
     * Get the user that owns the Penjualan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function relPenjualanDetail(): BelongsTo
    {
        return $this->belongsTo(PenjualanDetail::class, 'id', 'sale_id');
    }
}
