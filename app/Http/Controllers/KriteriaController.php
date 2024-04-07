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
        $kriteria = $user->kriteria()->orderBy('rank')->get();

        return Inertia::render('Kriteria/Index', ['kriteriaList' => $kriteria]);
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

            $this->checkRanks($user, $postData);

            // create kriteria
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

        $putData = [
            'nama' => $request->nama,
            'rank' => $request->rank['value'],
        ];

        try {
            $user = User::find(Auth::id());

            $this->checkRanks($user, $putData);
            // update kriteria
            $user->kriteria()->find($id)->update($putData);

            $this->updateBobot($user);

            return to_route('kriteria.index');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal server error : ' . $e], 500);
        }
    }



    /**
     * Remove the specified resource from storage.
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
        try {
            Kriteria::query()->delete();
            return to_route('kriteria.index');
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

    public function checkRanks($user, $data)
    {
        $kriteria = $user->kriteria()->get();

        // Jika rank sudah ada, turunkan 1 rank
        $isRankExist = $kriteria->where('rank', '==', $data['rank']);
        if ($isRankExist->first()) {
            $rank = $kriteria->where('rank', '>=', $data['rank']);
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
