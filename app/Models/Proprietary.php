<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proprietary extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'contact',
        'blocked',
        'is_admin'
    ];

    protected $table = 'proprietaries';

    public function items() {
        return $this->hasMany(Item::class);
    }
}
