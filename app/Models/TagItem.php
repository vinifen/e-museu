<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'tag_id',
        'validation',
    ];

    protected $table = 'tag_item';

    public function item() {
        return $this->belongsTo(Item::class);
    }

    public function tag() {
        return $this->belongsTo(Tag::class);
    }
}
