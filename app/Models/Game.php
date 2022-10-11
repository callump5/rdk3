<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Game extends Model
{
    use HasFactory;


    const EXCERPT_LENGTH = 100;

    protected $fillable = [
        'name',
        'description',
        'cdkeys_price',
        'g2a_price',
        'cdkeys_link',
        'g2a_link',
    ];

    public function scopeIndex($query)
    {
        return $query;
    }

    public function scopeSearchTitle($query, $searchTerm)
    {
        return $query->where("name", 'LIKE', "%{$searchTerm}%");
    }



    public function excerpt()
    {
        return Str::limit($this->description, Game::EXCERPT_LENGTH);
    }


    // Set up relationships
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function platforms()
    {
        return $this->belongsToMany(Platform::class);
    }

    public function collections(){
        return $this->belongsToMany(Collection::class);
    }

}
