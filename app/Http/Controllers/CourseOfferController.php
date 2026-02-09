<?php

namespace App\Http\Controllers;

use App\Models\course_offer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('CourseOffer/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('CourseOffer/Create');
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
    public function show(course_offer $course_offer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(course_offer $course_offer)
    {
        return Inertia::render('CourseOffer/Edit', ['courseOffer' => $course_offer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, course_offer $course_offer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(course_offer $course_offer)
    {
        //
    }
}
