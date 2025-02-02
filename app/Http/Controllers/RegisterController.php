<?php


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\HomepageSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
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
    // Show the login form
    public function LoginForm()
    {
        if (auth()->check()) {
            return redirect()->route('home',['lang' => app()->getLocale()]);
        }
        return view('tiyya.account.login');
    }

    // Display the registration form
    public function index()
    {
        // Show the registration form just if not already
        if (auth()->check()) {
            return redirect()->route('home',['lang' => app()->getLocale()]);
        }
        return view('tiyya.account.register');
    }
    public function register(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        //dd($validator);



        // Combine fname and lname to form the full name
        $fullName = $request->fname . ' ' . $request->lname;

        // Create the new user
        $user = User::create([
            'name' => $fullName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Authenticate the user
        auth()->login($user);

        // Redirect to the home page
        return redirect()->route('home',['lang' => app()->getLocale()]);

        // After successful registration, return the view
        return view('tiyya.account.register', ['success' => 'User registered successfully!']);
    }
}
