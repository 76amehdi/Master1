<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\UserRole;
use Illuminate\Http\Request;
use App\Models\HomepageSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a list of users.
     */
    public function index()
    {
        
        $users = User::where("usertype", 1)->with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form to create a new user.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a new user.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            
        ]);
        

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'usertype' => 1,
        ]);

        

        return redirect()->route('users.index',['lang' => app()->getLocale()])->with('message', 'User created successfully!');
    }

    /**
     * Show the form to edit a user.
     */
    public function edit($id)
    {
        $user = User::with('roles')->findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update a user.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|string|min:8',
        'phone' => 'nullable|string|max:15',
        'address' => 'nullable|string|max:255',
        'usertype' => 'required|integer',
    ]);

    try {
        $user = User::findOrFail($id);

        // Store the password before the update in case it was changed
        $password = $request->password ? Hash::make($request->password) : $user->password;

        // Assign attributes individually
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $password;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->usertype = $request->usertype;

        $user->save(); // Save the updated model

        // Regenerate the session if the authenticated user was updated
        if (auth()->user()->id == $user->id) {
            
            auth()->login($user);            
        }

        return redirect()->route('users.index', ['lang' => app()->getLocale()])
                         ->with('success', 'User updated successfully.');
    } catch (\Exception $e) {
        // Log the exception and provide a generic error message
        \Log::error("User update failed: " . $e->getMessage());
        return redirect()->route('login', ['lang' => app()->getLocale()])
                         ->with('error', 'An error occurred while updating the user.');
    }
}

    
    
    public function updattte(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'usertype' => 'required|integer',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'phone' => $request->phone,
            'address' => $request->address,
            'usertype' => $request->usertype,
        ]);
        return redirect()->route('users.index',['lang' => app()->getLocale()])->with('success', 'User updated successfully.');
    }

    /**
     * Delete a user.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index',['lang' => app()->getLocale()])->with('success', 'User deleted successfully.');
    }

    /**
     * Manage roles for a user.
     */
    public function manageRoles($id)
    {
        $user = User::with('roles')->findOrFail($id);
        return view('admin.users.roles', compact('user'));
    }

    /**
     * Update roles for a user.
     */
    public function updateRoles(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Update the roles
        $roles = $request->input('roles', []);

        // Update the user roles in the pivot table or wherever you store user roles
        $userRole = UserRole::where('user_id', $id)->firstOrFail();
        foreach (['manage_categories', 'manage_products', 'manage_users', 'manage_orders', 'manage_warehouses', 'admin'] as $role) {
            $userRole->$role = isset($roles[$role]) ? 1 : 0;
        }
        $userRole->save();

        return redirect()->route('users.index',['lang' => app()->getLocale()])->with('message', 'Roles updated successfully');
    }

    public function account()
    {
        $settings = HomepageSetting::first();
        $featuredProducts = \App\Models\FeaturedProduct::with('product')->orderBy('display_order')->get();
        $categoryDisplays = \App\Models\CategoryDisplay::with('category')->orderBy('display_order')->get();
        $user = Auth::user();
        $orders = Order::where('email', '=', $user->email)->get();
        return view('tiyya.account.account', compact('user', 'settings', 'featuredProducts', 'categoryDisplays',"orders"));
    }
}
