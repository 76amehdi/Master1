<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Warehouse;
use App\Models\ProductUnit;
use Illuminate\Http\Request;
use App\Models\Purchasedetail;
use App\Models\PurchasePayment;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $ordersQuery = Order::with('orderDetails');

        if ($startDate && $endDate) {
            $ordersQuery->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }

        $orders = $ordersQuery->get();

        $totalSales = $orders->flatMap(function ($order) {
            return $order->orderDetails;
        })->sum(function ($detail) {
            return $detail->price * $detail->quantity;
        });

        $averageOrderValue = $orders->count() > 0 ? $totalSales / $orders->count() : 0;

        return view('admin.reports.sales', compact('orders', 'startDate', 'endDate', 'totalSales', 'averageOrderValue'));
    }

    public function salesReport(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $ordersQuery = Order::with('orderDetails');

        if ($startDate && $endDate) {
            $ordersQuery->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }

        $orders = $ordersQuery->get();

        $totalSales = $orders->flatMap(function ($order) {
            return $order->orderDetails;
        })->sum(function ($detail) {
            return $detail->price * $detail->quantity;
        });

        $averageOrderValue = $orders->count() > 0 ? $totalSales / $orders->count() : 0;

        return view('admin.reports.sales', compact('orders', 'startDate', 'endDate', 'totalSales', 'averageOrderValue'));
    }
    public function purchaseReport(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $purchasesQuery = Purchase::with('purchasedetail');

        if ($startDate && $endDate) {
            $purchasesQuery->whereBetween('purchase_date', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }

        $purchases = $purchasesQuery->get();
        $totalPurchaseCost = $purchases->flatMap(function ($purchase) {
            return $purchase->purchasedetail;
        })->sum(function ($detail) {
            return $detail->unit_price * $detail->quantity;
        });

        $totalPurchaseAmount = $purchases->sum('amount_to_pay');
        $averagePurchaseAmount = $purchases->count() > 0 ? $totalPurchaseAmount / $purchases->count() : 0;

        return view('admin.reports.purchase', compact('purchases', 'startDate', 'endDate', 'totalPurchaseCost', 'totalPurchaseAmount', 'averagePurchaseAmount'));
    }

    public function grossProfitReport(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $ordersQuery = Order::with('orderDetails');
        $purchasesQuery = Purchase::with('purchasedetail');

        if ($startDate && $endDate) {
            $ordersQuery->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            $purchasesQuery->whereBetween('purchase_date', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }


        $orders = $ordersQuery->get();
        $purchases = $purchasesQuery->get();


        $totalSales = $orders->flatMap(function ($order) {
            return $order->orderDetails;
        })->sum(function ($detail) {
            return $detail->price * $detail->quantity;
        });
        $totalPurchaseCost = $purchases->flatMap(function ($purchase) {
            return $purchase->purchasedetail;
        })->sum(function ($detail) {
            return $detail->unit_price * $detail->quantity;
        });

        $grossProfit = $totalSales - $totalPurchaseCost;

        return view('admin.reports.gross_profit', compact('grossProfit', 'startDate', 'endDate', 'totalSales', 'totalPurchaseCost'));
    }

    public function supplierReport(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $purchasesQuery = Purchase::with('fournisseur');

        if ($startDate && $endDate) {
            $purchasesQuery->whereBetween('purchase_date', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }
        $purchases = $purchasesQuery->get();

        $supplierPurchases = $purchases->groupBy('fournisseur.name')
            ->map(function ($purchases) {
                return $purchases->sum('amount_to_pay');
            });

        return view('admin.reports.supplier_purchases', compact('supplierPurchases', 'startDate', 'endDate'));
    }

    public function warehouseReport(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $purchasesQuery = Purchase::with('warehouse');

        if ($startDate && $endDate) {
            $purchasesQuery->whereBetween('purchase_date', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }
        $purchases = $purchasesQuery->get();

        $warehousePurchases = $purchases->groupBy('warehouse_id')
            ->map(function ($purchases, $warehouseId) {
                $warehouse = Warehouse::find($warehouseId); // Fetch the Warehouse model
                $total = $purchases->sum('amount_to_pay');
                return ['warehouse' => $warehouse, 'total' => $total];
            });


        return view('admin.reports.warehouse_purchases', compact('warehousePurchases', 'startDate', 'endDate'));
    }

    public function paymentAnalysis(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');


        $paymentsQuery = PurchasePayment::query();

        if ($startDate && $endDate) {
            $paymentsQuery->whereBetween('payment_date', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }
        $payments = $paymentsQuery->get();


        $totalPayments = $payments->sum('amount');

        $paymentsByMethod = $payments->groupBy('payment_method')
            ->map(function ($payments) {
                return $payments->sum('amount');
            });

        return view('admin.reports.payment_analysis', compact('totalPayments', 'paymentsByMethod', 'startDate', 'endDate'));
    }


    public function exportPdf(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $ordersQuery = Order::with('orderDetails');

        if ($startDate && $endDate) {
            $ordersQuery->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }

        $orders = $ordersQuery->get();
        $totalSales = $orders->flatMap(function ($order) {
            return $order->orderDetails;
        })->sum(function ($detail) {
            return $detail->price * $detail->quantity;
        });

        $pdf = PDF::loadView('admin.reports.sales_pdf', compact('orders', 'startDate', 'endDate', 'totalSales'));
        return $pdf->download('sales_report.pdf');
    }


    public function allReports(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Sales Data
        $ordersQuery = Order::with('orderDetails');
        if ($startDate && $endDate) {
            $ordersQuery->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay(),
            ]);
        }
        $orders = $ordersQuery->get();

        // Prepare Sales Data for Chart
        $salesByDate = $orders->groupBy(function ($order) {
            return Carbon::parse($order->created_at)->toDateString(); // Convert to Carbon
        })->map(function ($ordersForDate) {
            return $ordersForDate->flatMap(function ($order) {
                return $order->orderDetails;
            })->sum(function ($detail) {
                return $detail->price * $detail->quantity;
            });
        })->toArray();

        $salesLabels = array_keys($salesByDate);
        $salesValues = array_values($salesByDate);

        $totalSales = $orders->flatMap(function ($order) {
            return $order->orderDetails;
        })->sum(function ($detail) {
            return $detail->price * $detail->quantity;
        });

        $averageOrderValue = $orders->count() > 0 ? $totalSales / $orders->count() : 0;

        // Purchase Data
        $purchasesQuery = Purchase::with('purchasedetail');
        if ($startDate && $endDate) {
            $purchasesQuery->whereBetween('purchase_date', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }
        $purchases = $purchasesQuery->get();

        // Prepare Purchases Data for Chart
        $purchasesByDate = $purchases->groupBy(function ($purchase) {
            return Carbon::parse($purchase->purchase_date)->toDateString(); // Convert to Carbon
        })->map(function ($purchasesForDate) {
            return $purchasesForDate->flatMap(function ($purchase) {
                return $purchase->purchasedetail;
            })->sum(function ($detail) {
                return $detail->unit_price * $detail->quantity;
            });
        })->toArray();
        $purchaseLabels = array_keys($purchasesByDate);
        $purchaseValues = array_values($purchasesByDate);


        $purchasesAmountByDate = $purchases->groupBy(function ($purchase) {
            return  Carbon::parse($purchase->purchase_date)->toDateString(); // Convert to Carbon
        })->map(function ($purchasesForDate) {
            return $purchasesForDate->sum('amount_to_pay');
        })->toArray();

        $totalPurchaseCost = $purchases->flatMap(function ($purchase) {
            return $purchase->purchasedetail;
        })->sum(function ($detail) {
            return $detail->unit_price * $detail->quantity;
        });

        $totalPurchaseAmount = $purchases->sum('amount_to_pay');
        $averagePurchaseAmount = $purchases->count() > 0 ? $totalPurchaseAmount / $purchases->count() : 0;

        // Gross Profit Data
        $grossProfit = $totalSales - $totalPurchaseCost;

        // Supplier Data
        $purchasesSupplierQuery = Purchase::with('fournisseur');
        if ($startDate && $endDate) {
            $purchasesSupplierQuery->whereBetween('purchase_date', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        $purchasesSupplier = $purchasesSupplierQuery->get();
        $supplierPurchases = $purchasesSupplier->groupBy('fournisseur.name')
            ->map(function ($purchasesSupplier) {
                return $purchasesSupplier->sum('amount_to_pay');
            });

        // Warehouse Data
        $purchasesWarehouseQuery = Purchase::with('warehouse');
        if ($startDate && $endDate) {
            $purchasesWarehouseQuery->whereBetween('purchase_date', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        $purchasesWarehouse = $purchasesWarehouseQuery->get();
        $warehousePurchases = $purchasesWarehouse->groupBy('warehouse.name')
            ->map(function ($purchasesWarehouse) {
                return $purchasesWarehouse->sum('amount_to_pay');
            });

        // Payment Data
        $paymentsQuery = PurchasePayment::query();
        if ($startDate && $endDate) {
            $paymentsQuery->whereBetween('payment_date', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }
        $payments = $paymentsQuery->get();
        $totalPayments = $payments->sum('amount');

        // Calculate Total Credit
        $totalCredit = $totalPurchaseAmount - $totalPayments;

        $paymentsByMethod = $payments->groupBy('payment_method')
            ->map(function ($payments) {
                return $payments->sum('amount');
            });

        // Total Amount Paid to fournisseur
        $totalAmountPaidToFournisseur = $purchases->sum(function ($purchase) {
            return $purchase->payments->sum('amount');
        });

        // Total amount we need to pay
        $totalAmountToPay = $purchases->sum(function ($purchase) {
            return $purchase->amount_to_pay;
        });

        // Prepare Purchase vs Sales Data
        $combinedLabels = array_values(array_unique(array_merge($salesLabels, array_keys($purchasesAmountByDate))));
        $combinedSalesValues = array_map(function ($date) use ($salesByDate) {
            return $salesByDate[$date] ?? 0;
        }, $combinedLabels);
        $combinedPurchaseAmountValues = array_map(function ($date) use ($purchasesAmountByDate) {
            return $purchasesAmountByDate[$date] ?? 0;
        }, $combinedLabels);


        return view('admin.reports.all_reports', compact(
            'startDate',
            'endDate',
            'totalSales',
            'averageOrderValue',
            'totalPurchaseCost',
            'totalPurchaseAmount',
            'averagePurchaseAmount',
            'grossProfit',
            'supplierPurchases',
            'warehousePurchases',
            'totalPayments',
            'paymentsByMethod',
            'totalCredit',
            'totalAmountPaidToFournisseur',
            'totalAmountToPay',
            'salesLabels',
            'salesValues',
            'purchaseLabels',
            'purchaseValues',
            'combinedLabels',
            'combinedSalesValues',
            'combinedPurchaseAmountValues'
        ));
    }
    public function combinedReports(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        //Gross Profit Data
        $ordersQuery = Order::with('orderDetails');
        $purchasesQuery = Purchase::with('purchasedetail');

        if ($startDate && $endDate) {
            $ordersQuery->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            $purchasesQuery->whereBetween('purchase_date', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }


        $orders = $ordersQuery->get();
        $purchases = $purchasesQuery->get();


        $totalSales = $orders->flatMap(function ($order) {
            return $order->orderDetails;
        })->sum(function ($detail) {
            return $detail->price * $detail->quantity;
        });
        $totalPurchaseCost = $purchases->flatMap(function ($purchase) {
            return $purchase->purchasedetail;
        })->sum(function ($detail) {
            return $detail->unit_price * $detail->quantity;
        });

        $grossProfit = $totalSales - $totalPurchaseCost;

        //Supplier Data
        $purchasesSupplierQuery = Purchase::with('fournisseur');

        if ($startDate && $endDate) {
            $purchasesSupplierQuery->whereBetween('purchase_date', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }
        $purchasesSupplier = $purchasesSupplierQuery->get();

        $supplierPurchases = $purchasesSupplier->groupBy('fournisseur.name')
            ->map(function ($purchasesSupplier) {
                return $purchasesSupplier->sum('amount_to_pay');
            });


        // Warehouse Data
        $purchasesWarehouseQuery = Purchase::with('warehouse');

        if ($startDate && $endDate) {
            $purchasesWarehouseQuery->whereBetween('purchase_date', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }

        $purchasesWarehouse = $purchasesWarehouseQuery->get();
        $warehousePurchases = $purchasesWarehouse->groupBy('warehouse.name')
            ->map(function ($purchasesWarehouse) {
                return $purchasesWarehouse->sum('amount_to_pay');
            });


        // Payment Data
        $paymentsQuery = PurchasePayment::query();

        if ($startDate && $endDate) {
            $paymentsQuery->whereBetween('payment_date', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }
        $payments = $paymentsQuery->get();


        $totalPayments = $payments->sum('amount');

        $paymentsByMethod = $payments->groupBy('payment_method')
            ->map(function ($payments) {
                return $payments->sum('amount');
            });

        return view('admin.reports.combined_reports', compact(
            'startDate',
            'endDate',
            'grossProfit',
            'totalSales',
            'totalPurchaseCost',
            'supplierPurchases',
            'warehousePurchases',
            'totalPayments',
            'paymentsByMethod'
        ));
    }


    public function report_werhouse_details(Request $request)
    {
        $warehouseId = $request->warehouse;

        $warehouse = Warehouse::findOrFail($warehouseId);
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $purchases = Purchase::with('purchasedetail', 'payments')
            ->where('warehouse_id', $warehouseId)
            ->when($startDate, function ($query, $startDate) {
                $query->where('purchase_date', '>=', $startDate);
            })
            ->when($endDate, function ($query, $endDate) {
                $query->where('purchase_date', '<=', $endDate);
            })
            ->get();


        $orders = Order::with('orderDetails')
            ->whereHas('orderDetails', function ($query) use ($warehouseId) {
                $query->whereHas('product', function ($q) use ($warehouseId) {
                    $q->where('warehouse_id', $warehouseId);
                });
            })
            ->when($startDate, function ($query, $startDate) {
                $query->where('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query, $endDate) {
                $query->where('created_at', '<=', $endDate);
            })
            ->get();

        $totalAmount = $purchases->sum('amount_to_pay');
        $totalPaid = $purchases->flatMap->payments->sum('amount');
        $totalUnpaid = $totalAmount - $totalPaid;

        $productQuantities = [];
        foreach ($purchases as $purchase) {
            foreach ($purchase->purchasedetail as $detail) {
                $productId = $detail->product_id;
                $unitId = $detail->product_unit_id;

                if (!isset($productQuantities[$productId])) {
                    $product = Product::find($productId);
                    $productQuantities[$productId] = [
                        'title' => $product ? $product->title : 'Unknown',
                        'units' => [],
                        'totalQuantity' => 0,
                    ];
                }
                if (!isset($productQuantities[$productId]['units'][$unitId])) {
                    $unit = ProductUnit::find($unitId);
                    $productQuantities[$productId]['units'][$unitId] =  [
                        'unitName' => $unit ? $unit->unit : 'Unknown Unit',
                        'quantity' => 0,
                    ];
                }


                $productQuantities[$productId]['units'][$unitId]['quantity'] += $detail->quantity;
                $productQuantities[$productId]['totalQuantity'] += $detail->quantity;
            }
        }


        // product order quantity
        $productOrderQuantities = [];
        foreach ($orders as $order) {
            foreach ($order->orderDetails as $detail) {
                $productId = $detail->product_id;
                if (!isset($productOrderQuantities[$productId])) {
                    $productOrderQuantities[$productId] = [
                        'title' => $detail->product_title,
                        'totalQuantity' => 0,
                    ];
                }
                $productOrderQuantities[$productId]['totalQuantity'] += $detail->quantity;
            }
        }

        return view('admin.warehouses.report', compact('warehouse', 'purchases', 'totalAmount', 'totalPaid', 'totalUnpaid', 'productQuantities', 'startDate', 'endDate', 'orders', 'productOrderQuantities'));
    }
}
