<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
   private function checkPermission($permission, $user = null)
    {
     $user = $user ?: Auth::user();
      if (!$user) {
           return false;
      }
     $userRole = $user->roles;
     if ($userRole && $userRole->admin == 1) {
         return true;
      }
       return $userRole && $userRole->$permission == 1;
    }
    public function productsReport()
    {
         if (!$this->checkPermission('manage_products')) {
              return redirect()->route('home')->with('error', 'You do not have permission to access this page.');
          }
        $products = Product::with('category', 'warehouse','images','units')->get();
        $pdf = PDF::loadView('admin.reports.products', compact('products'));
        return $pdf->download('products_report.pdf');
    }

    public function ordersReport()
    {
       if (!$this->checkPermission('manage_orders')) {
           return redirect()->route('home')->with('error', 'You do not have permission to access this page.');
         }
        $orders = Order::with('orderDetails')->get();
        $pdf = PDF::loadView('admin.reports.orders', compact('orders'));
        return $pdf->download('orders_report.pdf');
    }


    public function purchasesReport()
    {
       if (!$this->checkPermission('manage_purchases')) {
             return redirect()->route('home')->with('error', 'You do not have permission to access this page.');
         }
        $purchases = Purchase::with('fournisseur', 'warehouse', 'purchasedetail.product', 'payments')->get();
        $pdf = PDF::loadView('admin.reports.purchases', compact('purchases'));
        return $pdf->download('purchases_report.pdf');
    }

    public function customersReport()
    {
       if (!$this->checkPermission('manage_users')) {
           return redirect()->route('home')->with('error', 'You do not have permission to access this page.');
         }
        $customers = User::where('userType', 0)->get();
        $pdf = PDF::loadView('admin.reports.customers', compact('customers'));
        return $pdf->download('customers_report.pdf');
    }
}