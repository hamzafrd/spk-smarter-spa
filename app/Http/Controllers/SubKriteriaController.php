<?php

namespace App\Http\Controllers;

use App\Models\SubKriteria;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('SubKriteria/Index');
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
    public function show(SubKriteria $subKriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubKriteria $subKriteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubKriteria $subKriteria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubKriteria $subKriteria)
    {
        //
    }
}
