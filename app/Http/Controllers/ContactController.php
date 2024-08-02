<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;


class ContactController extends Controller
{

    public function index(Request $request)
    {
        $query = Contact::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        }

        if ($request->has('sort')) {
            $sort = $request->input('sort');
            $query->orderBy($sort, 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $contacts = $query->paginate(10);

        return view('index', ['contacts' => $contacts]);
    }


    public function create()
    {
        return view('create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:15',
            'email' => 'required|string|email|max:25|unique:contacts',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:50',
        ]);

        Contact::create($request->all());

        return redirect()->route('contacts.index')->with('success', 'Contact created successfully.');
    }


    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('show', ['contact' => $contact]);
    }


    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('edit', ['contact' => $contact]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:contacts,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->update($request->all());

        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }
}
