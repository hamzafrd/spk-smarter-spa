<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
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
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
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
      'nama' => 'Isi sub kriteria terlebih dahulu',
      'rank.value.required' => 'Isi peringkat terlebih dahulu',
      'rank.value.numeric' => 'Nilai yang dimasukan harus berupa angka',
      'rank.value.min' => 'Nilai peringkat minimum adalah :min',
      'rank.value.max' => 'Nilai peringkat tidak boleh melebihi :max',
    ]);


    $postData = [
      'nama' => $request->nama,
      'rank' => $request->rank['value'],
    ];

    try {
      $kriteria = Kriteria::find($request->id);

      $this->updateRanks($kriteria, $postData, true);
      $kriteria->subkriteria()->create($postData);
      $this->updateBobot($kriteria);

      return to_route('subkriteria.index');
    } catch (\Exception $e) {
      return response()->json(['error' => 'Internal server error : ' . $e], 500);
    }
  }


  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $idSubKriteria)
  {
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
      'nama' => 'Isi sub kriteria terlebih dahulu',
      'rank.value.required' => 'Isi peringkat terlebih dahulu',
      'rank.value.numeric' => 'Nilai yang dimasukan harus berupa angka',
      'rank.value.min' => 'Nilai peringkat minimum adalah :min',
      'rank.value.max' => 'Nilai peringkat tidak boleh melebihi :max',
    ]);


    $requestData = [
      'nama' => $request->nama,
      'rank' => [
        'id' => $idSubKriteria,
        'oldValue' => $request->rank['oldValue'],
        'newValue' => $request->rank['value']
      ],
    ];

    $putData = [
      'nama' => $request->nama,
      'rank' => $request->rank['value']
    ];

    try {
      $kriteria = Kriteria::find($request->id);

      $this->updateRanks($kriteria, $requestData);
      $kriteria->subkriteria()->find($idSubKriteria)->update($putData);
      $this->updateBobot($kriteria);

      return to_route('subkriteria.index');
    } catch (\Exception $e) {
      return response()->json(['error' => 'Internal server error : ' . $e], 500);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(SubKriteria $subKriteria)
  {
    try {
      $kriteria = Kriteria::find($subKriteria->kriteria_id);
      $subKriteria->find($subKriteria->id)->delete();

      $this->updateBobot($kriteria);

      return to_route('subkriteria.index');
    } catch (\Throwable $th) {
      return response()->json(['error' => 'Internal server error : ' . $th], 500);
    }
  }

  /**
   * DELETE ALL
   */
  public function destroyAll()
  {
    try {
      SubKriteria::query()->delete();
      return to_route('kriteria.index');
    } catch (\Exception $e) {
      return response()->json(['error' => 'Internal server error : ' . $e], 500);
    }
  }


  private function updateRanks($kriteria, $data, $isStore = false)
  {
    $subKriteria = $kriteria->subkriteria()->get();
    if ($isStore) {
      $id = $subKriteria->where('rank', '=', $data['rank'])->first();
      if ($id) {
        $rank = $subKriteria->where('rank', '>=', $data['rank']);
        foreach ($rank as $value) {
          $value->update(['rank' => ($value->rank + 1)]);
        }
      }
      return;
    }

    if ($data['rank']['newValue'] == $data['rank']['oldValue']) return;
    if ($data['rank']['newValue'] > $data['rank']['oldValue']) {
      $rank = $subKriteria->where('rank', '<=', $data['rank']['newValue'])->where('id', '!=', $data['rank']['id']);
      foreach ($rank as $value) {
        $value->update(['rank' => ($value->rank - 1)]);
      }
    } else {
      $rank = $subKriteria->where('rank', '>=', $data['rank']['newValue'])->where('id', '!=', $data['rank']['id']);;
      foreach ($rank as $value) {
        $value->update(['rank' => ($value->rank + 1)]);
      }
    }
  }

  public function updateBobot($kriteria)
  {
    $subkriteria = $kriteria->subkriteria()->orderBy('rank')->get();

    // Update bobot masing" kriteria
    $bobot = $this->getBobot(count($subkriteria));
    foreach ($subkriteria as $index => $item) {
      $item->update([
        'bobot' => $bobot[$index],
        'rank' => $index + 1
      ]);
    }
  }

  public function getBobot($n)
  {
    $list = [];
    $valueNow = 0;

    for ($i = 0; $i < $n; $i++) {
      $valueNow += 1 / ($n - $i) / $n;
      $list[] = number_format($valueNow, 3);
    }

    return array_reverse($list);
  }


  /**
   * Show the form for creating a new resource.
   */
  public function create()
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
}
