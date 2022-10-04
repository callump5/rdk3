<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function scopeIndex($query)
    {
        return $query;
    }

    public function scopeSearchTitle($query, $searchTerm)
    {
        return $query->where("name", 'LIKE', "%{$searchTerm}%");
    }

    public function games(){
        return $this->hasMany(Game::class);
    }
}
