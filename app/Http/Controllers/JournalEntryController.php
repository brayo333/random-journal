<?php

namespace App\Http\Controllers;

use App\Models\JournalEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class JournalEntryController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api')->except('index', 'show', 'searchProperty');
        $this->middleware('auth:sanctum');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('MainApp/Journal', ['randomEntries' => JournalEntry::get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData  = $request->validate([
            'entry' => 'required|string|max:500',
        ]);

        //Get user id of the user who wants to add the entry
        $user = Auth::user()->id;

        $journal_entry = [
            'user_id' => $user,
            'entry' => $validatedData['entry'],
        ];

        $created_journal_entry = JournalEntry::create($journal_entry);

        if (empty($created_journal_entry)) {
            return redirect('/journal')->with('notification', [
                'color' => 'red',
                'title' => 'Failed',
                'message' => 'There was an error with uploading your entry. Please try again.',
            ]);
        } else {
            return redirect('/journal')->with('notification', [
                'color' => 'green',
                'title' => 'Success',
                'message' => 'Your entry has been added successfully!',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Inertia::render('MainApp/Journal', ['journalEntry' => "hi"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
