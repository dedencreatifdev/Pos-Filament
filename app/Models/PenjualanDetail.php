<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PenjualanDetail extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'sma_sale_items';
    protected $guarded = [];
}
