<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\MorphTo;

class Lock extends Model
{
    use HasFactory;

    protected $fillable = [
        'lockable_id',
        'lockable_type',
        'expiry_date',
        'user_id',
    ];

    protected $table = 'locks';

    public function lockable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function findByModel($subject)
    {
        return self::where('lockable_type', get_class($subject))
                    ->where('lockable_id', $subject->id)
                    ->first();
    }

    public function expiresAt()
    {
        return $this->expiry_date;
    }
}
