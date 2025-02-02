<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\AstuceBeaute;
use Illuminate\Http\Request;
use App\Models\HomepageSetting;
use Illuminate\Support\Facades\Auth;

class AstuceBeauteController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check() && Auth::user()->usertype != 1) {
                abort(403, 'Unauthorized action.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $astuces = AstuceBeaute::all();
        return view('admin.astuces.index', compact('astuces'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'category' => 'required|string',
            'text' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
             $image = $request->file('image');
             $imageName = time() . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();

            // Store image in public/files/astuces directory
            $image->move(public_path('files/astuces'), $imageName);

            $data['image'] = 'files/astuces/' . $imageName;
        }

        AstuceBeaute::create($data);
        return redirect()->route('admin.astuces.index')->with('success', 'Astuce created successfully.');
    }

    public function edit($id)
    {
        $astuce = AstuceBeaute::findOrFail($id);
        return response()->json([
            'astuce' => $astuce,
            'translations' => [
                'title' => __('astuce.title'),
                'category' => __('astuce.category'),
                'text' => __('astuce.text'),
                'image' => __('astuce.image'),
                'update' => __('astuce.update')
            ]
        ]);
    }

    public function show($id)
    {
        $astuce = AstuceBeaute::findOrFail($id);
        return response()->json([
            'astuce' => $astuce,
            'translations' => [
                'title' => __('astuce.title'),
                'category' => __('astuce.category'),
                'text' => __('astuce.text'),
                'image' => __('astuce.image')
            ]
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'category' => 'required|string',
            'text' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $astuce = AstuceBeaute::findOrFail($id);
        $data = $request->except('image');

        if ($request->hasFile('image')) {
             if ($astuce->image && file_exists(public_path($astuce->image))) {
                unlink(public_path($astuce->image));
            }

            $image = $request->file('image');
            $imageName = time() . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();

            // Store image in public/files/astuces directory
            $image->move(public_path('files/astuces'), $imageName);

            $data['image'] = 'files/astuces/' . $imageName;
        }

        $astuce->update($data);
        return redirect()->route('admin.astuces.index')->with('success', 'Astuce updated successfully.');
    }

    public function destroy($id)
    {
        $astuce = AstuceBeaute::findOrFail($id);
         if ($astuce->image && file_exists(public_path($astuce->image))) {
                unlink(public_path($astuce->image));
            }
        $astuce->delete();
        return redirect()->route('admin.astuces.index')->with('success', 'Astuce deleted successfully.');
    }

    public function showCategory(Request $request, $lang, $category)
    {
        $settings = HomepageSetting::first();
        $realCategory = str_replace('-', ' ', $category);
        $categoryData = AstuceBeaute::where('category', $realCategory)->get();
        $game = Category::take(4)->get();
        return view("tiyya.blogs.cat_blogs", compact('categoryData', 'game', "settings"));
    }

    public function showAstuce(Request $request, $lang, $id)
    {
        $settings = HomepageSetting::first();
        $categoryData = AstuceBeaute::find($id);
        return view("tiyya.blogs.cart", compact('categoryData', "settings"));
    }
}