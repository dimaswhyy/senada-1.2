<?php

namespace App\Http\Controllers\Backend\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\PesertaDidik;
use Illuminate\Http\Request;

class APIGetSiswaController extends Controller
{
    //
    public function getSiswaOptions(Request $request)
    {
        $term = $request->input('term'); // Get the term parameter from the request

        $query = PesertaDidik::query();

        // If a search term is provided, filter the results
        if ($term) {
            $query->where('name', 'like', '%' . $term . '%');
        }

        $siswaOptions = $query->get(['id', 'name']);
        
        return response()->json($siswaOptions);
    }
}
