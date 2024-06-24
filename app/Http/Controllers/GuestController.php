<?php
// app/Http/Controllers/KriteriaController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\SubKriteria;

class GuestController extends Controller
{
  public function getKriteriaNama($user_id)
  {
    // Fetch all kriteria where user_id is $user_id
    $kriteriaList = Kriteria::where('user_id', $user_id)->get()->sortBy('rank');

    // Return the result as JSON
    return response()->json($kriteriaList);
  }

  public function getSubKriteriaOptions($kriteria_id)
  {
    // Fetch sub_kriteria where kriteria_id is $kriteria_id
    $subKriteriaList = SubKriteria::where('kriteria_id', $kriteria_id)->get();

    // Format the data for Select2
    $options = $subKriteriaList->map(function ($subKriteria) {
      return [
        'id' => $subKriteria->id,
        'text' => $subKriteria->nama,
        'bobot' => $subKriteria->bobot

      ];
    });

    // Return the result as JSON
    return response()->json($options);
  }
}
