<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Book extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'bookName', 'type', 'pages','price', 'description', 'publishTime', 'author', 'stock', 'slug', 'image_path'
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);//user id related to user table
    // }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'bookName'
            ]
        ];
    }

    public function reviews()
    {
        return $this->hasMany(Review::class); // Review table must have a belongTo no need another database table
    }

}