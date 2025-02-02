<?php

namespace App\Http\Controllers;

use App\Models\FeaturedProduct;
use Illuminate\Http\Request;

class FeaturedProductController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.settings',['lang' => app()->getLocale()]);
    }

    public function store(Request $request)
    {
       $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'display_order' => 'required|integer|min:1|max:3|unique:featured_products',
             'image' => 'required|file|image'
        ]);


          if (FeaturedProduct::count() >= 3) {
            return redirect()->back()->with('error', 'Maximum number of featured products reached');
        }


        if ($request->hasFile('image')) {
             $image = $request->file('image');
              $imageName = time() . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();

            // Store image in public/files/featuredproducts directory
            $image->move(public_path('files/featuredproducts'), $imageName);

            $validated['featured_image_path'] = 'files/featuredproducts/' . $imageName;
        }


        FeaturedProduct::create($validated);
        return redirect()->route('admin.settings',['lang' => app()->getLocale()])->with('success', 'Featured product added.');
    }


    public function update(Request $request, FeaturedProduct $featuredProduct)
    {
        $validated = $request->validate([
             'product_id' => 'required|exists:products,id',
             'display_order' => 'required|integer|min:1|max:3|unique:featured_products,display_order,' . $featuredProduct->id,
               'image' => 'nullable|file|image'
        ]);


        if ($request->hasFile('image')) {
             if ($featuredProduct->featured_image_path && file_exists(public_path($featuredProduct->featured_image_path))) {
                 unlink(public_path($featuredProduct->featured_image_path));
            }

             $image = $request->file('image');
              $imageName = time() . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
           // Store image in public/files/featuredproducts directory
              $image->move(public_path('files/featuredproducts'), $imageName);


            $validated['featured_image_path'] = 'files/featuredproducts/' . $imageName;
        } else{
              $validated['featured_image_path'] =  $featuredProduct->featured_image_path;
        }


        $featuredProduct->update($validated);
        return redirect()->route('admin.settings',['lang' => app()->getLocale()])->with('success', 'Featured product updated.');
    }

    public function destroy(FeaturedProduct $featuredProduct)
    {
           if ($featuredProduct->featured_image_path && file_exists(public_path($featuredProduct->featured_image_path))) {
                 unlink(public_path($featuredProduct->featured_image_path));
            }
        $featuredProduct->delete();
        return redirect()->route('admin.settings',['lang' => app()->getLocale()])->with('success', 'Featured product deleted.');
    }
}