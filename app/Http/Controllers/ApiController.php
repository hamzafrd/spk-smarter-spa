<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{

  public function updateKriteriaPositions(Request $request)
  {

    $items = $request->input('listKriteria');
    $bobot = $request->input('bobot');

    try {
      foreach ($items as $index => $item) {
        Kriteria::where('id', $item['id'])->update([
          'rank' => $index + 1,
          'bobot' => $bobot[$index]
        ]);
      }

      $user = User::find(Auth::id());
      $kriteria = $user->kriteria()->orderBy('rank')->get();

      return response()->json([
        'message' => 'Positions updated successfully',
        'status' => 'true',
        'updatedData' => $kriteria
      ]);
    } catch (\Exception $e) {
      return response()->json(['error' => 'Internal server error : ' . $e], 500);
    }
  }

  public function getDatalist($category = 'kriteria')
  {
    $user = User::find(Auth::id());
    $newKriteria = $user->kriteria()->with('subkriteria')->with('smarter')->orderBy('rank')->get();
    $alternatif = $user->alternatif()->with('smarter')->get();

    return response()->json(['updatedData' => $newKriteria, 'alternatif' => $alternatif]);
  }
}
