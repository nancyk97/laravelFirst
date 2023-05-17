<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\Coachs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;

class EventsController extends Controller
{

    public function create(): View
    {
        return view('eventsCreation');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required',
            'event_date' => 'required|date',
            'deadline_date' => 'required|date',
            'location' => 'required',
            'level' => 'required',

        ]);



        $event = Events::create([
            'title' => $request->title,
            'event_date' => $request->event_date,
            'deadline_date' => $request->deadline_date,
            'location' => $request->location,
            'level' => $request->level,
            'created_by' => Auth::user()->id,
            'updated_by' =>  Auth::user()->id,
        ]);


        // Redirect back or to a success page
        $events = Events::all();

        return view('eventslist', ['events' => $events]);
    }

    public function index()
    {
        $events = Events::all();

        return view('eventslist', ['events' => $events]);
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Events $event): RedirectResponse
    {

        $event->delete();

        return redirect()->route('events')->with('success', 'Event deleted successfully.');
    }
    public function saveCredentials(Request $request, $event)
    {

        // Retrieve the coach usernames and passwords from the request
        $coachUsernames = $request->input('coach_username');
        $coachPasswords = $request->input('coach_password');

        // Perform validation if necessary

        // Save the coach entries
        foreach ($coachUsernames as $index => $username) {
            $password = $coachPasswords[$index];

            // Create and save the coach entry
            $coach = new Coachs();
            $coach->username = $username;
            $coach->password = $password;
            $coach->event_id = $event;
            $coach->created_by = Auth::user()->id;
            $coach->updated_by = Auth::user()->id;

            $coach->save();
        }

        return redirect()->route('eventInvite.show', ['event' => $event])->with('success', 'Credentials saved successfully.');
    }
}
