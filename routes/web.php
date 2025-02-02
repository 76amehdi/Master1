<?php

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use App\Models\AstuceBeaute;
use Illuminate\Http\Request;
use App\Mail\OrderPlacedMail;
use App\Models\HomepageSetting;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\ReportController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\AstuceBeauteController;
use App\Http\Controllers\CategoryDisplayController;
use App\Http\Controllers\FeaturedProductController;
use App\Http\Controllers\HomepageSettingController;
use App\Http\Controllers\PurchasePaymentController;
use App\Models\Contact;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return redirect()->to(app()->getLocale() . '/home');
})->name('index');
Route::get('/home', function () {
    return redirect()->to(app()->getLocale() . '/home');
})->name('index');

Route::get('/login', function () {
    return redirect()->to(app()->getLocale() . '/login');
})->name('login');

Route::group(
    ['middleware' => 'locale', 'prefix' => '{lang}', 'where' => ['lang' => 'en|ar|fr']],
    function () {
        Route::get('/', function () {
            $settings = HomepageSetting::first();
            $featuredProducts = \App\Models\FeaturedProduct::with('product')->orderBy('display_order')->get();
            $categoryDisplays = \App\Models\CategoryDisplay::with('category')->orderBy('display_order')->get();

            if (Auth::check()) {
                $user = Auth::user();
                $cart = Cart::where('user_id', $user->id)->get();
                //return view('tiyya.home', compact('cart', 'settings', 'featuredProducts', 'categoryDisplays'))->with('dbCart', json_encode($cart));
                return redirect()->to(app()->getLocale() . '/home');
            } else {
                //return view('tiyya.home', compact('settings', 'featuredProducts', 'categoryDisplays'));
                return redirect()->to(app()->getLocale() . '/home');
            }
        })->name('index');

        Route::get('/home', function () {
            $settings = \App\Models\HomepageSetting::first();
            $featuredProducts = \App\Models\FeaturedProduct::with('product')->orderBy('display_order')->get();
            $categoryDisplays = \App\Models\CategoryDisplay::with('category')->orderBy('display_order')->get();
            $localisation = Contact::first();

            $cart = [];

            if (Auth::check()) {
                $user = Auth::user();
                $cart = \App\Models\Cart::where('user_id', $user->id)->get();

                return view('tiyya.home', compact('cart', 'settings', 'featuredProducts', 'categoryDisplays','localisation'))->with('dbCart', json_encode($cart));
            } else {
                return view('tiyya.home', compact('settings', 'featuredProducts', 'categoryDisplays','localisation'));
            }
        })->name("home");
        Route::get('category/nouvotes', [HomeController::class, 'nouvotes'])->name('category.nouvotes');

        Route::get('/category/{name}', [HomeController::class, 'CategoryPage'])->name('category.page');

        Route::get('/saerch', [HomeController::class, 'SaerchPage'])->name('saerch.page');

        Route::get('/product_details/{id}', [HomeController::class, 'ProductDetails'])->name('productDetails');
        Route::get('checkoutt', function () {
            $settings = HomepageSetting::first();
            $featuredProducts = \App\Models\FeaturedProduct::with('product')->orderBy('display_order')->get();
            $categoryDisplays = \App\Models\CategoryDisplay::with('category')->orderBy('display_order')->get();
            $localisation = Contact::first();

            $user = Auth::user();
            $cart = $user ? Cart::where('user_id', $user->id)->get() : "null";
            return view("tiyya.account.checkout", compact('cart', 'settings', 'featuredProducts', 'categoryDisplays','localisation'));
        })->name('checkoutt');

        Route::get('/cart', function () {
            $settings = HomepageSetting::first();
            $featuredProducts = \App\Models\FeaturedProduct::with('product')->orderBy('display_order')->get();
            $categoryDisplays = \App\Models\CategoryDisplay::with('category')->orderBy('display_order')->get();

            $user = Auth::user();
            $cart = $user ? Cart::where('user_id', $user->id)->get() : null;
            if ($user) {
                return view("tiyya.account.cart", compact('cart', 'settings', 'featuredProducts', 'categoryDisplays'));
            } else {
                return view("tiyya.account.cart", compact('cart', 'settings', 'featuredProducts', 'categoryDisplays'));
            }
        })->name('cart');
        Route::get('/checkout', function () {

            $settings = HomepageSetting::first();

            return view('tiyya.account.checkoutOne', compact('settings'));
        })->name('checkout.show');
        Route::get('/login', [RegisterController::class, "LoginForm"])->name("login");


        Route::get('/register', [RegisterController::class, "index"])->name("register");

        Route::post('/register', [RegisterController::class, "register"])->name("register");

        Route::get('/apropos', function () {
            $settings = HomepageSetting::first();
            $featuredProducts = \App\Models\FeaturedProduct::with('product')->orderBy('display_order')->get();
            $categoryDisplays = \App\Models\CategoryDisplay::with('category')->orderBy('display_order')->get();

            return view('tiyya.pages.apropos', compact('settings', 'featuredProducts', 'categoryDisplays'));
        })->name('apropos');

        Route::get('/account', [UserController::class, "account"])->name('account');

        Route::get('/contact', function () {
            $settings = HomepageSetting::first();
            $featuredProducts = \App\Models\FeaturedProduct::with('product')->orderBy('display_order')->get();
            $categoryDisplays = \App\Models\CategoryDisplay::with('category')->orderBy('display_order')->get();

            return view('tiyya.pages.contact', compact('settings', 'featuredProducts', 'categoryDisplays'));
        })->name('contact');

        Route::get('/terms-of-service', function () {
            $settings = HomepageSetting::first();
            $featuredProducts = \App\Models\FeaturedProduct::with('product')->orderBy('display_order')->get();
            $categoryDisplays = \App\Models\CategoryDisplay::with('category')->orderBy('display_order')->get();

            return view('tiyya.policies.termsofservice', compact('settings', 'featuredProducts', 'categoryDisplays'));
        })->name('terms-of-service',);
        Route::get('blogs/{category}', [AstuceBeauteController::class, 'showCategory'])->name('blog.category');
        Route::get('blog_astuce/{category_id}', [AstuceBeauteController::class, 'showAstuce'])->name('blog_astuce.showastuce');

        route::get('/my-account', [HomeController::class, 'UserAccount'])->name('user.account');
        
        Route::middleware(['auth:sanctum'])->group(function () {

            route::get('/dashboard', [HomeController::class, 'Home'])->name('dashboard');
            Route::get('/admin/astuces', [AstuceBeauteController::class, 'index'])->name('index');
            route::get('/view_category', [AdminController::class, 'ViewCategory'])->name('admin.category');
            Route::get('/admin/settings', [HomepageSettingController::class, 'index'])->name('admin.settings');
            Route::get('purchases', [PurchaseController::class, 'index'])->name('purchases.index');
            Route::get('/purchases/create', [PurchaseController::class, 'create'])->name('purchases.create');
            route::get('/customers', [AdminController::class, 'Customers'])->name("customers");
            Route::get('fournisseurs', [FournisseurController::class, "index"])->name('fournisseurs.index');

            Route::get('/purchases/{purchase}', [PurchaseController::class, 'show'])->name('purchases.show');

            Route::prefix('admin')->group(function () {
                Route::resource('contacts', ContactController::class);
             });

            Route::get('/sales-report', [ReportController::class, 'index'])->name('reports.index');
            Route::get('/sales-report/pdf', [ReportController::class, 'exportPdf'])->name('reports.exportPdf');

            Route::get('/reports/sales', [ReportController::class, 'salesReport'])->name('reports.sales');
            Route::get('/reports/purchase_report', [ReportController::class, 'purchaseReport'])->name('reports.purchase_report');
            Route::get('/reports/gross-profit', [ReportController::class, 'grossProfitReport'])->name('reports.gross_profit');
            Route::get('/reports/supplier', [ReportController::class, 'supplierReport'])->name('reports.supplier');
            Route::get('/reports/warehouse_report', [ReportController::class, 'warehouseReport'])->name('reports.warehouse_report');
            Route::get('/reports/payment', [ReportController::class, 'paymentAnalysis'])->name('reports.payment');
            Route::get('/reports', [ReportController::class, 'allReports'])->name('all.reports');
            Route::get('/reports/combined-reports', [ReportController::class, 'combinedReports'])->name('combined.reports');

            Route::get('/warehouses/{warehouse}/warehouse_details_report', [ReportController::class, 'report_werhouse_details'])->name('reports.warehouse_details_report');

            route::get('/view_warehouse', [AdminController::class, 'Viewwarehouse'])->name('admin.warehouse');
            route::get('/view_product', [AdminController::class, 'ViewProduct'])->name('admin.view_product');
            route::get('/show_product', [AdminController::class, 'ShowProduct'])->name('admin.show_product');
            route::get('/edit_product/{id}', [AdminController::class, 'EditProduct'])->name('admin.edit_product');
            /* Secure Routes (Fournisseur, Warehouses, Reports) */
            Route::get('/warehouses', [WarehouseController::class, 'index'])->name('warehouses.index');
            Route::get('/warehouses/{warehouse}', [WarehouseController::class, 'show'])->name('warehouses.show');
            Route::put('/warehouses/{warehouse}', [WarehouseController::class, 'update'])->name('admin.update_warehouse');
            Route::get('/warehouse/transfer', [WarehouseController::class, 'index'])->name('warehouses.transfer');
            Route::post('/warehouse/transfer', [WarehouseController::class, 'transfer']);

            Route::get('/reports/products', [ReportsController::class, 'productsReport'])->name('reports.products');
            Route::get('/reports/orders', [ReportsController::class, 'ordersReport'])->name('reports.orders');
            Route::get('/reports/purchases', [ReportsController::class, 'purchasesReport'])->name('reports.purchases');
            Route::get('/reports/customers', [ReportsController::class, 'customersReport'])->name('reports.customers');
            Route::get('/admin/purchases/{purchaseId}/payment', [PurchasePaymentController::class, 'showPaymentForm'])->name('purchases.payment.form');
        });
    }
);


