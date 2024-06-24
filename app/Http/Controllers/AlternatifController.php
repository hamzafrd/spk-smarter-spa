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
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    // dd($request);
    $rules = [
      'nama' => 'required|max:255',
      'rank.value' => [
        'required',
        'numeric',
        'min:' . $request->rank['min'],
        'max:' . $request->rank['max'],
      ],
    ];
    $request->validate($rules, [
      'nama' => 'Isi alternatif terlebih dahulu',
      'rank.value.required' => 'Isi peringkat terlebih dahulu.',
      'rank.value.numeric' => 'Nilai yang dimasukan harus berupa angka.',
      'rank.value.min' => 'Nilai peringkat minimum adalah :min.',
      'rank.value.max' => 'Nilai peringkat tidak boleh melebihi :max.',
    ]);

    $postData = [
      'nama' => $request->nama,
      'rank' => $request->rank['value'],
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
