<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Ketegori extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'sma_categories';
    protected $guarded = [];
}
