<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Produk extends Model
{
    // sma_warehouses_products
    use HasFactory, Notifiable;

    protected $table = 'sma_products';
    protected $guarded = [];

    /**
     * Get the user that owns the Produk
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function relProdukDetail(): BelongsTo
    {
        return $this->belongsTo(ProdukDetail::class, 'id', 'product_id');
    }

    public function relGudang(): BelongsTo
    {
        return $this->belongsTo(Gudang::class, 'warehouse_id', 'id');
    }

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
}
