<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
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

    

    public function games()
    {
        return $this->belongsToMany(Game::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
