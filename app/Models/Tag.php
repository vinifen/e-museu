<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'validation',
        'category_id',
    ];

    protected $table = 'tags';

    public function items() {
        return $this->belongsToMany(Item::class, 'tag_item', 'tag_id', 'item_id');
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
