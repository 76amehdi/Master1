<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Warehouse;
use App\Models\Fournisseur;
use App\Models\ProductUnit;
use Illuminate\Http\Request;
use App\Models\Purchasedetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    // Display all purchases
    public function indexq()
    {
        $fournisseurs = Fournisseur::all();
        $warehouses = Warehouse::all();
        // Order purchases from the latest to the oldest by created_at and paginate by 8
        $purchases = Purchase::with(['fournisseur', 'warehouse', 'payments'])
            ->orderBy('created_at', 'desc')  // 'desc' for descending order (latest first)
            ->paginate(5);  // Paginate with 8 items per page

        return view('admin.purchases.index', compact('purchases', 'warehouses', 'fournisseurs'));
    }

      public function index(Request $request)
    {
        $fournisseurs = Fournisseur::all();
        $warehouses = Warehouse::all();

        // Get filter values from the request
        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');
        $payment_status = $request->input('payment_status');
        $fournisseur_id = $request->input('fournisseur_id');
        $warehouse_id = $request->input('warehouse_id');

        $purchases = Purchase::with(['fournisseur', 'warehouse', 'payments'])
            ->orderBy('created_at', 'desc');  // Default ordering

        // Apply supplier filter if provided
        if ($fournisseur_id) {
            $purchases->where('fournisseur_id', $fournisseur_id);
        }
        // Apply warehouse filter if provided
        if ($warehouse_id) {
            $purchases->where('warehouse_id', $warehouse_id);
        }
        // Apply date filters if provided
        if ($date_from) {
            $purchases->where('purchase_date', '>=', $date_from);
        }
        if ($date_to) {
            $purchases->where('purchase_date', '<=', $date_to);
        }

        // Apply payment status filter if provided
        if ($payment_status) {
            $purchases->where('payment_status', $payment_status);
        }

        // Paginate the results
         $purchasesPaginated = $purchases->paginate(5);

        return view('admin.purchases.index', compact('purchasesPaginated', 'warehouses', 'fournisseurs'));
    }


    public function printFilteredPurchases(Request $request)
    {
         $fournisseurs = Fournisseur::all();
        $warehouses = Warehouse::all();

        // Get filter values from the request
         $date_from = $request->input('date_from');
         $date_to = $request->input('date_to');
         $payment_status = $request->input('payment_status');
         $fournisseur_id = $request->input('fournisseur_id');
         $warehouse_id = $request->input('warehouse_id');
        $purchases = Purchase::with(['fournisseur', 'warehouse', 'payments'])
            ->orderBy('created_at', 'desc');  // Default ordering
            // Apply supplier filter if provided
        if ($fournisseur_id) {
            $purchases->where('fournisseur_id', $fournisseur_id);
        }
        // Apply warehouse filter if provided
        if ($warehouse_id) {
           $purchases->where('warehouse_id', $warehouse_id);
        }
        // Apply date filters if provided
        if ($date_from) {
            $purchases->where('purchase_date', '>=', $date_from);
        }
        if ($date_to) {
           $purchases->where('purchase_date', '<=', $date_to);
        }

        // Apply payment status filter if provided
        if ($payment_status) {
            $purchases->where('payment_status', $payment_status);
        }
        // Get the results
         $purchases = $purchases->get();


        $pdf = PDF::loadView('admin.purchases.print_all', compact('purchases', 'warehouses','fournisseurs'));
        return $pdf->download('filtered_purchases.pdf');
    }
    // Show form to create a new purchase
    public function create()
    {
        $fournisseurs = Fournisseur::all();
        $warehouses = Warehouse::all();
        $products = Product::all(); // Assuming 'products' table exists, replace with actual model name if needed
        return view('admin.purchases.create', compact('warehouses', 'fournisseurs', 'products'));
    }

    // Store a new purchase
    public function store(Request $request)
    {
       // Decode the JSON data into an array
        $data = collect($request->products)->map(function ($item) {
            return json_decode($item, true);
        });

        // Validate main request fields
        $validated = $request->validate([
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'warehouse_id' => 'required|exists:warehouses,id',

            'purchase_date' => 'nullable|date',
            'reduction' => 'nullable|numeric|min:0',
            'amount_to_pay' => 'required|numeric|min:0', // Ensure amount_to_pay is validated
        ]);

        // Create a new purchase record
        $purchase = Purchase::create([
            'fournisseur_id' => $validated['fournisseur_id'],
            'warehouse_id' => $validated['warehouse_id'],
            'payment_status' => "unpaid",
            'purchase_date' => $validated['purchase_date'] ?? now(),
            'reduction' => $validated['reduction'] ?? 0.00,
            'amount_to_pay' => $validated['amount_to_pay'], // Use the provided amount_to_pay
        ]);

         // Loop through the processed data and handle `purchasedetails` and `products` updates
        foreach ($data as $item) {
            // Validate that the unit_id is not null
            if (empty($item['unit_id'])) {
                dd(' Unit ID is required for all products.');
            }
            $unit_id = (int) $item['unit_id'];
            //dd($unit_id);

            // Insert into purchasedetails
            Purchasedetail::create([
                'purchase_id' => $purchase->id,
                'product_id' => $item['product_id'],
                'product_unit_id' => $unit_id,
                'quantity' => $item['achat_quantity'],
                'unit_price' => $item['unit_price'],
            ]);

            // Update product quantity
            Product::where('id', $item['product_id'])->increment('qty', $item['achat_quantity']);
        }

        return redirect()->route('purchases.index', ['lang' => app()->getLocale()])
            ->with('success', 'Purchase created successfully!');
    }


    // Display a single purchase
     public function show(Request $request)
    {
        $id = $request->purchase;
        // Load purchase with purchasedetail and associated product
        $purchase = Purchase::with(['purchasedetail.product'])->find($id);

        // Load product units by ids
        $productUnits = ProductUnit::whereIn('id', $purchase->purchasedetail->pluck('product_unit_id'))->get();

        return view('admin.purchases.show', compact('purchase', 'productUnits'));
    }




    public function PrintRapport($purchase_id)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {
                // Find the specific purchase
                 $purchase = Purchase::with(['fournisseur', 'warehouse', 'payments'])
                    ->find($purchase_id);


                if ($purchase) {
                    // Generate PDF with the purchase details
                     $pdf = PDF::loadView('admin.purchases.bill', compact('purchase'));
                    return $pdf->download('purchase_bill_' . $purchase->id . '.pdf');
                } else {
                    return redirect()->back()->with('error', 'Purchase not found.');
                }
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }


     public function printAllPurchases()
    {
        // Get all purchases with their payments
         $purchases = Purchase::with('payments')->get();

        // Load a view and pass the data to it
        $pdf = PDF::loadView('admin.purchases.print_all', compact('purchases'));

        // Return the generated PDF
        return $pdf->download('all_purchases_with_payments.pdf');
    }



    // Show form to edit an existing purchase
    public function edit($id)
    {
        $purchase = Purchase::with(['purchasedetail.product.units'])->findOrFail($id);
        $fournisseurs = Fournisseur::all();
        $warehouses = Warehouse::all();
        $products = Product::with(['units', 'images'])->get();

        return view('admin.purchases.edit', compact('purchase', 'fournisseurs', 'warehouses', 'products'));
    }

   // Update an existing purchase
    public function update(Request $request, $purchaseId)
    {
        \Log::info('Update request data:', $request->all());
        
        // Validate main request fields
        $validated = $request->validate([
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'purchase_date' => 'nullable|date',
            'reduction' => 'nullable|numeric|min:0',
            'reduction_type' => 'required|in:fixed,percentage',
            'amount_to_pay' => 'required|numeric|min:0'
        ]);

        DB::beginTransaction();
        try {
            // Find the existing purchase record by ID
            $purchase = Purchase::findOrFail($purchaseId);

            // Update the purchase record
            $purchase->update([
                'fournisseur_id' => $validated['fournisseur_id'],
                'warehouse_id' => $validated['warehouse_id'],
                'purchase_date' => $validated['purchase_date'] ?? now(),
                'reduction' => $validated['reduction'] ?? 0,
                'reduction_type' => $validated['reduction_type'],
                'amount_to_pay' => $validated['amount_to_pay']
            ]);

            // Get the products data from request
            $productsData = [];
            if ($request->has('products')) {
                foreach ($request->products as $productJson) {
                    $productsData[] = json_decode($productJson, true);
                }
            }

            \Log::info('Products data:', $productsData);

            // Get existing purchase details
            $existingDetails = $purchase->purchasedetail()->get();
            
            // Revert old quantities
            foreach ($existingDetails as $detail) {
                $product = Product::find($detail->product_id);
                if ($product) {
                    $product->decrement('qty', $detail->quantity);
                }
            }

            // Delete all existing purchase details
            $purchase->purchasedetail()->delete();

            // Create new purchase details and update quantities
            foreach ($productsData as $item) {
                // Create new purchase detail
                Purchasedetail::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $item['product_id'],
                    'product_unit_id' => $item['unit_id'],
                    'quantity' => $item['achat_quantity'],
                    'unit_price' => $item['unit_price']
                ]);

                // Update product quantity
                $product = Product::find($item['product_id']);
                if ($product) {
                    $product->increment('qty', $item['achat_quantity']);
                }
            }

            DB::commit();

            return redirect()->route('purchases.index', ['lang' => app()->getLocale()])
                ->with('success', 'Purchase updated successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Error updating purchase: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error updating purchase. Please try again.')
                ->withInput();
        }
    }

    // Delete a purchase
     public function destroy($id)
    {
        DB::beginTransaction();
        try {
            // Find the purchase
            $purchase = Purchase::with('purchasedetail')->findOrFail($id);
            
            // Revert quantities for all products in this purchase
            foreach ($purchase->purchasedetail as $detail) {
                $product = Product::find($detail->product_id);
                if ($product) {
                    $product->decrement('qty', $detail->quantity);
                }
            }
            
            // Delete the purchase (this will also delete related purchasedetails due to cascade)
            $purchase->delete();
            
            DB::commit();
            return redirect()->route('purchases.index', ['lang' => app()->getLocale()])
                ->with('success', 'Achat supprimé avec succès!');
                
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Error deleting purchase: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Erreur lors de la suppression de l\'achat. Veuillez réessayer.')
                ->withInput();
        }
    }
}