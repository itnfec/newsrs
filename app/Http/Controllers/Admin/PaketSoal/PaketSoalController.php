<?php

namespace App\Http\Controllers\Admin\PaketSoal;

use App\Http\Controllers\Controller;
use App\Imports\PaketSoalImport;
use App\Models\PaketSoal;
use App\Models\Soal;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

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
                return '
        <a href="' . url('admin/paket/'.$data->id.'/detail') . '" class="btn btn-xs btn-outline-primary"><i class="fas fa-edit"></i> Detail</a>
                <button class="btn btn-xs btn-outline-danger btn-hapus" data-id="' . $data->id . '"><i class="fas fa-trash"></i> Hapus</button>';
            })
            ->rawColumns(['opsi'])
            ->make(true);
    }


    public function soalDataTable($id){
        $data = Soal::where('paket_soal_id', $id)->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('opsi', function ($data) {
                return '<a href="' . url('admin/paket/'.$data->id.'/detail') . '" class="btn btn-xs btn-outline-primary"><i class="fas fa-edit"></i> Detail</a>
                <button class="btn btn-xs btn-outline-danger btn-hapus" data-id="' . $data->id . '"><i class="fas fa-trash"></i> Hapus</button>';
            })
            ->rawColumns(['opsi'])
            ->make(true);
    }


    public function detail($id){
        $paket = PaketSoal::with('kelas','mapel')->where('id', $id)->first();
        return view('admin/paket_soal/detail', compact('id', 'paket'));
    }


    public function import()
    {
        return view('admin.paket_soal.import');
    }


    public function importDocument(Request $request)
    {
   
        Excel::import(new PaketSoalImport($request), $request->file('paket'));

        return redirect()->back()->with('success', 'import berhasil');   
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


    public function updatePaketSoal(Request $request){
        $paket = PaketSoal::findOrFail($request->id);
        $id = $paket->id;

        $this->validate($request, [
            'image' => 'image|mimes:jpeg,jpg,png|max:2000',
        ]); 

        if($request->file('image') == '') {            
             $paket->update([
                'judul'   => $request->judul,
                'author'   => $request->author,
                'publisher'   => $request->publisher,
                'level'   => $request->level,
                'jenis'   => $request->jenis,
                'point'   => $request->point,
                'keterangan'   => $request->keterangan,
                'kelas_id'   => $request->kelas_id,
                'mapel_id'   => $request->mapel_id
            ]);

        } else {

            Storage::disk('local')->delete('public/book_images/'.basename($paket->image));
            $image = $request->file('image');            
            $image->storeAs('public/book_images', $image->hashName());

            $paket->update([
                'image'  => $image->hashName(),
                'judul'   => $request->judul,
                'author'   => $request->author,
                'publisher'   => $request->publisher,
                'level'   => $request->level,
                'point'   => $request->point,
                'jenis'   => $request->jenis,                
                'keterangan'   => $request->keterangan,
                'kelas_id'   => $request->kelas_id,
                'mapel_id'   => $request->mapel_id
            ]);

        }

        if($paket){
            //redirect dengan pesan sukses
            return redirect()->route('paket.detail',compact('id', 'paket'))->with(['success' => 'Data Berhasil Diupdate!']);
        }else{

            //redirect dengan pesan error
            return redirect()->route('paket.detail',compact('id', 'paket'))->with(['error' => 'Data Gagal Diupdate!']);
        }

    }

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
