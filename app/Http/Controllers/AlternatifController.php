<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AlternatifController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $user = User::find(Auth::id());
    $alternatif = $user->alternatif()->get();

    return Inertia::render('Alternatif/IndexAlternatif', ['listAlternatif' => $alternatif]);
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
  public function show(Alternatif $alternatif)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Alternatif $alternatif)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Alternatif $alternatif)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Alternatif $alternatif)
  {
    //
  }
}
