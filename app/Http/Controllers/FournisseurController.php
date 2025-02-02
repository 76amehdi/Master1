<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    // Display all fournisseurs
    public function index()
    {
        $fournisseurs = Fournisseur::all();
        return view('admin.fournisseurs.index', compact('fournisseurs'));
    }

    // Show form to create a new fournisseur
    public function create()
    {
        return view('admin.fournisseurs.create');
    }

    // Store a new fournisseur
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:fournisseurs,name',
            'email' => 'nullable|email|unique:fournisseurs,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        Fournisseur::create($validated);

        return redirect()->route('fournisseurs.index',['lang' => app()->getLocale()])
            ->with('success', 'Fournisseur created successfully!');
    }

    // Display a single fournisseur
    public function show($id)
    {
        $fournisseur = Fournisseur::findOrFail($id);
        return view('admin.fournisseurs.show', compact('fournisseur'));
    }

    // Show form to edit an existing fournisseur
    public function edit($id)
    {
        $fournisseur = Fournisseur::findOrFail($id);
        return view('admin.fournisseurs.edit', compact('fournisseur'));
    }

    // Update an existing fournisseur
    public function update(Request $request, $id)
    {
        $fournisseur = Fournisseur::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|unique:fournisseurs,name,' . $id,
            'email' => 'nullable|email|unique:fournisseurs,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $fournisseur->update($validated);

        return redirect()->route('fournisseurs.index',['lang' => app()->getLocale()])
            ->with('success', 'Fournisseur updated successfully!');
    }

    // Delete a fournisseur
    public function destroy($id)
    {
        Fournisseur::destroy($id);
        return redirect()->route('fournisseurs.index',['lang' => app()->getLocale()])
            ->with('success', 'Fournisseur deleted successfully!');
    }
}
