<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function scopeIndex($query)
    {
        return $query;
    }

    public function games()
    {
        return $this->belongsToMany(Game::class);
    }

    public function parent()
    {
        return $this->belongsTo(Platform::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Platform::class, 'parent_id');
    }

}
