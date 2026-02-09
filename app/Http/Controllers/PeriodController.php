<?php

namespace App\Http\Controllers;

use App\Models\period;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Period/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Period/Create');
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
    public function show(period $period)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(period $period)
    {
        return Inertia::render('Period/Edit', ['period' => $period]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, period $period)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(period $period)
    {
        //
    }
}
