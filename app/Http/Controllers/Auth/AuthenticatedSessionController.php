<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Str;

use App\Models\Seminar;
use App\Models\Workshop;
use App\Models\ParticipantRequirement;
use App\Models\Participant;
use App\Models\Registration;
use App\Models\EventStatus;
use App\Models\EventCategory;

class AuthenticatedSessionController extends Controller
{
    public function getAllSeminars()
    {
        //
        $seminars = Seminar::latest()->get();
        // $participant_id = Registration::where('seminar_id', )
        // $current_participants = 

        return view('admin.seminars', ['title' => 'Admin Dashboard', 'seminars'=>$seminars]);
    }

    public function getAllWorkshops()
    {
        // 
        $workshops = Workshop::latest()->get();
        return view('admin.workshops', ['title' => 'Admin Dashboard', 'workshops'=>$workshops]);
    }

    public function getSeminar(Seminar $seminar)
    {
        //
        $requirements = ParticipantRequirement::where('seminar_id', $seminar->id)->get();
        $participant_id = Registration::where('seminar_id', $seminar->id)->get('participant_id');
        $participants = Participant::find($participant_id);
    
        if (request('search')) {
            $participants = $participants->filter(function ($participant) {
                return stripos($participant->name, request('search')) !== false;
            });
        }  

        return view('admin.detail_seminar', [
            // 'data' => $data,
            'seminar' => $seminar,
            'requirements' => $requirements,
            'participants' => $participants,
        ]);

    }

    public function getWorkshop(Workshop $workshop)
    {
        //
        $requirements = ParticipantRequirement::where('workshop_id', $workshop->id)->get();
        $participant_id = Registration::where('workshop_id', $workshop->id)->get('participant_id');
        $participants = Participant::find($participant_id);

        if (request('search')) {
            $participants = $participants->filter(function ($participant) {
                return stripos($participant->name, request('search')) !== false;
            });
        }
        

        return view('admin.detail_workshop', [
            'workshop' => $workshop,
            'requirements' => $requirements,
            'participants' => $participants
        ]);
    }
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(route('admin', absolute: false));
    }

    public function showAddSeminar() 
    {
        $categories = EventCategory::all();
        return view('admin.add_seminar', compact('categories'));
    }

    public function showAddWorkshop() 
    {
        $categories = EventCategory::all();
        return view('admin.add_workshop', compact('categories'));
    }

    public function showUpdateSeminar(Seminar $seminar)
    {
        $categories = EventCategory::all();
        return view('admin.update_seminar', compact('categories', 'seminar'));
    }
    
    public function showUpdateWorkshop(Workshop $workshop)
    {
        $categories = EventCategory::all();
        return view('admin.update_workshop', compact('categories', 'workshop'));
    }

    public function addSeminar(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'venue' => 'required',
            'max_participants' => 'required',
            'open_until' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'category' => 'required',
            'description' => 'required',
        ]);

        $data = [
            'name' => $request -> input('title'),
            'slug' => $request -> input(Str::slug('title')),
            'description' => $request -> input('description'),
            'max_participants' => $request -> input('max_participants'),
            'venue' => $request -> input('venue'),
            'open_until' => $request -> input('open_until'),
            'start_time' => $request -> input('start_time'),
            'end_time' => $request -> input('end_time'),
            'category_id' => $request -> input('category'),
        ];
        Seminar::create($data);

        return to_route('admin-all-seminar');
    }

    public function addWorkshop(Request $request)
    {
        
        $data = [
            'name' => $request -> input('title'),
            'slug' => $request -> input(Str::slug('title')),
            'description' => $request -> input('description'),
            'max_participants' => $request -> input('max_participants'),
            'venue' => $request -> input('venue'),
            'open_until' => $request -> input('open_until'),
            'start_time' => $request -> input('start_time'),
            'end_time' => $request -> input('end_time'),
            'category_id' => $request -> input('category'),
        ];
        Workshop::create($data);

        return to_route('admin-all-workshop');
    }

    public function updateSeminar (Request $request, Seminar $seminar) 
    {

        $data = [
            'name' => $request -> input('title'),
            'slug' => $request -> input(Str::slug('title')),
            'description' => $request -> input('description'),
            'max_participants' => $request -> input('max_participants'),
            'venue' => $request -> input('venue'),
            'open_until' => $request -> input('open_until'),
            'start_time' => $request -> input('start_time'),
            'end_time' => $request -> input('end_time'),
            'category_id' => $request -> input('category'),
        ];

        Seminar::find($seminar->id)->update($data);

        return to_route('admin-seminar', ['seminar'=>$seminar]);
    }

    public function updateWorkshop (Request $request, Workshop $workshop) 
    {

        $data = [
            'name' => $request -> input('title'),
            'slug' => $request -> input(Str::slug('title')),
            'description' => $request -> input('description'),
            'max_participants' => $request -> input('max_participants'),
            'venue' => $request -> input('venue'),
            'open_until' => $request -> input('open_until'),
            'start_time' => $request -> input('start_time'),
            'end_time' => $request -> input('end_time'),
            'category_id' => $request -> input('category'),
        ];

        Workshop::find($workshop->id)->update($data);

        return to_route('admin-workshop', ['workshop'=>$workshop]);
    }

    public function delSeminar (Seminar $seminar) 
    {

        // karena tiap acara memiliki registrasi untuk para peserta yang terdaftar,
        // maka selain acara dan registrasinya, peserta dari acara ini juga perlu di hapus.

        // mencari id peserta yang terhubung ke registrasi untuk acara ini, lalu menghapusnya.
        foreach ($seminar->registrations as $registration) {
            // dump($registration->participant_id);
            Participant::find($registration->participant_id)->delete();
        }
        
        // menghapus registrasi, dan terakhir menghapus acara
        $seminar->registrations()->delete();
        $seminar->delete();

        return to_route('admin-all-seminar');
    }

    public function delWorkshop (Workshop $workshop) 
    {

        // karena tiap acara memiliki registrasi untuk para peserta yang terdaftar,
        // maka selain acara dan registrasinya, peserta dari acara ini juga perlu di hapus.

        // mencari id peserta yang terhubung ke registrasi untuk acara ini, lalu menghapusnya.
        foreach ($workshop->registrations as $registration) {
            // dump($registration->participant_id);
            Participant::find($registration->participant_id)->delete();
        }
        
        // menghapus registrasi, dan terakhir menghapus acara
        $workshop->registrations()->delete();
        $workshop->delete();

        return to_route('admin-all-workshop');
    }

    public function delSeminarParticipant(Seminar $seminar, Participant $participant) 
    {
        Seminar::find($seminar->id)->update([
            'current_participants' => Registration::where('seminar_id', $seminar->id)->get('participant_id')->count() - 1,
        ]);
        $participant->registrations()->delete();
        $participant->delete();

        return to_route('admin-seminar', ['seminar'=>$seminar]);
    }

    public function delWorkshopParticipant(Workshop $workshop, Participant $participant) 
    {
        Workshop::find($workshop->id)->update([
            'current_participants' => Registration::where('workshop_id', $workshop->id)->get('participant_id')->count() - 1,
        ]);
        $participant->registrations()->delete();
        $participant->delete();

        return to_route('admin-workshop', ['workshop'=>$workshop]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
