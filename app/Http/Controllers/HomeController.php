<?php

namespace App\Http\Controllers;

use Stripe;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderDetail;
use Illuminate\Support\Str;
use App\Models\AstuceBeaute;
use Illuminate\Http\Request;
use App\Mail\OrderPlacedMail;
use App\Models\HomepageSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;



class HomeController extends Controller
{
    public $settings;
    public $featuredProducts;
    public $categoryDisplays;
    public $localisation;

    public function __construct()
    {
        $this->settings = HomepageSetting::first();
        $this->featuredProducts = \App\Models\FeaturedProduct::with('product')->orderBy('display_order')->get();
        $this->categoryDisplays = \App\Models\CategoryDisplay::with('category')->orderBy('display_order')->get();
        $this->localisation = Contact::first();
        $categories = AstuceBeaute::pluck('category')->toArray();
        $beautyTips = [];
        foreach ($categories as $category) {
            // Generate the URL.  I am using `str_replace` to replace spaces with dashes and convert to lowercase
            $url = 'blogs/' . strtolower($category);
            $beautyTips[$category] = $url;
        }

        // Share the variables with all views
        View::share('beautyTips', $beautyTips);
        View::share('settings', $this->settings);
        View::share('featuredProducts', $this->featuredProducts);
        View::share('categoryDisplays', $this->categoryDisplays);
        view::share('localisation', $this->localisation);
    }
    //
    /*public function index()
    {
        $categories = Category::all();
        $products = Product::all();

        if (Auth::id()) {
            $user_id = Auth::user()->id;
            $cartData = Cart::where('user_id', '=', $user_id)->get();
            return view('user.index', compact('products', 'categories', 'cartData'));
        } else {
            return view('user.index', compact('products', 'categories'));
        }
    }*/

    public function Home()
    {
        $userType = Auth::user()->usertype;

        if ($userType == '1') {
            $total_users = User::where('usertype', 0)->count();
            // Total Products
            $total_product = Product::count();

            // Revenue Calculation using sum of price and quantity from order_details
            $revenue = OrderDetail::whereHas('order', function ($query) {
                $query->where('payment_status', 'paid');
            })->sum(DB::raw('price * quantity'));


            // Total sold products is the total sum of quantities from the order_details table
            $sold_products = OrderDetail::sum('quantity');

            $total_orders = Order::where('delivery_status', '!=', 'passive_order')->count();

            // Delivered orders
            $delivered_orders = Order::where('delivery_status', '=', 'delivered')->orWhere('delivery_status', '=', 'passive_order')->count();
            //  Canceled orders
            $canclled_orders = Order::where('payment_status', 'cancelled')->count();
            // Paid orders
            $payed_orders = Order::where('payment_status', 'paid')->count();

            //  Processing orders
            $processing_orders = Order::where('delivery_status', '!=', 'delivered')
                ->where(function ($query) {
                    $query->where('payment_status', '!=', 'paid')
                        ->orWhere('payment_status', '!=', 'cancelled');
                })
                ->count();


            $on_the_way_orders = Order::where('delivery_status', 'on_the_way')->Where('payment_status', '!=', 'cancelled')->count();
            $shipped_orders = Order::where('delivery_status', 'shipped')->Where('payment_status', '!=', 'cancelled')->count();





            //Fetch Top Selling Products (highest quantity sold)
            $topSellingProducts = DB::table('order_details')
                ->select('product_id', 'product_title', DB::raw('SUM(quantity) as total_sold'))
                ->groupBy('product_id', 'product_title')
                ->orderByDesc('total_sold')
                ->limit(5)
                ->get();

            // Fetch Top Sellers (users with the most orders)
            $topSellers = Order::select('email', DB::raw('count(*) as order_count'))
                ->groupBy('email')
                ->orderByDesc('order_count') // Sort by the highest order count
                ->take(5) // Limit to top 5
                ->get();



            return view('admin.home', compact(
                'total_users',
                'total_product',
                'total_orders',
                'delivered_orders',
                'processing_orders',
                'revenue',
                'sold_products',
                'canclled_orders',
                'payed_orders',
                'on_the_way_orders',
                'shipped_orders',
                'topSellingProducts',
                'topSellers'
            ));
        } else {
            return redirect()->to('/');
        }
    }



