<?php

namespace App\Http\Controllers;

use App\Models\HomepageSetting;
use Illuminate\Http\Request;

class HomepageSettingController extends Controller
{
    public function index()
    {
        $settings = HomepageSetting::first();
        $featuredProducts = \App\Models\FeaturedProduct::with('product')->orderBy('display_order')->get();
        $categoryDisplays = \App\Models\CategoryDisplay::with('category')->orderBy('display_order')->get();
        $products = \App\Models\Product::all();
        $categories = \App\Models\Category::all();
        return view('admin.settings.index', compact('settings', 'featuredProducts', 'categoryDisplays', 'products', 'categories'));

    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'currency' => 'required|string|max:10',
            'normal_delivery_price' => 'required|numeric|min:0',
            'free_delivery_threshold' => 'required|numeric|min:0'
        ]);

        HomepageSetting::firstOrCreate([], $validated);
        return redirect()->route('admin.settings.index',['lang' => app()->getLocale()])->with('success', 'Homepage settings saved.');
    }

    public function update(Request $request, HomepageSetting $settings)
    {
           $validated = $request->validate([
            'currency' => 'required|string|max:10',
            'normal_delivery_price' => 'required|numeric|min:0',
            'free_delivery_threshold' => 'required|numeric|min:0'
        ]);
        $settings->update($validated);
        return redirect()->route('admin.settings',['lang' => app()->getLocale()])->with('success', 'Homepage settings updated.');

    }
}