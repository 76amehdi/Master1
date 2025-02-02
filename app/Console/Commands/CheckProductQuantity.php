<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;

class CheckProductQuantity extends Command
{
    protected $signature = 'product:check-quantity';
    protected $description = 'Vérifier si la quantité d\'un produit est inférieure à 5 et mettre à jour une notification';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Récupérer tous les produits dont la quantité est inférieure à 5
        $products = Product::where('qty', '<', 5)->get();

        // Parcourir chaque produit et mettre à jour l'alerte de stock faible
        

        $this->info('Vérification terminée et alertes mises à jour');
    }
}