$settings = HomepageSetting::first();
$featuredProducts = \App\Models\FeaturedProduct::with('product')->orderBy('display_order')->get();
$categoryDisplays = \App\Models\CategoryDisplay::with('category')->orderBy('display_order')->get();
$localisation = Contact::first();
view::share('localisation');
view::share('settings');
view::share('featuredProducts');
view::share('categoryDisplays');


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    /* Secure Routes (Fournisseur, Warehouses, Reports) */
    //Route::resource('fournisseurs', FournisseurController::class);
    Route::get('/print-filtered-purchases', [PurchaseController::class, 'printFilteredPurchases'])->name('purchases.print_filtered');

    Route::get('/fournisseurs/create', [FournisseurController::class, 'create'])->name('fournisseurs.create');

    // Store a new fournisseur
    Route::post('/fournisseurs/store', [FournisseurController::class, 'store'])->name('fournisseurs.store');

    // Display a single fournisseur
    Route::get('/fournisseurs/{id}', [FournisseurController::class, 'show'])->name('fournisseurs.show');

    // Show form to edit an existing fournisseur
    Route::get('/fournisseurs/{id}/edit', [FournisseurController::class, 'edit'])->name('fournisseurs.edit');

    // Update an existing fournisseur
    Route::put('/fournisseurs/{id}', [FournisseurController::class, 'update'])->name('fournisseurs.update');

    // Delete a fournisseur
    Route::delete('/fournisseurs/{id}', [FournisseurController::class, 'destroy'])->name('fournisseurs.destroy');

    Route::get('/warehouses', [WarehouseController::class, 'index'])->name('warehouses.index');
    Route::get('/warehouses/{warehouse}', [WarehouseController::class, 'show'])->name('warehouses.show');
    Route::put('/warehouses/{warehouse}', [WarehouseController::class, 'update'])->name('admin.update_warehouse');
    //Route::get('/warehouse/transfer', [WarehouseController::class, 'index'])->name('warehouses.transfer');
    Route::post('/warehouse/transfer', [WarehouseController::class, 'transfer']);

    Route::get('/reports/products', [ReportsController::class, 'productsReport'])->name('reports.products');
    Route::get('/reports/orders', [ReportsController::class, 'ordersReport'])->name('reports.orders');
    Route::get('/reports/purchases', [ReportsController::class, 'purchasesReport'])->name('reports.purchases');
    Route::get('/reports/customers', [ReportsController::class, 'customersReport'])->name('reports.customers');
});

