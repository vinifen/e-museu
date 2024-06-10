<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemComponent extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'component_id',
        'validation',
    ];

    protected $table = 'item_component';

    public function item() {
        return $this->belongsTo(Item::class);
    }

    public function component() {
        return $this->belongsTo(Item::class, );
    }
}
