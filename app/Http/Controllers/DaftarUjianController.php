<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DaftarUjianController extends Controller
{

    public function index()
    {

        $ujian = Ujian::with('paketSoal.mapel')->where([
            'rombel_id' => auth()->user()->rombel_id
        ])->paginate(6);


        return view('daftar_ujian', compact('ujian'));
    }

    public function show(Ujian $ujian) {
        $ujian->load('paketSoal');

        if ($ujian->token != null) {
            $ujian->token = true;
        }

        return response()->json($ujian);
    }
}
