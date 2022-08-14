<?php

namespace App\Http\Controllers\Admin\Level;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.level.index');
    }

    public function dataTable()
    {
        return DataTables::of(Level::query())
            ->addIndexColumn()
            ->addColumn('opsi', function ($data) {
                return '<button class="btn btn-xs btn-outline-warning btn-edit" data-id="'.$data->id.'" data-nama="'.$data->name.'"><i class="fas fa-edit"></i> Edit</button>
                <button class="btn btn-xs btn-outline-danger btn-hapus" data-id="'.$data->id.'"><i class="fas fa-trash"></i> Hapus</button>';
            })
            ->rawColumns(['opsi'])
            ->make(true);
    }

    public function select2()
    {
        $level = Level::select('id', 'name as text')->get();

        return response()->json([
            'status' => TRUE,
            'results' => $level
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
        $level = new Level;
        $level->name = $request->name;
        $level->point = $request->point;
        $level->save();

        return response()->json([
            'status' => TRUE,
            'data' => $level
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Level $level)
    {
        return response()->json([
            'status' => TRUE,
            'data' => $level
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
        $level = Level::where('id', $id)->first();
        $level->name = $request->name;
        $level->point = $request->point;
        $level->save();

        return response()->json([
            'status' => TRUE,
            'data' => $level
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $level = Level::findOrFail($id);
        $level->delete();
    
        return response()->json([
            'status' => TRUE
        ], 200);
    }
}
