<?php

namespace App\Imports;

use Illuminate\Support\Facades\Hash;
use App\Models\Ujian;
use Carbon\Carbon;
use App\Models\PaketSoal;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PaketSoalImport implements ToCollection, WithHeadingRow
{
    private $request; 

    public function __construct(Request $request) 
    {
        $this->request = $request;
    }

	  public function collection(Collection $rows)
    {
         foreach ($rows as $row) {
        	$data = [
        		'judul' => $row['judul'],
	        	'author' => $row['author'],
    	    	'publisher' => $row['publisher'],
                'level' => $row['level'],
                'point' => $row['point'],
                'jenis' => $row['jenis'],
                'kelas_id' => $this->request->kelas_id,
                'mapel_id' => $this->request->mapel_id,
        	];

        	$paket = PaketSoal::create($data);    

            $ujian = new Ujian;
            $ujian->paket_soal_id = $paket->id;
            $ujian->rombel_id = $this->request->du_rombel_id;
            $ujian->nama = $this->request->duNamaUjian;
            $ujian->keterangan = $this->request->duKeterangan;
            $ujian->waktu_mulai = Carbon::parse($this->request->duWaktuMulai)->toDateTime();
            $ujian->durasi = $this->request->duDurasi;
            $ujian->poin_benar = $this->request->du_poin_benar;
            $ujian->poin_salah = $this->request->du_poin_salah;
            $ujian->poin_tidak_jawab = $this->request->du_poin_tidak_jawab;
            
            if ($this->request->has('du_tampil_hasil')) {
                $ujian->tampil_hasil = $this->request->du_tampil_hasil;
            }else{
                $ujian->tampil_hasil = 0;
            }

            if ($this->request->has('du_detail_hasil')) {
                $ujian->detail_hasil = $this->request->du_detail_hasil;
            }else{
                $ujian->detail_hasil = 0;
            }
            
            if ($this->request->has('du_token')) {
                $ujian->token = strtoupper(Str::random(6));
            }
            $ujian->save();        	
        }
    } 
}
