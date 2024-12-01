<?php

namespace App\Http\Controllers\API;

use App\Models\Seminar;

use App\Models\Participant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\SeminarResource;
use Illuminate\Support\Facades\Validator;

class AuthenticatedSeminarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seminars = Seminar::latest()->get();
        return SeminarResource::collection($seminars);
        // return view('admin.seminars', ['title' => 'Admin Dashboard', 'seminars'=>$seminars]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'max_participants' => 'required',
            'venue' => 'required',
            'open_until' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            // 'category_id' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Error adding data',
                'errors' => $validate->errors(),
            ]);
        }

        $seminar = Seminar::create($request->all());
        return new SeminarResource($seminar);
    }

    /**
     * Display the specified resource.
     */
    public function show(Seminar $seminar)
    {
        return new SeminarResource($seminar);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seminar $seminar)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'nullable',
            'slug' => 'nullable',
            'description' => 'nullable',
            'max_participants' => 'nullable',
            'venue' => 'nullable',
            'open_until' => 'nullable',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            // 'category_id' => 'nullable',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Error updating data',
                'errors' => $validate->errors(),
            ]);
        }

        $seminar->update($request->all());
        return new SeminarResource($seminar);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seminar $seminar)
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
        return response()->json(null, 204);
    }
}