/* Admin Routes */
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    //Route::resource('users', UserController::class);
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

    // Store a new user.
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');

    // Show the form to edit a user.
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

    // Update a user.
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

    // Delete a user.
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('users/{id}/roles', [UserController::class, 'manageRoles'])->name('users.roles');
    Route::put('users/{id}/roles', [UserController::class, 'updateRoles'])->name('users.roles.update');

    route::post('/add_category', [AdminController::class, 'AddCategory'])->name('admin.add_category');
    route::get('/delete_category/{id}', [AdminController::class, 'DeleteCategory'])->name('delete.category');
    Route::POST('/update_category/{id}', [AdminController::class, 'UpdateCategory'])->name('update.category');

    route::post('/add_warehouse', [AdminController::class, 'Addwarehouse'])->name('admin.add_warehouse');
    route::get('/delete_warehouse/{id}', [AdminController::class, 'Deletewarehouse']);

    route::post('/add_product', [AdminController::class, 'AddProduct'])->name('admin.add_product');
    route::get('/delete_product/{id}', [AdminController::class, 'DeleteProduct'])->name('admin.delete_product');
    route::put('/update_product/{id}', [AdminController::class, 'UpdateProduct']);
    Route::get('/remove-product-image/{id}', [AdminController::class, 'removeImage'])->name('removeImage');

    Route::get('/search-product', [AdminController::class, 'SearchProduct']);

    Route::get('/search-order', [AdminController::class, 'SearchOrder']);
    Route::get('/order-details/{id}', [AdminController::class, 'getOrderDetails']);

    route::get('/update-order/{order_id}/{delivery_status}', [AdminController::class, 'UpdateOrder']);
    Route::get('/update-payment/{order_id}/{payment_status}', [AdminController::class, 'UpdateOrderPayment'])->name('update-payment');

    route::get('/print-bill/{order_id}', [AdminController::class, 'PrintBill']);
    route::get('/print-ticket/{order_id}', [AdminController::class, 'PrintTicket']);

    route::get('/delete-user/{id}', [AdminController::class, 'DeleteUser']);
    Route::get('/search-user', [AdminController::class, 'SearchUser']);

    Route::get('/purchases/{purchase_id}/print', [PurchaseController::class, 'PrintRapport'])
        ->name('purchases.print');
    Route::get('/purchases/{purchase_id}/payments/print', [PurchasePaymentController::class, 'printPayments'])->name('purchases.print_payments');
    // routes/web.php
    Route::get('/purchases/print-all', [PurchaseController::class, 'printAllPurchases'])->name('purchases.print_all');



    Route::get('/check-low-stock', [ProductController::class, 'checkLowStock']);




    // Admin Settings Routes
    Route::put('/admin/settings/{settings}', [HomepageSettingController::class, 'update'])->name('admin.settings.update');
    Route::post('/admin/settings', [HomepageSettingController::class, 'store'])->name('admin.settings.store');


    // Admin Featured Product Routes
    Route::get('/admin/featured-products', [FeaturedProductController::class, 'index'])->name('admin.featured_products.index');
    Route::post('/admin/featured-products', [FeaturedProductController::class, 'store'])->name('admin.featured_products.store');
    Route::put('/admin/featured-products/{featuredProduct}', [FeaturedProductController::class, 'update'])->name('admin.featured_products.update');
    Route::delete('/admin/featured-products/{featuredProduct}', [FeaturedProductController::class, 'destroy'])->name('admin.featured_products.destroy');

    // Admin Category Display Routes
    Route::get('/admin/category-displays', [CategoryDisplayController::class, 'index'])->name('admin.category_displays.index');
    Route::post('/admin/category-displays', [CategoryDisplayController::class, 'store'])->name('admin.category_displays.store');
    Route::put('/admin/category-displays/{categoryDisplay}', [CategoryDisplayController::class, 'update'])->name('admin.category_displays.update');
    Route::delete('/admin/category-displays/{categoryDisplay}', [CategoryDisplayController::class, 'destroy'])->name('admin.category_displays.destroy');

    Route::prefix('admin/categories')->name('admin.categories.')->group(function () {
        Route::get('/{id}/edit', [AdminController::class, 'editCategory']);
    });
});

