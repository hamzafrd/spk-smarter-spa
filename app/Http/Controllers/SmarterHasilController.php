<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\HasilSmarter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SmarterHasilController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $user = User::find(Auth::id());
    $listHasil = $user->alternatif()
      ->whereHas('hasilperhitungan') // Ensure only those with hasilperhitungan are included
      ->with(['hasilperhitungan' => function ($query) {
        $query->orderBy('total', 'DESC');
      }])
      ->join('hasilsmarter', 'alternatif.id', '=', 'hasilsmarter.alternatif_id')
      ->orderBy('hasilsmarter.total', 'DESC')
      ->select('alternatif.*') // Ensure only alternatif columns are selected
      ->get();
    return Inertia::render('HasilSmarter/IndexHasil', ['listHasil' => $listHasil]);
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
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
