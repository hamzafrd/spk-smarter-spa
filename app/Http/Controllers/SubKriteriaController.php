<?php

namespace App\Http\Controllers;

use App\Models\SubKriteria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SubKriteriaController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $user = User::find(Auth::id());
    $kriteria_joinsb = $user->kriteria()->with('subkriteria')->orderBy('rank')->get();

    return Inertia::render('SubKriteria/IndexSubKriteria', ['kriteriaList' => $kriteria_joinsb]);
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
