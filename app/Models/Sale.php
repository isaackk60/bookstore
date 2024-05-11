<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'books', 'order_date', 'order_price',
    ];

    protected $casts = [
        'books' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
