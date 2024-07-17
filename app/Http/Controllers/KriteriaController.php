<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class KriteriaController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $user = User::find(Auth::id());
    $kriteria = $user->kriteria()->with('subkriteria')->orderBy('rank')->get();

    return Inertia::render('Kriteria/IndexKriteria', ['kriteriaList' => $kriteria]);
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
      'nama' => 'Isi kriteria terlebih dahulu',
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

      $this->updateRanks($user, $postData, true);
      $user->kriteria()->create($postData);
      $this->updateBobot($user);

      return to_route('kriteria.index');
    } catch (\Exception $e) {
      return response()->json(['error' => 'Internal server error : ' . $e], 500);
    }
  }


  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
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
      'nama' => 'Isi kriteria terlebih dahulu',
      'rank.value.required' => 'Isi peringkat terlebih dahulu.',
      'rank.value.numeric' => 'Nilai yang dimasukan harus berupa angka.',
      'rank.value.min' => 'Nilai peringkat minimum adalah :min.',
      'rank.value.max' => 'Nilai peringkat maximum :max.',
    ]);

    $requestData = [
      'nama' => $request->nama,
      'rank' => [
        'id' => $id,
        'oldValue' => $request->rank['oldValue'],
        'newValue' => $request->rank['value']
      ],
    ];

    $putData = [
      'nama' => $request->nama,
      'rank' => $request->rank['value']
    ];



    try {
      $user = User::find(Auth::id());

      $this->updateRanks($user, $requestData);
      $user->kriteria()->find($id)->update($putData);
      $this->updateBobot($user);

      return to_route('kriteria.index');
    } catch (\Exception $e) {
      return response()->json(['error' => 'Internal server error : ' . $e], 500);
    }
  }

  private function updateRanks($user, $data, $isStore = false)
  {
    $kriteria = $user->kriteria()->get();

    if ($isStore) {
      $id = $kriteria->where('rank', '=', $data['rank'])->first();
      if ($id) {
        $rank = $kriteria->where('rank', '>=', $data['rank']);
        foreach ($rank as $value) {
          $value->update(['rank' => ($value->rank + 1)]);
        }
      }
      return;
    }

    if ($data['rank']['newValue'] == $data['rank']['oldValue']) return;
    if ($data['rank']['newValue'] > $data['rank']['oldValue']) {
      $rank = $kriteria->where('rank', '<=', $data['rank']['newValue'])->where('id', '!=', $data['rank']['id']);
      foreach ($rank as $value) {
        $value->update(['rank' => ($value->rank - 1)]);
      }
    } else {
      $rank = $kriteria->where('rank', '>=', $data['rank']['newValue'])->where('id', '!=', $data['rank']['id']);;
      foreach ($rank as $value) {
        $value->update(['rank' => ($value->rank + 1)]);
      }
    }
  }

  public function updateBobot($user)
  {
    $kriteria = $user->kriteria()->orderBy('rank')->get();

    // Update bobot masing" kriteria
    $bobot = $this->getBobot(count($kriteria));
    foreach ($kriteria as $index => $item) {
      $item->update([
        'bobot' => $bobot[$index],
        'rank' => $index + 1
      ]);
    }
  }

  /**
   * Remove the specified resource from storage
   * id is kriteria_id
   */
  public function destroy(string $id)
  {
    try {
      $user = User::find(Auth::id());

      // update kriteria
      $user->kriteria()->find($id)->delete();

      $this->updateBobot($user);

      return to_route('kriteria.index');
    } catch (\Exception $e) {
      return response()->json(['error' => 'Internal server error : ' . $e], 500);
    }
  }


  /**
   * DELETE ALL
   */
  public function destroyAll()
  {
    $data = Kriteria::where('user_id', Auth::id())->delete();
    return to_route('kriteria.index');
    try {
    } catch (\Exception $e) {
      return response()->json(['error' => 'Internal server error : ' . $e], 500);
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
}