if (Auth::check()) {
    $user = Auth::user();
    $cart = Cart::where('user_id', $user->id)->get(); // This returns a collection
} else {
    $cart = collect(); // If not authenticated, use an empty collection
}

View::share('cart', $cart);
/*
Route::get('/home', function () {
    if (Auth::check()) {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->get();
        return view('tiyya.home', compact('cart'));
    } else {
        return view('tiyya.home');
    }
})->name("home");
*/






route::get('/user/logout', [HomeController::class, 'UserLogout'])->name('user.logout');
Route::get('/product_details/{id}', [HomeController::class, 'ProductDetails']);
//Route::get('/shop', [HomeController::class, 'ShopPage'])->name('user.shop');
//Route::get('/contact', [HomeController::class, 'ContactPage'])->name('user.contact');
//route::get('/', [HomeController::class, 'index']);
//route::get('/home', [HomeController::class, 'Home'])->name('home')->middleware('auth', 'verified');


/*
Route::post('/add-to-cart/{id}', [HomeController::class, 'AddToCart']);
*/

/*
Route::post('/add-to-cart/{id}', function ($id, Request $request) {
    $user = Auth::user();
    Cart::create([
        'user_id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'phone' => $user->phone,
        'address' => $user->address,
        'product_title' => $request->name,
        'product_id' => $id,
        'quantity' => $request->quantity,
        'price' => strval(floatval($request->price) * $request->quantity),
        'unit' => $request->unit,
        'image' => $request->image,
    ]);
    return response()->json([
        'message' => 'Test response',
        'user_id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'phone' => $user->phone,
        'address' => $user->address,
        'product_id' => $id,
        'title' => $request->name,
        'quantity' => $request->quantity,
        'unit' => $request->unit,
        'price' => $request->price,
        'total' => $request->quantity * $request->price,
    ]);
};


*/

