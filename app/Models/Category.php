<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'icon',
        'color',
        'text_color',
        'is_active'
    ];

    // Relation avec les produits (à adapter selon votre modèle Product)
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Scopes pour les filtres
    public function scopeActive(Builder $query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive(Builder $query)
    {
        return $query->where('is_active', false);
    }

    public function scopeEmpty(Builder $query)
    {
        return $query->doesntHave('products');
    }
}
