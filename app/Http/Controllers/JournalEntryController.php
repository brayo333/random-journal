<?php

namespace App\Http\Controllers;

use App\Mail\DailyRandomEntryEmail;
use App\Models\JournalEntry;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class JournalEntryController extends Controller
{
    public $yesterday, $today;

    public function __construct()
    {
        // $this->middleware('auth:api')->except('index', 'show', 'searchProperty');
        $this->middleware('auth:sanctum')->except('sendDailyEmail');

        $this->yesterday = Carbon::yesterday()->setTime(12, 0, 0); // 12pm previous day
        $this->today = Carbon::today()->setTime(22, 0, 0); // 12pm today
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user()->id;

        $query = JournalEntry::query()->where('user_id', $user)->get();

        return Inertia::render('MainApp/Journal', ['userEntries' => $query]);
    }

    public function random()
    {
        $user = Auth::user()->id;

        $user_post = JournalEntry::query()->where('user_id', $user)->whereBetween('created_at', [$this->yesterday, $this->today])->get();

        // dd($user_post);

        if (count($user_post) > 0) {
            $query = JournalEntry::query()->where('user_id', '!=', $user)->whereBetween('created_at', [$this->yesterday, $this->today])->get()->makeHidden(['user_id', 'id']);

            return Inertia::render('MainApp/RandomEntries', ['randomEntries' => $query]);
        }
        return Inertia::render('MainApp/RandomEntries', ['randomEntries' => []]);
    }

    public function sendDailyEmail()
    {
        $users = User::all();
        // $users = [
        //     (object) [
        //         'id' => 1,
        //         'name' => 'Brian',
        //         'email' => 'hello@brianmulaa.com'
        //     ]
        // ];

        foreach ($users as $user) {
            $did_user_post = JournalEntry::query()->where('user_id', $user->id)->whereBetween('created_at', [$this->yesterday, $this->today])->get();

            if (count($did_user_post) > 0) {
                $query = JournalEntry::query()->where('user_id', '!=', $user->id)->whereBetween('created_at', [$this->yesterday, $this->today])->get();

                Mail::to($user->email)->send(new DailyRandomEntryEmail($query));
            }
        }
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
        $entry = JournalEntry::where('id', $id)->first();

        return Inertia::render('MainApp/Journal', ['journalEntry' => $entry]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user()->id;

        $validatedData  = $request->validate([
            'entry' => 'required|string|max:500',
        ]);

        $does_entry_exist = JournalEntry::where('id', $id)->where('user_id', $user)->first();

        if (empty($does_entry_exist)) {
            return redirect('/journal')->with('notification', [
                'color' => 'red',
                'title' => 'Failed',
                'message' => 'Unable to edit the entry. The entry either does not belong to you or it doesn\'t exist.',
            ]);
        } else {
            $does_entry_exist->update(['entry' => $validatedData['entry']]);

            return redirect('/journal')->with('notification', [
                'color' => 'green',
                'title' => 'Success',
                'message' => 'The entry has been updated successfully.',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user()->id;

        $entry = JournalEntry::where('id', $id)->where('user_id', $user)->first();

        if (empty($entry)) {
            return redirect('/journal')->with('notification', [
                'color' => 'red',
                'title' => 'Failed',
                'message' => 'Unable to delete the entry. The entry either does not belong to you or it doesn\'t exist.',
            ]);
        } else {
            $entry->delete();
            $entry->refresh();

            if ($entry) {
                return redirect('/journal')->with('notification', [
                    'color' => 'green',
                    'title' => 'Success',
                    'message' => 'The entry has been deleted successfully.',
                ]);
            } else {
                return redirect('/journal')->with('notification', [
                    'color' => 'red',
                    'title' => 'Failed',
                    'message' => 'Unable to delete the entry. Please try again.',
                ]);
            }
        }
    }
}
