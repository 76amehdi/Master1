<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'fournisseur_id',
        'warehouse_id',
        'purchase_date',
        'payment_status',
        'amount_to_pay', // Changed to 'amount_to_pay' instead of 'amount_due'
        'reduction',
    ];

    // Define the relationship with the Warehouse model
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    // Define the relationship with the Fournisseur model
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }
    public function purchasedetail()
    {
        return $this->hasMany(Purchasedetail::class);
    }
    public function payments()
    {
        return $this->hasMany(PurchasePayment::class);
    }
}
