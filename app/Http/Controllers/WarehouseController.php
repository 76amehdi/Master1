<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        // Fetch all warehouses and products
        $warehouses = Warehouse::all();
        $products = Product::all();

        return view('admin.warehouses.index', compact('warehouses', 'products'));
    }
    public function show($id)
    {
        // Find the warehouse by ID with its products
        $warehouse = Warehouse::with('products.category', 'products.images', 'products.units')->findOrFail($id);
        // Get all warehouses for the select box on edit warehouse view
        $warehouses = Warehouse::all();

        return view('admin.warehouses.show', compact('warehouse', 'warehouses'));
    }

    public function transfer(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'destination_warehouse' => 'required|exists:warehouses,id',
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
        ]);

        // Get the selected product and its current warehouse
        $product = Product::find($request->product_id);
        $sourceWarehouse = $product->warehouse;
        $destinationWarehouse = Warehouse::find($request->destination_warehouse);
        $transferQuantity = $request->qty;

        // Check if enough quantity is available
        if ($product->qty < $transferQuantity) {
            return back()->withErrors(['qty' => 'Not enough quantity in the source warehouse.']);
        }

        // Begin the product transfer process
        DB::transaction(function () use ($product, $sourceWarehouse, $destinationWarehouse, $transferQuantity) {
            // Update source warehouse quantity
            $product->qty -= $transferQuantity;
            $product->save();

            // Check if product already exists in the destination warehouse
            $destinationProduct = Product::where('warehouse_id', $destinationWarehouse->id)
                ->where('title', $product->title)
                ->first();

            if ($destinationProduct) {
                // If product exists, increase the quantity
                $destinationProduct->qty += $transferQuantity;
                $destinationProduct->save();
            } else {
                // Otherwise, create a new product record for the destination warehouse
                Product::create([
                    'title' => $product->title,
                    'description' => $product->description,
                    'qty' => $transferQuantity,
                    'brand' => $product->brand,
                    'category_id' => $product->category_id,
                    'warehouse_id' => $destinationWarehouse->id,
                ]);
            }
        });

        // Redirect with success message
        return redirect()->route('warehouses.index')
            ->with('success', 'Product transfer completed successfully.');
    }
    public function update(Request $request, $id)
    {
        // Validate incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        $warehouse = Warehouse::findOrFail($id);
        $warehouse->update([
            'name' => $request->name,
            'location' => $request->location,
        ]);

        return redirect()->back()->with('message', 'Warehouse updated successfully.');
    }
}
