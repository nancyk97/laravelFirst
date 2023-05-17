<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\User;
use App\Models\Coachs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;

class EventInviteController extends Controller
{

    public function create(): View
    {
        return view('eventInvite');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function show($id)
    {
        // Fetch the event details from the database using the provided $id
        $event = Events::find($id);


        // Fetch the list of other coaches
        $otherCoaches = Coachs::where('event_id', $id)->get();
        // Fetch the user details
        $user = User::find($event->user_id);

        return view('eventInvite', [
            'event' => $event,
            'otherCoaches' => $otherCoaches,
            'user' => $user,
        ]);
    
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Events $event): RedirectResponse
    {

        $event->delete();

        return redirect()->route('events')->with('success', 'Event deleted successfully.');
    }
}
