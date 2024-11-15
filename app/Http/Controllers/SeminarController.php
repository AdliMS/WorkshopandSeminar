<?php

namespace App\Http\Controllers;

use App\Models\Seminar;
use Illuminate\Http\Request;

class SeminarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $seminars = Seminar::latest()->get();

        // if (request('search')) {
        //     $data->where('event_name', request('search'));
        // }



        return view('guest.seminars', ['seminars' => $seminars]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Seminar $seminar)
    {
        //
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
