<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'history',
        'detail',
        'date',
        'identification_code',
        'validation',
        'image',
        'section_id',
        'proprietary_id',
    ];

    protected $table = 'items';

    public function proprietary() {
        return $this->belongsTo(Proprietary::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'tag_item', 'item_id', 'tag_id');
    }

    public function composedOf() {
        return $this->belongsToMany(Item::class, 'item_component', 'item_id', 'component_id');
    }

    public function composes() {
        return $this->belongsToMany(Item::class, 'item_component', 'component_id', 'item_id');
    }

    public function extras() {
        return $this->hasMany(Extra::class);
    }

    public function contributions() {
        return $this->hasMany(Contribution::class);
    }

    public function section() {
        return $this->belongsTo(Section::class);
    }

    public function ItemComponents() {
        return $this->hasMany(ItemComponent::class);
    }

    public function tagItems() {
        return $this->hasMany(TagItem::class);
    }
}