    /*public function UserAccount()
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 0) {
                $user = Auth::user();
                $cartData = \App\Models\Cart::where('user_id', '=', $user->id)->get();
                return view('user.my-account', compact('user', 'cartData'));
            } else {
                return redirect()->route('login', ['lang' => app()->getLocale()]);
            }
        } else {
            return redirect()->route('login', ['lang' => app()->getLocale()]);
        }
    }*/

    public function UserLogout(Request $request): RedirectResponse
    {

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Cookie::queue(Cookie::forget('XSRF-TOKEN'));
        Cookie::queue(Cookie::forget('laravel_session'));
        return redirect('/home');
    }

    public function ProductDetails(Request $request, $id)
    {
        $id = $request->id;
        $product = Product::find($id);
        // check if a user is logged in
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $cartData = Cart::where('user_id', '=', $user_id)->get();
            return view('tiyya.products.product', compact('product', 'cartData'));
        } else {
            return view('tiyya.products.product', compact('product'));
        }
    }

    public function CategoryPage(Request $request, $name)
    {

        $category = Category::where('category_name', $request->name)->first();
        if (!$category) {
            abort(404);
        }

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $cartData = Cart::where('user_id', '=', $user_id)->get();
            return view('tiyya.products.categorie', compact('category', 'cartData'));
        } else {
            return view('tiyya.products.categorie', compact('category'));
        }
    }


    public function SaerchPage(Request $request)
    {
        $search = $request->query->get('query');
        $products = Product::where('title', 'LIKE', '%' . $search . '%')->get();
        $category = new \stdClass();
        $category->category_name = "Search: " . $search;
        $category->image = "/files/categorieImages/search.webp";
        $category->products = $products;

        if (!$category) {
            abort(404);
        }


        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $cartData = Cart::where('user_id', '=', $user_id)->get();
            return view('tiyya.products.categorie', compact('category', 'cartData'));
        } else {
            return view('tiyya.products.categorie', compact('category'));
        }
    }


    public function nouvotes(Request $request)
    {
        $category = (object)[
            'category_name' => 'Nouveautés',
            'image' => 'files/categorieImages/nouvotes.jpg',
            'products' => Product::latest()->take(10)->get()
        ];


        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $cartData = Cart::where('user_id', '=', $user_id)->get();
            return view('tiyya.products.categorie', compact('category', 'cartData'));
        } else {
            return view('tiyya.products.categorie', compact('category'));
        }
    }

    //rmoved
    /*
    public function ShopPage()
    {
        $categories = Category::all();
        $products = Product::all();
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $cartData = Cart::where('user_id', '=', $user_id)->get();
            return view('user.shop', compact('products', 'categories', 'cartData'));
        } else {
            return view('user.shop', compact('products', 'categories'));
        }
    }
    */
    //rmoved
    /*
    public function ContactPage()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $cartData = Cart::where('user_id', '=', $user_id)->get();
            return view('user.contact', compact('cartData'));
        } else {
            return view('user.contact');
        }
    }*/

    public function AddToCart(Request $request, $id)
    {
        dd($request);
        if (Auth::check()) {
            $user = Auth::user();
            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Product not found.',
                ], 404);
            }

            // Check if requested quantity exceeds available stock
            if ($product->qty > $product->qty) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'The requested quantity exceeds available stock.',
                    'available_quantity' =>  $product->qty,
                ], 400);
            }

            // Check if product is already in the cart
            $cart = Cart::where('product_id', $product->id)->where('user_id', $user->id)->first();

            if ($cart) {
                // If product exists, update quantity and price
                $cart->quantity += $request->quantity;
                $cart->price = strval(intval($cart->price) + intval($request->price) * $request->quantity);
                $cart->save();
            } else {
                // If product does not exist, create a new cart entry
                $cart = new Cart();
                $cart->user_id = $user->id;
                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->product_title = $product->title;
                $cart->product_id = $product->id;
                $cart->quantity = $request->quantity;
                $cart->price = strval(intval($request->price) * $request->quantity);
                $cart->image = $request->image;
                $cart->save();
            }

            // Update the product stock after adding it to the cart
            $product->qty -= $request->quantity;
            $product->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Product added to cart successfully.',
                'cart_item' => [
                    'id' => $cart->id,
                    'product_id' => $cart->product_id,
                    'name' => $cart->product_title,
                    'image' => $cart->image,
                    'quantity' => $cart->quantity,
                    'price' => $cart->price,
                    'unit' => $request->unit ?? null, // Include unit if provided
                ],
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'You need to log in to add items to the cart.',
            ], 401);
        }
    }

    /*
    public function CartPage()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $cartData = Cart::where('user_id', '=', $user_id)->get();
            return view('user.cart', compact('cartData'));
        } else {
            return redirect('login');
        }
    }*/

    public function RemoveProductFromCart($id)
    {
        if (Auth::check()) {
            $removing_product = Cart::find($id);
            if ($removing_product) {
                $product = Product::find($removing_product->product_id);
                if ($product) {
                    // Update the quantity of the product in the products table
                    $product->quantity += $removing_product->quantity;
                    $product->save();

                    // Remove the product from the cart
                    $removing_product->delete();

                    return redirect()->route('user.cart')->with('success', 'Product removed from cart!');
                } else {
                    return redirect()->back()->with('error', 'Product not found!');
                }
            } else {
                return redirect()->back()->with('error', 'Product not found in cart!');
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function ClearCart()
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())->delete();
            return redirect()->back()->with('success', 'Cart cleared successfully!');
        } else {
            return redirect('login');
        }
    }

    public function Checkout()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $cartData = Cart::where('user_id', '=', $user_id)->get();
            return view('user.checkout', compact('cartData'));
        } else {
            return redirect('login');
        }
    }

    /*
    public function CashOrder()
    {
        if (Auth::check()) {

            $user = Auth::user();
            $user_id = $user->id;
            $cartData = Cart::where('user_id', '=', $user_id)->get();

            foreach ($cartData as $data) {

                $order = new Order();
                $order->user_id = $data->user_id;
                $order->name = $data->name;
                $order->email = $data->email;
                $order->phone = $data->phone;
                $order->address = $data->address;
                $order->product_title = $data->product_title;
                $order->product_id = $data->product_id;
                $order->quantity = $data->quantity;
                $order->price = $data->price;
                $order->image = $data->image;
                $order->tracking_id = 'TRK' . Str::limit(uniqid('', true), 15 - strlen('TRK'), '');
                $order->delivery_status = 'pending';
                $order->payment_status = 'cash_on_delivery';
                $order->save();


                $cart_id = $data->id;
                $cart = Cart::find($cart_id);
                $cart->delete();

                Mail::to($data->email)->send(new OrderPlacedMail($order));
            }
            Alert::success('your order has been received', 'Your order has been received');
            return redirect()->route('user.orders');
        } else {
            redirect('login');
        }
    }

    public function UserOrders()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $cartData = Cart::where('user_id', '=', $user_id)->get();
            $orderData = Order::where('user_id', '=', $user_id)->where('delivery_status', '<>', 'passive_order')->get();
            $past_orders = Order::where('user_id', '=', $user_id)->where('delivery_status', '=', 'passive_order')->get();
            return view('user.orders', compact('orderData', 'cartData', 'past_orders'));
        } else {
            return redirect('login');
        }
    }
    */

    public function OrderReceived($id)
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            // get the order you want to update the delivery status for
            $order = Order::where('id', $id)->where('user_id', $user_id)->first();

            if ($order) {
                // update the delivery status
                $order->delivery_status = 'passive_order';
                $order->save();

                // redirect back to the order page with a success message
                return redirect()->back();
            } else {
                // if the order is not found, redirect back with an error message
                return redirect()->back()->with('error', 'Order not found.');
            }
        } else {
            return redirect('login');
        }
    }

    public function CancelOrder($id)
    {
        if (Auth::check()) {
            $user = Auth::user();
            // Get the order that needs to be canceled
            $order = Order::find($id);

            // Create a new cart item for the canceled order
            $cartItem = new Cart();
            $cartItem->user_id = $user->id;
            $cartItem->product_id = $order->product_id;
            $cartItem->quantity = $order->quantity;
            $cartItem->price = $order->price;
            $cartItem->name = $user->name;
            $cartItem->email = $user->email;
            $cartItem->phone = $user->phone;
            $cartItem->address = $user->address;
            $cartItem->product_title = $order->product_title;
            $cartItem->image = $order->image;
            $cartItem->save();

            // Delete the order
            $order->delete();
            Alert::success('Order Cancelled!', 'The Order Has Been Successfully Cancelled');
            return redirect()->back();
        } else {
            return redirect('login');
        }
    }

    public function Stripe($totalPrice)
    {
        if (Auth::check()) {
            return view('user.stripe', compact('totalPrice'));
        } else {
            return redirect('login');
        }
    }

    public function StripePost(Request $request, $totalPrice)
    {
        if (Auth::check()) {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            Stripe\Charge::create([
                "amount" => $totalPrice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks For Payment!"
            ]);

            $user = Auth::user();
            $user_id = $user->id;
            $cartData = Cart::where('user_id', '=', $user_id)->get();

            foreach ($cartData as $data) {

                $order = new Order();
                $order->user_id = $data->user_id;
                $order->name = $data->name;
                $order->email = $data->email;
                $order->phone = $data->phone;
                $order->address = $data->address;
                $order->product_title = $data->product_title;
                $order->product_id = $data->product_id;
                $order->quantity = $data->quantity;
                $order->price = $data->price;
                $order->image = $data->image;
                $order->tracking_id = 'TRK' . Str::limit(uniqid('', true), 15 - strlen('TRK'), '');
                $order->delivery_status = 'pending';
                $order->payment_status = 'paid';
                $order->save();


                $cart_id = $data->id;
                $cart = Cart::find($cart_id);
                $cart->delete();
            }

            Session::flash('success', 'Payment successful!');
            Alert::success('Payment Successfully Done!', 'Your order has been received');

            return redirect()->route('user.orders');
        } else {
            return redirect('login');
        }
    }

    public function SearchProduct(Request $request)
    {
        $searchText = $request->search;
        $products  = Product::where('title', 'LIKE', "%$searchText%")->orWhere('ram', 'LIKE', "%$searchText%")->orWhere('category', 'LIKE', "%$searchText%")->get();
        $categories = Category::all();
        // check if a user is logged in
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $cartData = Cart::where('user_id', '=', $user_id)->get();
            return view('user.shop', compact('products', 'categories', 'cartData'));
        } else {
            return view('user.shop', compact('products', 'categories'));
        }
    }

    public function UpdatePassword()
    {
        if (Auth::check()) {
            return view('profile.update-profile-information-form');
        } else {
            return redirect('login');
        }
    }

    public function GetTechnologyNews()
    {
        $apiKey = env('NEWS_API_KEY');
        $response = Http::get("https://newsapi.org/v2/top-headlines?category=technology&language=en&pageSize=4&apiKey={$apiKey}");
        $data = $response->json();
        $articles = $data['articles'];
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $cartData = Cart::where('user_id', '=', $user_id)->get();
            return view('user.news', compact('articles', 'cartData'));
        } else {
            return view('user.news', compact('articles'));
        }
    }
}
