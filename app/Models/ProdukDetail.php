<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class ProdukDetail extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'sma_products';
    // protected $table = 'sma_warehouses_products';
    protected $guarded = [];

    /**
     * Get the user that owns the Produk
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function relSatuan(): BelongsTo
    {
        return $this->belongsTo(Satuan::class, 'unit', 'id');
    }

    public function relCategori(): BelongsTo
    {
        return $this->belongsTo(Ketegori::class, 'category_id', 'id');
    }

    public function relBrand(): BelongsTo
    {
        return $this->belongsTo(Merk::class, 'brand', 'id');
    }

    public function relGudang(): BelongsTo
    {
        return $this->belongsTo(Gudang::class, 'brand', 'id');
    }
}
