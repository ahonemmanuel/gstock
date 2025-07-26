<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['category'] ?? null, function ($query, $category) {
            $query->where('category_id', $category);
        })
            ->when($filters['status'] ?? null, function ($query, $status) {
                if ($status === 'low') {
                    $query->whereColumn('quantity', '<=', 'alert_quantity')
                        ->where('quantity', '>', 0);
                } elseif ($status === 'out') {
                    $query->where('quantity', 0);
                } else {
                    $query->where('status', $status);
                }
            })
            ->when($filters['price_min'] ?? null, function ($query, $priceMin) {
                $query->where('price', '>=', $priceMin);
            })
            ->when($filters['price_max'] ?? null, function ($query, $priceMax) {
                $query->where('price', '<=', $priceMax);
            })
            ->when($filters['date'] ?? null, function ($query, $date) {
                if ($date === 'today') {
                    $query->whereDate('created_at', today());
                } elseif ($date === 'week') {
                    $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                } elseif ($date === 'month') {
                    $query->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()]);
                } elseif ($date === 'year') {
                    $query->whereBetween('created_at', [now()->startOfYear(), now()->endOfYear()]);
                }
            });
    }

    protected $fillable = [
        'name',
        'sku',
        'category_id',
        'brand',
        'price',
        'cost',
        'tax_rate',
        'quantity',
        'alert_quantity',
        'unit',
        'description',
        'image',
        'status'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'cost' => 'decimal:2',
        'tax_rate' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getStockStatusAttribute()
    {
        if ($this->quantity <= 0) {
            return 'out';
        } elseif ($this->quantity <= $this->alert_quantity) {
            return 'low';
        }
        return 'in';
    }
}