Route::post('/add-to-cart/{id}', function ($id, Request $request) {
    if (Auth::check()) {
        $user = Auth::user();

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'unit' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        // Check if the product with the same unit already exists in the cart
        $cart = Cart::where('product_id', $id)
            ->where('user_id', $user->id)
            ->where('unit', $request->unit)
            ->first();

        if ($cart) {
            // Update quantity and price
            $cart->quantity = $request->quantity;

            if ($cart->quantity <= 0) {
                // Remove cart item if quantity becomes 0
                $cart->delete();
            } else {
                // Update price and save
                $cart->price = strval(floatval($request->price) * $request->quantity);
                $cart->save();
            }
        } else {
            // Insert new cart item if quantity > 0
            if ($request->quantity > 0) {
                Cart::create([
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'address' => $user->address,
                    'product_title' => $request->name,
                    'product_id' => $id,
                    'quantity' => $request->quantity,
                    'price' => strval(floatval($request->price) * $request->quantity),
                    'unit' => $request->unit,
                    'image' => $request->image,
                ]);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Cart updated successfully!',
        ]);
    } else {
        return response()->json([
            'status' => 'error',
            'message' => 'You need to log in to update the cart.',
        ], 401);
    }
});




Route::post('/update-in-cart/{id}', function ($id, Request $request) {
    return response()->json([
        'message' => 'Test response',
        'user_id' => Auth::user()->id,
        'product_id' => $id,
        'cart_item' => $request->all(),
    ]);
});





