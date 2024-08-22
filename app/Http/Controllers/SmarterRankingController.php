<?php

namespace App\Http\Controllers;

use App\Models\HasilSmarter;
use App\Models\Kriteria;
use App\Models\Smarter;
use App\Models\SubKriteria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SmarterRankingController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $user = User::find(Auth::id());
    $dataAlternatif = $user->alternatif();
    $alternatif = $dataAlternatif->get();
    $alternatifIds = $dataAlternatif->pluck('id')->toArray();
    $smarterRecords = Smarter::whereIn('alternatif_id', $alternatifIds)
      ->orderBy('alternatif_id')
      ->get();
    $kriteria_joinsb = $user->kriteria()->with('subkriteria')->orderBy('rank')->get();

    return Inertia::render('Ranking/IndexRanking', ['listAlternatif' => $alternatif, 'listSmarter' => $smarterRecords, 'listKriteria' => $kriteria_joinsb]);
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
    $alternatifId = $request->alternatif_id;
    $list = $request->kriteria_subKriteria;


    try {
      foreach ($list as $value) {
        $dataList = explode(',', $value);
        $kriteriaId = $dataList[0];
        $subKriteriaId = $dataList[1];

        $bobotKriteria = Kriteria::where('id', $kriteriaId)->value('bobot');
        $bobotSubKriteria = SubKriteria::where('id', $subKriteriaId)->value('bobot');

        $attributes = [
          'alternatif_id' => $alternatifId,
          'kriteria_id' => $dataList[0],
        ];

        $values = [
          'sub_kriteria_id' => $dataList[1],
          'hasil_utility' => $bobotKriteria * $bobotSubKriteria
        ];

        Smarter::updateOrCreate($attributes, $values);
      }

      $totalUtility = Smarter::where('alternatif_id', $alternatifId)->sum('hasil_utility');
      $attributes = [
        'alternatif_id' => $alternatifId,
        'user_id' => Auth::id(),
      ];

      $values = [
        'total' => $totalUtility,
      ];

      HasilSmarter::updateOrCreate($attributes, $values);
      return to_route('ranking.index');
    } catch (\Exception $e) {
      return response()->json(['error' => 'Internal server error : ' . $e], 500);
    }
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
