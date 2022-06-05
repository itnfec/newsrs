<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\Soal;
use App\Models\SoalPilihan;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SoalImport implements ToCollection, WithHeadingRow
{
	private $paket_soal_id;

    public function __construct(int $paket_soal_id) 
    {
        $this->paket_soal_id = $paket_soal_id;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
        	$dataSoal = [
        		'pertanyaan' => '<p>'. $row['pertanyaan'] . '</p>',
	        	'jenis' => 'pilihan_ganda',
    	    	'paket_soal_id' => $this->paket_soal_id,
        	];

        	$soal = Soal::create($dataSoal);            	
        	$this->checkJabawab($rows[$index], $soal, $row['jawaban_benar']);
        }
    }


    private function checkJabawab($rows, $soal, $jawaban)
    {
    	unset($rows['pertanyaan']);
	    unset($rows['jawaban_benar']);
        
        foreach ($rows as $index => $row) {
    		$soalJawaban = [
        		'soal_id' => $soal->id,
        		'jawaban' => $rows[$index],
        		'status' => $index == $jawaban ? 1 : 0
        	];		

			SoalPilihan::create($soalJawaban);
		}
    } 
}







