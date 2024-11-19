<?php

namespace App\Http\Controllers;

use App\Models\Seminar;
use App\Models\ParticipantRequirement;
use App\Models\Registration;
use App\Models\Participant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class SeminarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seminars = Seminar::latest()->get();
        return view('guest.seminars', ['title' => 'Admin Dashboard', 'seminars'=>$seminars]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Seminar $seminar)
    {
        return view('guest.seminar_registration', ['seminar'=> $seminar]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $seminar_id)
    {
        $seminar = Seminar::find($seminar_id);
        
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
                'seminar_id' => $seminar->id,
                'participant_id' => $participant->id,
            ]);

            // Commit transaksi
            DB::commit();

            } catch (\Exception $e) {
                // Rollback jika terjadi kesalahan
                DB::rollback();
                throw $e;
            }

        return Redirect::to('/seminar/'.$seminar_id)->with('success', 'Registrasi sukses!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Seminar $seminar)
    {
        //

        $requirements = ParticipantRequirement::where('seminar_id', $seminar->id)->get();
        // dd($seminar);
        // dd($requirements);
        return view('guest.detail_seminar', compact('seminar', 'requirements'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seminar $seminar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seminar $seminar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seminar $seminar)
    {
        //
    }
}
