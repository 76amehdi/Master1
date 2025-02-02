<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Warehouse;
use App\Models\ProductUnit;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\HomepageSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public $settings;
    public $featuredProducts;
    public $categoryDisplays;
    public function __construct()
    {
        $this->settings = HomepageSetting::first();
        $this->featuredProducts = \App\Models\FeaturedProduct::with('product')->orderBy('display_order')->get();
        $this->categoryDisplays = \App\Models\CategoryDisplay::with('category')->orderBy('display_order')->get();

        View::share('settings', $this->settings);
        View::share('featuredProducts', $this->featuredProducts);
        View::share('categoryDisplays', $this->categoryDisplays);
    }


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

    public function ViewCategory()
    {
        if (!$this->checkPermission('manage_categories')) {
            return redirect()->route('home', ['lang' => app()->getLocale()])->with('error', 'You do not have permission to access this page.');
        }

        $categories = Category::all();
        return view('admin.category', compact('categories'));
    }




    // Delete a category by ID

    public function DeleteCategory($id)
    {
        if (!$this->checkPermission('manage_categories')) {
            return redirect()->route('home', ['lang' => app()->getLocale()])->with('error', 'You do not have permission to access this page.');
        }
        $category = Category::findOrFail($id);

        // Delete associated image file from storage
        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        // Delete category
        $category->delete();

        return redirect()->back()->with('message', 'Category Deleted Successfully');
    }


    public function ViewWarehouse()
    {
        if (!$this->checkPermission('manage_warehouses')) {
            return redirect()->route('home', ['lang' => app()->getLocale()])->with('error', 'You do not have permission to access this page.');
        }

        $warehouses = Warehouse::all();
        return view('admin.warehouse', compact('warehouses'));
    }

    public function AddWarehouse(Request $request)
    {
        if (!$this->checkPermission('manage_warehouses')) {
            return redirect()->route('home', ['lang' => app()->getLocale()])->with('error', 'You do not have permission to access this page.');
        }

        $data = new Warehouse();
        $data->name = $request->name;
        $data->location = $request->location;
        $data->save();
        return redirect()->back()->with('message', 'Warehouse Added Successfully');
    }

    public function DeleteWarehouse($id)
    {
        if (!$this->checkPermission('manage_warehouses')) {
            return redirect()->route('home', ['lang' => app()->getLocale()])->with('error', 'You do not have permission to access this page.');
        }

        $Warehouse = Warehouse::find($id);
        $Warehouse->delete();
        return redirect()->back();
    }

    public function ViewProduct()
    {
        if (!$this->checkPermission('manage_products')) {
            return redirect()->route('home', ['lang' => app()->getLocale()])->with('error', 'You do not have permission to access this page.');
        }

        $categories = Category::all();
        $warehouses =  Warehouse::all();
        return view('admin.add_product', compact('categories', 'warehouses'));
    }

    public function ShowProduct()
    {
        if (!$this->checkPermission('manage_products')) {
            return redirect()->route('home', ['lang' => app()->getLocale()])->with('error', 'You do not have permission to access this page.');
        }

        $categories = Category::all();
        $products = Product::orderBy('id', 'desc')->get();
        return view('admin.show_product', compact('products', 'categories'));
    }

    public function DeleteProduct($id)
    {
        if (!$this->checkPermission('manage_products')) {
            return redirect()->route('home', ['lang' => app()->getLocale()])->with('error', 'You do not have permission to access this page.');
        }
        $product = Product::find($id);
        $product->delete();
        return redirect()->back()->with('message', 'The Product has been deleted successfully');
    }

    public function EditProduct(Request $request)
    {
        $id = $request->id;
        if (!$this->checkPermission('manage_products')) {
            return redirect()->route('home', ['lang' => app()->getLocale()])->with('error', 'You do not have permission to access this page.');
        }
        $product = Product::find($id);
        $colors = json_decode($product->colors, true);
        $categories = Category::all();
        $warehouses =  Warehouse::all();
        $productImages = ProductImage::where('product_id', $product->id)->get();
        $productUnits = ProductUnit::where('product_id', $product->id)->get();
        return view('admin.edit_product', compact('product', "categories", "warehouses", "productImages", "productUnits", "colors"));
    }

    public function AddCategory(Request $request)
    {
        if (!$this->checkPermission('manage_categories')) {
            return redirect()->route('home', ['lang' => app()->getLocale()])->with('error', 'You do not have permission to access this page.');
        }

        $data = new Category();

        // Validate input data
        $request->validate([
            'category' => 'required|string|max:255',
            'categorieImage' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('categorieImage')) {
            $image = $request->file('categorieImage');
            $imageName = time() . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();

            // Store image in public/files/categorieImages directory
            $image->move(public_path('files/categorieImages'), $imageName);

            // Save the image path in the database
            $data->image = 'files/categorieImages/' . $imageName;
        }

        // Save category
        $data->category_name = $request->category;
        $data->save();

        return redirect()->back()->with('message', 'Category Added Successfully');
    }
    // Update an existing category by ID

    public function UpdateCategory($id, Request $request)
    {
        if (!$this->checkPermission('manage_categories')) {
            return redirect()->route('home', ['lang' => app()->getLocale()])->with('error', 'You do not have permission to access this page.');
        }
        $category = Category::findOrFail($id);

        // Validate input data
        $request->validate([
            'category' => 'required|string|max:255',
            'categorieImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Handle image upload if a new file is provided
        if ($request->hasFile('categorieImage')) {
            // Delete old image from public/files directory
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }

            // Upload new image to public/files/categorieImages

            $image = $request->file('categorieImage');
            $imageName = time() . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('files/categorieImages'), $imageName);
            $category->image = 'files/categorieImages/' . $imageName;
        }

        // Update category name
        $category->category_name = $request->category;
        $category->save();

        return redirect()->back()->with('message', 'Category Updated Successfully');
    }



    public function AddProduct(Request $request)
    {
        if (!$this->checkPermission('manage_products')) {
            return redirect()->route('home', ['lang' => app()->getLocale()])->with('error', 'You do not have permission to access this page.');
        }

        // Validation
        $rules = [
            'title' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'description' => 'required|string',
            'warehouse' => 'required|exists:warehouses,id',
            'brand' => 'string|max:255',
            'unit.*' => 'string',
            'price.*' => 'required|numeric|min:0',
            'ingredient' => 'nullable|string|max:255',
            'utilisation' => 'nullable|string|max:255',
            'result' => 'nullable|string|max:255',
            'colors' => 'nullable|array',
            'colors.*' => 'string|max:50',
            'recuperation_from_shop' => 'boolean',
        ];

        // Add validation for the first image (required), and all other images optional
        $rules['image1'] = 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048';
        for ($i = 2; $i <= 10; $i++) {
            $rules['image' . $i] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048';
        }


        $validated = $request->validate($rules);

        // Create new product
        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->qty = 0;
        $product->category_id = $request->category;
        $product->warehouse_id = $request->warehouse;
        $product->brand = $request->brand;
        $product->ingredient = $request->ingredient;
        $product->utilisation = $request->utilisation;
        $product->result = $request->result;
        $product->colors = json_encode($request->colors); // Store as JSON
        $product->recuperation_from_shop = $request->recuperation_from_shop ?? 0;
        $product->save();

        // Loop through all possible image fields (image1 to image10)
        for ($i = 1; $i <= 10; $i++) {
            $imageField = 'image' . $i;
            if ($request->hasFile($imageField)) {
                $image = $request->file($imageField); // Get the uploaded file

                // Generate a unique name for the image
                $imageName = time() . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();

                // Store the image in public/files/products_images directory
                $image->move(public_path('files/products_images'), $imageName);

                // Save the image path in the database
                $productImage = new ProductImage();
                $productImage->product_id = $product->id;
                $productImage->image_path = 'files/products_images/' . $imageName;
                $productImage->save();
            }
        }


        // Save multiple product units
        foreach ($request->unit as $index => $unit) {
            $productUnit = new ProductUnit();
            $productUnit->product_id = $product->id;
            $productUnit->unit = $unit;
            $productUnit->price = $request->price[$index];
            $productUnit->discount_price = $request->discount_price[$index] ?? null;
            $productUnit->save();
        }

        Alert::success('Product Added Successfully!', 'You have added a new product');
        return redirect()->route('admin.show_product', ['lang' => app()->getLocale()]);
    }

    public function UpdateProduct(Request $request, $id)
    {
        if (!$this->checkPermission('manage_products')) {
            return redirect()->route('home', ['lang' => app()->getLocale()])->with('error', 'You do not have permission to access this page.');
        }

        // Validation rules
        $rules = [
            'title' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'description' => 'nullable|string|max:1000',
            'quantity' => 'numeric|min:0',
            'warehouse' => 'required|exists:warehouses,id',
            'brand' => 'nullable|string|max:255',
            'ingredient' => 'nullable|string|max:255',
            'utilisation' => 'nullable|string|max:255',
            'result' => 'nullable|string|max:255',
            'unit.*' => 'string|nullable',
            'price.*' => 'required_with:unit.*|numeric|min:0',
            'colors' => 'nullable|array',
            'colors.*' => 'string|max:50',
        ];


        // Add validation for the first image (required), and all other images optional
        $rules['image1'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048';
        for ($i = 2; $i <= 10; $i++) {
            $rules['image' . $i] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048';
        }

        $request->validate($rules);

        $product = Product::findOrFail($id);

        // Update product details
        $product->update([
            'title' => $request->title,
            'description' => $request->description,
            'qty' => $product->qty,
            'category_id' => $request->category,
            'warehouse_id' => $request->warehouse,
            'brand' => $request->brand,
            'ingredient' => $request->ingredient,
            'utilisation' => $request->utilisation,
            'colors' => $request->has('colors') && !empty($request->colors) ? json_encode($request->colors) : "null",
            'result' => $request->result,
        ]);

        // Handle images
        // Fetch existing images for the product
        $existingImages = \App\Models\ProductImage::where('product_id', $id)->get();

        // Loop through all possible image fields (image1 to image10)
        for ($i = 1; $i <= 10; $i++) {
            $imageField = 'image' . $i;
            if ($request->hasFile($imageField)) {
                $newImage = $request->file($imageField);

                // Generate a unique name for the image
                $newImageName = time() . rand(1000, 9999) . '.' . $newImage->getClientOriginalExtension();

                // Determine which existing image to update
                $existingImage = $existingImages->get($i - 1) ?? null;

                if ($existingImage) {
                    // Delete the old image from public/files directory
                    if ($existingImage->image_path && file_exists(public_path($existingImage->image_path))) {
                        unlink(public_path($existingImage->image_path));
                    }

                    // Update the existing record with the new image
                    $newImage->move(public_path('files/products_images'), $newImageName);

                    $existingImage->update([
                        'image_path' => 'files/products_images/' . $newImageName,
                    ]);
                } else {
                    // Create a new image record if no existing image
                    $newImage->move(public_path('files/products_images'), $newImageName);
                    ProductImage::create([
                        'product_id' => $id,
                        'image_path' => 'files/products_images/' . $newImageName,
                    ]);
                }
            }
            // Handle the deletion of the record and image from directory if user removed and not provided other image
            else {
                $existingImage = $existingImages->get($i - 1) ?? null;

                if ($existingImage && $request->input('remove_image_' . $i) == 1) {
                    if ($existingImage->image_path && file_exists(public_path($existingImage->image_path))) {
                        unlink(public_path($existingImage->image_path));
                    }
                    $existingImage->delete();
                }
            }
        }



        // Handle units and prices
        ProductUnit::where('product_id', $product->id)->delete();
        foreach ($request->unit as $index => $unit) {
            ProductUnit::create([
                'product_id' => $product->id,
                'unit' => $unit,
                'price' => $request->price[$index],
                'discount_price' => $request->discount_price[$index] ?? null,
            ]);
        }


        Alert::success('Product Updated Successfully!', 'You have updated the product.');
        return redirect()->route('admin.show_product', ['lang' => app()->getLocale()]);
    }

    public function removeImage($id)
    {
        if (!$this->checkPermission('manage_products')) {
            return redirect()->route('home', ['lang' => app()->getLocale()])->with('error', 'You do not have permission to access this page.');
        }
        // Find the product image by ID
        $productImage = ProductImage::findOrFail($id);

        // Get the file path to delete from the filesystem
        $imagePath = public_path($productImage->image_path);

        // Delete the image from the file system, if exist
        if (File::exists($imagePath) && !empty($productImage->image_path)) {
            File::delete($imagePath);
        }

        // Delete the product image record
        $productImage->delete();


        Alert::success('Image Removed Successfully!', 'The image has been removed.');
        return back();
    }


    public function UserOrders()
    {
        if (!$this->checkPermission('manage_orders')) {
            return redirect()->route('home', ['lang' => app()->getLocale()])->with('error', 'You do not have permission to access this page.');
        }
        $orders = Order::where('delivery_status', '!=', 'passive_order')->get();
        if ($orders->count() > 0) {
            $productimage = ProductImage::where('product_id', $orders[0]->product_id)->first();
        } else {
            $productimage = null;
        }
        return view('admin.orders', compact('orders', "productimage"));
    }
    public function getOrderDetails($id)
    {
        $order = Order::with('orderDetails')->find($id);

        if ($order) {
            return response()->json([
                'tracking_id' => $order->tracking_id,
                'email' => $order->email,
                'phone' => $order->phone,
                'payment_status' => $order->payment_status,
                'delivery_status' => $order->delivery_status,
                'created_at' => $order->created_at->toFormattedDateString(),
                'order_details' => $order->orderDetails->map(function ($detail) {
                    return [
                        'product_title' => $detail->product_title,
                        'quantity' => $detail->quantity,
                        'price' => $detail->price
                    ];
                })
            ]);
        }

        return response()->json(['error' => 'Order not found'], 404);
    }



    public function UpdateOrder($order_id, $delivery_status)
    {
        if (!$this->checkPermission('manage_orders')) {
            return redirect()->route('home', ['lang' => app()->getLocale()])->with('error', 'You do not have permission to access this page.');
        }

        $order = Order::where('id', $order_id)->first();

        if ($order) {
            // the order was found, update the delivery status
            if ($delivery_status == 'cancel_order') {
                // Loop through each order detail (products in the order)
                foreach ($order->orderDetails as $orderDetail) {
                    // Find the product associated with this order detail
                    $product = Product::find($orderDetail->product_id);

                    if ($product) {
                        // Update the quantity of the product in the products table
                        $product->qty += $orderDetail->quantity;
                        $product->save();

                        // Remove the product from the order details (cart)
                        $orderDetail->delete();
                    } else {
                        return redirect()->back()->with('error', 'Product not found!');
                    }
                }

                // After processing all order details, delete the order
                $order->delete();

                return redirect()->back()->with('success', 'Order has been canceled and products restocked.');
            } else {
                $order->delivery_status = $delivery_status;
                $order->save();
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    public function UpdateOrderPayment($order_id, $payment_status)
    {
        if (!$this->checkPermission('manage_orders')) {
            return redirect()->route('home', ['lang' => app()->getLocale()])->with('error', 'You do not have permission to access this page.');
        }

        $order = Order::where('id', $order_id)->first();

        if ($order) {
            if ($payment_status == 'cancelled') {
                // Loop through each order detail (products in the order)
                foreach ($order->orderDetails as $orderDetail) {
                    // Find the product associated with this order detail
                    $product = Product::find($orderDetail->product_id);

                    if ($product) {
                        // Update the quantity of the product in the products table
                        $product->qty += $orderDetail->quantity;
                        $product->save();
                    } else {
                        return redirect()->back()->with('error', 'Product not found!');
                    }
                }

                // Update the order's payment status to 'cancelled'
                $order->payment_status = 'cancelled';
                $order->save();

                // No need to delete the order, it remains in the system.
                return redirect()->back()->with('success', 'Order products have been restocked and payment status updated.');
            }



            // Update the payment status of the order
            $order->payment_status = $payment_status;
            $order->save();

            return redirect()->back()->with('success', 'Payment status updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Order not found!');
        }
    }


    public function PrintBill($order_id)
    {
        if (!$this->checkPermission('manage_orders')) {
            return redirect()->route('home', ['lang' => app()->getLocale()])->with('error', 'You do not have permission to access this page.');
        }
        $order = Order::where('id', $order_id)->first();

        if ($order) {

            $pdf = PDF::loadView('admin.user_bill', compact('order'));
            return $pdf->download('order_bill' . $order->id . '.pdf');
        } else {
            return redirect()->back();
        }
    }


    public function PrintTicket($order_id)
    {
        if (!$this->checkPermission('manage_orders')) {
            return redirect()->route('home', ['lang' => app()->getLocale()])->with('error', 'You do not have permission to access this page.');
        }

        $order = Order::with('orderDetails')->find($order_id);

        if ($order) {
            $pdf = Pdf::loadView('admin.order_ticket', compact('order'));

            // Set paper size and orientation for 10cm x 10cm
            $pdf->setPaper([0, 0, 283.465, 283.465], 'portrait'); // 283.465 points = 10 cm
            $pdf->setOption('isFontSubsettingEnabled', false);

            return $pdf->download('order_ticket_' . $order->id . '.pdf');
        } else {
            return redirect()->back()->with('error', 'Order not found');
        }
    }

    public function SearchProduct(Request $request)
    {
        if (!$this->checkPermission('manage_products')) {
            return redirect()->route('home', ['lang' => app()->getLocale()])->with('error', 'You do not have permission to access this page.');
        }
        $searchText = $request->search;
        $categoryId = $request->category_id; // Get selected category ID

        // Query the products based on search text and category
        $products = Product::query()
            ->when($searchText, function ($query) use ($searchText) {
                return $query->where('title', 'LIKE', "%$searchText%")
                    ->orWhere('description', 'LIKE', "%$searchText%")
                    ->orWhere('brand', 'LIKE', "%$searchText%");
            })
            ->when($categoryId, function ($query) use ($categoryId) {
                return $query->where('category_id', $categoryId); // Adjust based on your relationship
            })
            ->get();

        // Fetch all categories to display in the dropdown
        $categories = Category::all();

        return view('admin.show_product', compact('products', 'categories'));
    }


    public function SearchOrder(Request $request)
    {
        if (!$this->checkPermission('manage_orders')) {
            return redirect()->route('home', ['lang' => app()->getLocale()])->with('error', 'You do not have permission to access this page.');
        }
        $searchText = $request->search;
        $orders  = Order::where('tracking_id', 'LIKE', "%$searchText%")->where('delivery_status', '!=', 'passive_order')->get();
        return view('admin.orders', compact('orders'));
    }

    public function Customers()
    {
        if (!$this->checkPermission('manage_users')) {
            return redirect()->route('home', ['lang' => app()->getLocale()])->with('error', 'You do not have permission to access this page.');
        }

        $users = User::where('userType', '=', 0)->get();
        return view('admin.customers', compact('users'));
    }

    public function DeleteUser($id)
    {
        if (!$this->checkPermission('manage_users')) {
            return redirect()->route('home', ['lang' => app()->getLocale()])->with('error', 'You do not have permission to access this page.');
        }
        User::where('id', '=', $id)->delete();
        Cart::where('user_id', '=', $id)->delete();

        return redirect()->back();
    }

    public function SearchUser(Request $request)
    {
        if (!$this->checkPermission('manage_users')) {
            return redirect()->route('home', ['lang' => app()->getLocale()])->with('error', 'You do not have permission to access this page.');
        }
        $searchText = $request->search;
        $users  = User::where('name', 'LIKE', "%$searchText%")->orWhere('email', 'LIKE', "%$searchText%")->get();
        return view('admin.customers', compact('users'));
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return response()->json([
            'category' => $category,
            'translations' => [
                'category_name' => __('manage_category.category_name'),
                'category_image' => __('manage_category.category_image'),
                'update' => __('manage_category.update'),
                'cancel' => __('manage_category.cancel')
            ]
        ]);
    }
}
