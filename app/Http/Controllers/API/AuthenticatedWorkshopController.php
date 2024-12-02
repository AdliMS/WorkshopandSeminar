<?php

namespace App\Http\Controllers\API;

use App\Models\Workshop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\WorkshopResource;

use App\Models\Participant;

class AuthenticatedWorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workshops = Workshop::latest()->get();
        return WorkshopResource::collection($workshops);
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
            ], 400);
        }

        $workshop = workshop::create($request->all());
        return new WorkshopResource($workshop);
    }

    /**
     * Display the specified resource.
     */
    public function show(Workshop $workshop)
    {
        return new WorkshopResource($workshop);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Workshop $workshop)
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

        $workshop->update($request->all());
        return new workshopResource($workshop);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workshop $workshop)
    {
        try {
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
            return response()->json([
                    'message' => 'Successfully delete a workshop',
                ], 200);
        } catch (\Throwable $err) {
            return response()->json([
                'status' => false,
                'message' => $err->getMessage(),
            ], 404);
        }
    }
}
