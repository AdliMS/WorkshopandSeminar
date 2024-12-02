<?php

namespace App\Http\Controllers\API;

use App\Models\User;

use App\Models\Seminar;
use App\Models\Participant;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\SeminarResource;
use Illuminate\Support\Facades\Validator;

class AuthenticatedSeminarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $seminars = Seminar::latest()->get();
            if (auth('sanctum')->user()->currentAccessToken()) {
                return SeminarResource::collection($seminars);
            };
        } catch (\Throwable $err) {
            return response()->json([
                'status' => false,
                'message' => $err->getMessage(),
            ], 400);
        };
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
            'venue' => 'required',
            // 'category_id' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Error adding data',
                'errors' => $validate->errors(),
            ], 400);
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
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'max_participants' => 'required',
            'venue' => 'required',
            'open_until' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Error updating data',
                'errors' => $validate->errors(),
            ], 400);
        }

        $seminar->update($request->all());
        return new SeminarResource($seminar);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seminar $seminar)
    {
        try {
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
            return response()->json([
                    'message' => 'Successfully delete a seminar',
                ], 200);
        } catch (\Throwable $err) {
            return response()->json([
                'status' => false,
                'message' => $err->getMessage(),
            ], 404);
        }
    }
}