//Route::get('/my-cart', [HomeController::class, 'CartPage'])->name('user.cart');
//Route::get('/remove-product-from-cart/{id}', [HomeController::class, 'RemoveProductFromCart']);
//Route::get('/clear-cart', [HomeController::class, 'ClearCart'])->name('user.clear_cart');
//Route::get('/checkout', [HomeController::class, 'Checkout'])->name('user.checkout');
Route::get('/orders', [HomeController::class, 'UserOrders'])->name('user.orders');
Route::get('/order-received/{id}', [HomeController::class, 'OrderReceived']);
Route::get('/cancel-order/{id}', [HomeController::class, 'CancelOrder']);
Route::get('/search-a-product', [HomeController::class, 'SearchProduct']);
Route::get('/update-password', [HomeController::class, 'UpdatePassword']);
//Route::get('/technology-news', [HomeController::class, 'GetTechnologyNews'])->name('news');


//Route::get('/cash-order', [HomeController::class, 'CashOrder']);
//Route::get('/stripe/{totalPrice}', [HomeController::class, 'Stripe']);
//Route::post('/stripe/{totalPrice}', [HomeController::class, 'StripePost'])->name('stripe.post');


Route::get('/testjs', function () {
    $texts = ['text1' => 'Welcome to Image 1', 'text2' => 'Explore Image 2'];
    return view('test', compact('texts'));
})->name('testjs');

$routes = Category::all();

$categories = AstuceBeaute::distinct()->pluck('category')->toArray();
$beautyTips = [];
foreach ($categories as $category) {
    // Generate the URL.  I am using `str_replace` to replace spaces with dashes and convert to lowercase
    $url = 'blogs/' . strtolower($category) ;
    $beautyTips[$category] = $url;
}

// Share the variables with all views
View::share('routes', $routes);
View::share('beautyTips', $beautyTips);


Route::get('/tiyya', function () {
    return view('tiyya.index');
});

//Route::get('/category/{name}', [HomeController::class, 'CategoryPage'])->name('category.page');
//Route::get('/check', function () {
//   return view('tiyya.account.checkout');
//});

Route::get('/prods/{id}', function ($id) {
    $product = Product::findOrFail($id);
    return response()->json([
        'product' => $product,
        'units' => $product->units,
        'image_url' => $product->images()->get("image_path")->first(),

    ]);
});



// Assuming your Product model has an 'images' relation
Route::get('/products/{id}', function ($id) {
    $product = Product::with('images')->findOrFail($id);
    return response()->json([
        'product' => $product,
        'image_url' => $product->images->first() ? $product->images->first()->image_path : null,
    ]);
});


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::prefix('admin/purchases/{purchaseId}')->group(function () {
        Route::post('payment', [PurchasePaymentController::class, 'storePayment'])->name('purchases.payment.store');
    });
    Route::get('purchases/{purchaseId}/payments', [PurchasePaymentController::class, 'showPayments'])->name('purchases.payments.show');

    //Route::resource('purchases', PurchaseController::class);

    // Store a new purchase
    Route::post('/purchases/store', [PurchaseController::class, 'store'])->name('purchases.store');

    // Display a single purchase
    Route::get('/purchases/{purchase}/edit', [PurchaseController::class, 'edit'])->name('purchases.edit');

    // Update an existing purchase
    Route::put('/purchases/{purchase}/update', [PurchaseController::class, 'update'])->name('purchases.update');


    Route::delete('/purchases/{purchase}/delete', [PurchaseController::class, 'destroy'])->name('purchases.destroy');
});

Route::post('/sync-cart', [CartController::class, 'syncCart'])->name('cart.sync');

route::post('orders/create', [CartController::class, 'storeOrder'])->name('orders.create');




Route::middleware(['auth'])->group(function () {
    Route::prefix('admin/astuces')->name('admin.astuces.')->group(function () {
        Route::get('/', [AstuceBeauteController::class, 'index'])->name('index');
        Route::post('/store', [AstuceBeauteController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AstuceBeauteController::class, 'edit'])->name('edit');
        Route::get('/{id}/show', [AstuceBeauteController::class, 'show'])->name('show');
        Route::put('/{id}/update', [AstuceBeauteController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [AstuceBeauteController::class, 'destroy'])->name('destroy');
    });
});

Route::get('/warehouse/transfer', [WarehouseController::class, 'index'])->name('warehouses.transfer');
Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::get('/user-orders', [AdminController::class, 'UserOrders'])->name('admin.user_orders');
