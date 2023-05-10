<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'entry',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // protected $hidden = [
    //     'user_id',
    //     'id',
    // ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
