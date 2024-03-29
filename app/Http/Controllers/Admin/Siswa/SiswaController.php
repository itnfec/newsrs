<?php

namespace App\Http\Controllers\Admin\Siswa;

use App\Http\Controllers\Controller;
use App\Imports\SiswaImport;
use App\Models\Siswa;
use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('admin.siswa.index');
    }

    public function dataTable()
    {
        return DataTables::of(Siswa::with(['level','domain']))
            ->addIndexColumn()
            ->addColumn('opsi', function ($data) {
                return '<button class="btn btn-xs btn-outline-warning btn-edit" data-id="'.$data->id.'" data-level-id="'.$data->level->id.'" data-level-name="'.$data->level->name.'" data-nama="'.$data->nama.'" data-nis="'.$data->nis.'" data-jenis-kelamin="'.$data->jenis_kelamin.'"><i class="fas fa-edit"></i> Edit</button>
                <button class="btn btn-xs btn-outline-danger btn-hapus" data-id="'.$data->id.'"><i class="fas fa-trash"></i> Hapus</button>';
            })
            ->addColumn('domain_id', function ($data) {
                if (empty($data->domain)) {
                    return '<span class="badge badge-pill badge-primary"> SEKOLAH TIDAK TERHUBUNG </span>';
                } else {
                    return '<span class="badge badge-pill badge-primary">'. $data->domain->school_name .'</span>';
                }
            })
            ->rawColumns(['opsi','domain_id'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['nis']);
        $siswa = Siswa::create($data);

        return response()->json([
            'status' => TRUE,
            'data' => $siswa
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        $siswa->load('rombel');

        return response()->json([
            'status' => TRUE,
            'data' => $siswa
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
        $data = $request->except('_method');

        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $siswa = Siswa::where('id', $id)->update($data);

        return response()->json([
            'status' => TRUE,
            'data' => $siswa
        ], 200);
    }


    public function select2sekolah(Request $request)
    {
         $domain = Domain::select('id', 'school_name AS text', 'id');

        if ($request->school_name != null) {
            $domain = $domain->where('school_name', $request->school_name);
        }

        $domain = $domain->get();

        return response()->json([
            'status' => TRUE,
            'results' => $domain
        ], 200);
    }


     public function import()
    {
        return view('admin.siswa.import');
    }

    public function importDocument(Request $request)
     {
        Excel::import(new SiswaImport($request), $request->file('siswa'));
        return redirect('admin/siswa');
     }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return response()->json([
            'status' => TRUE
        ], 200);
    }
}
