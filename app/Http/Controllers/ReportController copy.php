<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;
use PDF;

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
           

        return view('admin.reports.sales', compact('orders', 'startDate', 'endDate','totalSales'));
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

        $pdf = PDF::loadView('admin.reports.sales_pdf', compact('orders','startDate','endDate','totalSales'));
        return $pdf->download('sales_report.pdf');
    }
}