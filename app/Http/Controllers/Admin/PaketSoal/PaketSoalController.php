<?php

namespace App\Http\Controllers\Admin\PaketSoal;

use App\Http\Controllers\Controller;
use App\Models\PaketSoal;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PaketSoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.paket_soal.index');
    }

    public function dataTable()
    {
        return DataTables::of(PaketSoal::with('kelas', 'mapel'))
            ->addIndexColumn()
            ->addColumn('opsi', function ($data) {
                return '<button class="btn btn-xs btn-outline-warning btn-edit" data-id="' . $data->id . '" data-kelas-id="' . $data->kelas->id . '" data-kelas-nama="' . $data->kelas->nama . '" data-mapel-id="' . $data->mapel->id . '" data-mapel-nama="' . $data->mapel->nama . '" data-kode="' . $data->kode_paket . '" data-nama="' . $data->nama . '" data-keterangan="' . $data->keterangan . '"><i class="fas fa-edit"></i> Edit</button>
                <button class="btn btn-xs btn-outline-danger btn-hapus" data-id="' . $data->id . '"><i class="fas fa-trash"></i> Hapus</button>';
            })
            ->rawColumns(['opsi'])
            ->make(true);
    }

    public function select2(Request $request)
    {
        $data = PaketSoal::select('id', 'nama AS text')
            ->where([
                'kelas_id' => $request->kelas_id,
                'mapel_id' => $request->mapel_id
            ]);

        if ($request->has('type') && $request->type == 'ujian') {
            $data = $data->has('soal');
        }

        $data = $data->get();

        return response()->json([
            'status' => TRUE,
            'results' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $paket = PaketSoal::create($request->all());

        return response()->json([
            'status' => TRUE,
            'data' => $paket
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PaketSoal $paketSoal)
    {
        return response()->json([
            'status' => TRUE,
            'data' => $paketSoal
        ], 200);
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
        $data = PaketSoal::where('id', $id)->update($request->except('_method'));

        return response()->json([
            'status' => TRUE,
            'data' => $data
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaketSoal $paketSoal)
    {
        $paketSoal->delete();

        return response()->json([
            'status' => TRUE,
        ], 200);
    }
}
