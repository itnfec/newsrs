<?php

namespace App\Imports;

use Illuminate\Support\Facades\Hash;
use App\Models\PaketSoal;
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

        	PaketSoal::create($data);            	
        }
    } 
}
