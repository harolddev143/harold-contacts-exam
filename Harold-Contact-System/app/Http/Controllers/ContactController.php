<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contacts = Contact::latest()->paginate(1);
        // $contacts = Contact::find(5);

        return view('contacts.index', compact('contacts'))
            ->with('i', (request()->input('page', 1) - 1) * 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'=>'required',
        ]);

        $userId = Auth::check() ? Auth::id() : true;

        $contacts = Contact::create([
            'name' => $request->get('name'),
            'company' => $request->get('company'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'user_id' => $userId
        ]);

        $contacts = Contact::latest()->paginate(5);

        return view('contacts.index', compact('contacts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //

        $request->validate([
            'name'=>'required',
        ]);

        $userId = Auth::check() ? Auth::id() : true;

        $contact->update([
            'user_id' => $userId,
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'company' => $request->get('company'),
            'email' => $request->get('email')
        ]);

        $contacts = Contact::latest()->paginate(5);

        return view('contacts.index', compact('contacts'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //

        $contact->delete();

        return redirect()->back();
    }
}
