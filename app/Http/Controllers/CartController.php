<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Mail\OrderPlacedMail;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function syncCart(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        // Initialize an array to store the new objects
        $newObjects = [];

        // Get the authenticated user
        $user = Auth::user();

        // Loop through each cart item in the request
        foreach ($request->cart as $item) {
            // Check if the cart item already exists for the user with the same product_id and unit
            $existingCart = Cart::where('user_id', $user->id)
                ->where('product_id', $item['id'])
                ->where('unit', $item['unit'])
                ->first();

            if ($existingCart) {
                // If item exists, update the quantity and price
                $existingCart->quantity = $item['quantity']; // Add the new quantity to the existing one
                $existingCart->price = strval(floatval($item['price']) * $existingCart->quantity); // Update price based on new quantity
                $existingCart->save();
            } else {
                // If item does not exist, create a new entry in the cart
                Cart::create([
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone ?? '',
                    'address' => $user->address ?? '',
                    'product_title' => $item['name'],
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => strval(floatval($item['price']) * $item['quantity']),
                    'unit' => $item['unit'],
                    'image' => $item['image'],
                ]);
            }

            // Create a new object with desired values from the request item
            $newObject = [
                'id' => $item['id'],
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'unit' => $item['unit'],
                'image' => $item['image'],
            ];

            // Add the new object to the array
            $newObjects[] = $newObject;
        }

        // Return the new objects in the response
        return response()->json([
            'success' => true,
            'data' => $newObjects,  // Returning the newly created or updated objects
            'count' => count($newObjects),  // Optional: You can also return the count of objects
        ]);
    }





    public function storeOrder(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'contact_email_or_phone' => 'required|string',
            'products' => 'required|string',
            'delivery_country' => 'required|string',
            'delivery_firstname' => 'required|string',
            'delivery_lastname' => 'required|string',
            'delivery_address' => 'required|string',
            'delivery_postcode' => 'required|string',
            'delivery_city' => 'required|string',
            'delivery_phone' => 'required|string',
            'payment' => 'required|string',
            'billing_country' => 'nullable|string',
            'billing_firstname' => 'nullable|string',
            'billing_lastname' => 'nullable|string',
            'billing_company' => 'nullable|string',
            'billing_address' => 'nullable|string',
            'billing_apartment' => 'nullable|string',
            'billing_postcode' => 'nullable|string',
            'billing_city' => 'nullable|string',
            'billing_phone' => 'nullable|string',
            'contact_newsletter' => 'nullable|string',
            'delivery' => 'required|string',
            'billing' => 'nullable|string',
        ]);

        // Create the order
        $order = Order::create([
            'name' => $request->delivery_firstname . ' ' . $request->delivery_lastname,
            'email' => $request->contact_email_or_phone,
            'phone' => $request->delivery_phone,
            'address' => $request->delivery_address,
            'tracking_id' => 'TRK-' . uniqid(),
            'delivery_status' => 'processing',
            'payment_status' => 'pending',
            'delivery_country' => $request->delivery_country,
            'delivery_firstname' => $request->delivery_firstname,
            'delivery_lastname' => $request->delivery_lastname,
            'delivery_company' => $request->delivery_company,
            'delivery_address' => $request->delivery_address,
            'delivery_apartment' => $request->delivery_apartment,
            'delivery_postcode' => $request->delivery_postcode,
            'delivery_city' => $request->delivery_city,
            'delivery_phone' => $request->delivery_phone,
            'delivery_save_data' => $request->has('delivery_save_data'),
            'delivery_sms_offers' => $request->has('delivery_sms_offers'),
            'billing_country' => $request->billing_country,
            'billing_firstname' => $request->billing_firstname,
            'billing_lastname' => $request->billing_lastname,
            'billing_company' => $request->billing_company,
            'billing_address' => $request->billing_address,
            'billing_apartment' => $request->billing_apartment,
            'billing_postcode' => $request->billing_postcode,
            'billing_city' => $request->billing_city,
            'billing_phone' => $request->billing_phone,
            'payment' => $request->payment,
            'contact_email_or_phone' => $request->contact_email_or_phone,
            'contact_newsletter' => $request->has('contact_newsletter'),
        ]);

        // Save order details (products)
        $orderDetails = [];
        // Parse product data from the string
        $productStrings = explode('},{', trim($request->products, '{}')); // Split into individual product strings

        foreach ($productStrings as $productString) {
            $productDetails = explode(',', $productString); // Split each product into its details
            $orderDetail = OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $productDetails[0] ?? null,
                'product_title' => $productDetails[1] ?? null,
                'price' => $productDetails[2] ?? null,
                'quantity' => $productDetails[3] ?? null,
                'product_weight' => $productDetails[4] ?? null,
            ]);
            $orderDetails[] = $orderDetail;
        }

        // If user is authenticated, delete existing cart for this user
        if (auth()->check()) {
            // Use the query builder to directly delete records from the 'carts' table
            DB::table('carts')
                ->where('user_id', auth()->id())
                ->delete();
        }

        // Attach order details to order
        $order->order_details = $orderDetails;
        
        // Send email to the user

        $email = Contact::first()->email;
        //dd($email);
        if ($email){
            Mail::to($email)->send(new OrderPlacedMail($order));
        }else{
            Mail::to('bilale.benkaddi@gmail.com')->send(new OrderPlacedMail($order));
        }
        
        $request->session()->flash('clear_cart', true);
        // Get the current locale from the request or session
        $locale = App::getLocale();
        // Redirect to home with locale
        //return redirect()->route('home', ['lang' => $locale]);
        return redirect()->route('home', ['lang' => $locale, 'clearCart' => 1]);
    }
}
