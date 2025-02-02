<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::first(); // Get the first contact if exists
        return view('admin.contact.index', compact('contact'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'message' => 'nullable|string',
            'localisation' => 'nullable|string',
        ]);

        Contact::create($request->all());
        return Redirect::route('contacts.index', ['lang' => app()->getLocale()])->with('message', __('Contact saved successfully.'));
    }

    public function show(Contact $contact)
    {
        return response()->json($contact);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:contacts,id',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'message' => 'nullable|string',
            'localisation' => 'nullable|string',
        ]);

        // Retrieve the contact record
        $contact = Contact::find($request->id); // 'find' returns the model instance or null if not found

        if (!$contact) {
            return redirect()->back()->withErrors(__('Contact not found.'));
        }

        // Update the contact record with validated data
        $contact->update($request->only(['email', 'phone', 'message', 'localisation']));

        // Redirect with success message
        return redirect()
            ->route('contacts.index', ['lang' => app()->getLocale()])
            ->with('message', __('Contact updated successfully.'));
    }


    public function destroy($lang,$id)
    {
        $contact = Contact::findOrFail($id); 

        if (!$contact) {
            return redirect()->back()->withErrors(__('Contact not found.'));
        }
        $contact->delete(); 

        return redirect()->route('contacts.index', ['lang' => app()->getLocale()])
            ->with('message', __('Contact deleted successfully.'));
    }
}
