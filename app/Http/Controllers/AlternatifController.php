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
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    // dd($request);
    $rules = [
      'nama' => 'required|max:255',

    ];
    $request->validate($rules, [
      'nama' => 'Isi alternatif terlebih dahulu',

    ]);

    $postData = [
      'nama' => $request->nama,
    ];

    try {
      $user = User::find(Auth::id());

      $user->alternatif()->create($postData);

      return to_route('alternatif.index');
    } catch (\Exception $e) {
      return response()->json(['error' => 'Internal server error : ' . $e], 500);
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request,  $idAlternatif)
  {
    $rules = [
      'nama' => 'required|max:255',

    ];
    $request->validate($rules, [
      'nama' => 'Isi alternatif terlebih dahulu',

    ]);

    $postData = [
      'nama' => $request->nama,
    ];

    try {
      $user = User::find(Auth::id());
      $user->alternatif()->find($idAlternatif)->update($postData);

      return to_route('alternatif.index');
    } catch (\Exception $e) {
      return response()->json(['error' => 'Internal server error : ' . $e], 500);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $idAlternatif)
  {
    try {
      Alternatif::find($idAlternatif)->delete();

      return to_route('alternatif.index');
    } catch (\Throwable $th) {
      return response()->json(['error' => 'Internal server error : ' . $th], 500);
    }
  }


  /**
   * Display the specified resource.
   */
  public function show(Alternatif $alternatif)
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create() {}

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Alternatif $alternatif)
  {
    //
  }
}
