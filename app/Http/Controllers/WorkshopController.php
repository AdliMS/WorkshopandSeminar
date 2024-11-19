<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use App\Models\ParticipantRequirement;
use App\Models\Registration;
use App\Models\Participant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class WorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $workshops = Workshop::latest()->get();        
        return view('guest.workshops', ['workshops' => $workshops]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Workshop $workshop)
    {
        //
        return view('guest.workshop_registration', ['workshop'=> $workshop]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $workshop_id)
    {
        $workshop = Workshop::find($workshop_id);
        
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'edu_level' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
        ]);

        $data = [
            'name' => $request -> input('name'),
            'location' => $request -> input('location'),
            'educational_level' => $request -> input('edu_level'),
            'email' => $request -> input('email'),
            'phone_number' => $request -> input('phone_number'),
        ];

        // Mulai transaksi
        DB::beginTransaction();

        try {
            // 1. Tambah data ke tabel Participants
            $participant = Participant::create($data);

            // 2. Tambah data ke tabel Registrations
            Registration::create([
                'workshop_id' => $workshop->id,
                'participant_id' => $participant->id,
            ]);

            // Commit transaksi
            DB::commit();

            } catch (\Exception $e) {
                // Rollback jika terjadi kesalahan
                DB::rollback();
                throw $e;
            }

        return Redirect::to('/workshop/'.$workshop_id)->with('success', 'Registrasi sukses!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Workshop $workshop)
    {
        //
        $requirements = ParticipantRequirement::where('workshop_id', $workshop->id)->get();
        return view('guest.detail_workshop', compact('workshop', 'requirements'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Workshop $workshop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Workshop $workshop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workshop $workshop)
    {
        //
    }
}
