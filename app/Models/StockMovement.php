<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    protected $fillable = [
        'reference',
        'movement_date',
        'type',
        'product_id',
        'quantity',
        'source_location',
        'destination_location',
        'responsible',
        'notes'
    ];

    protected $casts = [
        'movement_date' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Accesseurs pour les icônes et couleurs
    public function getTypeIconAttribute()
    {
        return [
            'entree' => 'fa-arrow-down',
            'sortie' => 'fa-arrow-up',
            'transfert' => 'fa-exchange-alt',
            'ajustement' => 'fa-adjust'
        ][$this->type];
    }

    public function getTypeColorAttribute()
    {
        return [
            'entree' => 'text-success',
            'sortie' => 'text-danger',
            'transfert' => 'text-info',
            'ajustement' => 'text-warning'
        ][$this->type];
    }

    public function getDisplayQuantityAttribute()
    {
        return in_array($this->type, ['sortie', 'ajustement'])
            ? -$this->quantity
            : $this->quantity;
    }
}
