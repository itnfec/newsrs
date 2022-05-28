<?php

namespace App\Http\Controllers\Admin\Ujian;

use App\Http\Controllers\Controller;
use App\Models\Ujian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class UjianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.ujian.index');
    }

    public function dataTable(Request $request)
    {
        $data = Ujian::with('rombel:id,nama', 'paketSoal:id,nama')
        ->doesntHave('ujianSiswa');
        return DataTables::of($data)
        ->addColumn('opsi', function ($data) {
            return '<a href="' . url('admin/ujian/'.$data->id.'/edit') . '" class="btn btn-xs btn-outline-warning" data-target="#modalEdit"><i class="fas fa-edit"></i> Edit</a>
            <button class="btn btn-xs btn-outline-danger btn-hapus" data-id="' . $data->id . '"><i class="fas fa-trash"></i> Hapus</button>';
        })
        ->rawColumns(['opsi'])
        ->addIndexColumn()
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $ujian = new Ujian;
        $ujian->paket_soal_id = $request->paket_soal_id;
        $ujian->rombel_id = $request->rombel_id;
        $ujian->nama = $request->nama;
        $ujian->keterangan = $request->keterangan;
        $ujian->waktu_mulai = Carbon::parse($request->waktu_mulai)->toDateTime();
        $ujian->durasi = $request->durasi;
        $ujian->tampil_hasil = $request->tampil_hasil;
        $ujian->detail_hasil = $request->detail_hasil;

        // $ujian->poin_benar = $request->poin_benar;
        // $ujian->poin_salah = $request->poin_salah;
        // $ujian->poin_tidak_jawab = $request->poin_tidak_jawab;

        if ($request->has('token')) {
            $ujian->token = strtoupper(Str::random(6));
        }

        $ujian->save();

        return response()->json([
            'status' => TRUE,
            'data' => $ujian
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ujian $ujian)
    {
        return response()->json([
            'status' => TRUE,
            'data' => $ujian
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Ujian::find($id);
        return view('admin.ujian.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ujian $ujian)
    {
        $ujian->delete();

        return response()->json([
            'status' => TRUE,
        ], 200);
    }
}
