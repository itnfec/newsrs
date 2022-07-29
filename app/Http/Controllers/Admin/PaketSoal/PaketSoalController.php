<?php

namespace App\Http\Controllers\Admin\PaketSoal;

use App\Http\Controllers\Controller;
use App\Imports\PaketSoalImport;
use App\Models\PaketSoal;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

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
        $data = PaketSoal::with(['kelas','mapel'])->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('opsi', function ($data) {
                return '<button class="btn btn-xs btn-outline-danger btn-hapus" data-id="' . $data->id . '"><i class="fas fa-trash"></i> Hapus</button>';
            })
            ->rawColumns(['opsi'])
            ->make(true);
    }



    public function import()
    {
        return view('admin.paket_soal.import');
    }


    public function importDocument(Request $request)
    {

        
        Excel::import(new PaketSoalImport($request), $request->file('paket'));

        return view('admin.paket_soal.index');
    }


    public function select2(Request $request)
    {
        $data = PaketSoal::select('id', 'judul AS text')
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
       
       $description = $request->keterangan;
 
       $dom = new \DomDocument();
 
       $dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
 
       $images = $dom->getElementsByTagName('img');
 
       foreach($images as $k => $img){
 
 
           $data = $img->getAttribute('src');
 
           list($type, $data) = explode(';', $data);
 
           list(, $data)      = explode(',', $data);
 
           $data = base64_decode($data);
 
           $image_name= "/storage/documents/paket_soal/" . time().$k.'.png';
 
           $path = public_path() . $image_name;
 
           file_put_contents($path, $data);

           $img->removeAttribute('src');
 
           $img->setAttribute('src', $image_name);
 
        }


        $description = $dom->saveHTML();

        //image
        $cover = $request->file('image');
        if($cover != null){
            $cover->storeAs('public/book_images', $cover->hashName());
        }

        $request->keterangan = $description;

        $paket = PaketSoal::create([
            'judul'      => $request->judul,
            'author'     => $request->author,
            'publisher'  => $request->publisher,
            'level'      => $request->level,
            'point'      => $request->point,
            'jenis'      => $request->jenis,
            'kelas_id'   => $request->kelas_id,
            'mapel_id'   => $request->mapel_id,
            'keterangan' => $description,
            'image'      => $cover == null ? '' : $cover->hashName()
        ]);

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
