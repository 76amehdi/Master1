<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryDisplay;

class CategoryDisplayController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.settings',['lang' => app()->getLocale()]);
    }

    public function store(Request $request)
    {
       $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'display_order' => 'required|integer|min:1|max:4|unique:category_display',
            'image' => 'required|file|image'
        ]);


        if (CategoryDisplay::count() >= 4) {
            return redirect()->back()->with('error', 'Maximum number of category displays reached');
        }


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();

            // Store image in public/files/catdisplayImages directory
            $image->move(public_path('files/catdisplayImages'), $imageName);

            $validated['display_image_path'] = 'files/catdisplayImages/' . $imageName;
        }


        CategoryDisplay::create($validated);
        return redirect()->route('admin.settings',['lang' => app()->getLocale()])->with('success', 'Category display added.');
    }

     public function update(Request $request, CategoryDisplay $categoryDisplay)
    {
         $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'display_order' => 'required|integer|min:1|max:4|unique:category_display,display_order,' . $categoryDisplay->id,
            'image' => 'nullable|file|image'
        ]);


        if ($request->hasFile('image')) {
             if ($categoryDisplay->display_image_path && file_exists(public_path($categoryDisplay->display_image_path))) {
                unlink(public_path($categoryDisplay->display_image_path));
            }

            $image = $request->file('image');
            $imageName = time() . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();

             // Store image in public/files/catdisplayImages directory
              $image->move(public_path('files/catdisplayImages'), $imageName);

            $validated['display_image_path'] = 'files/catdisplayImages/' . $imageName;

        } else {
            $validated['display_image_path'] =  $categoryDisplay->display_image_path;
        }

        $categoryDisplay->update($validated);
        return redirect()->route('admin.settings',['lang' => app()->getLocale()])->with('success', 'Category display updated.');
    }

    public function destroy(CategoryDisplay $categoryDisplay)
    {
         if ($categoryDisplay->display_image_path && file_exists(public_path($categoryDisplay->display_image_path))) {
                unlink(public_path($categoryDisplay->display_image_path));
            }

        $categoryDisplay->delete();
        return redirect()->route('admin.settings',['lang' => app()->getLocale()])->with('success', 'Category display deleted.');

    }
}