<?php

namespace App\Imports;

use Illuminate\Support\Facades\Hash;
use App\Models\Siswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SiswaImport implements ToCollection, WithHeadingRow, WithValidation
{

	private $rombel_id;

    public function __construct(String $rombel_id) 
    {
        $this->rombel_id = $rombel_id;
    }


	  public function collection(Collection $rows)
    {
         foreach ($rows as $row) {
        	$data = [
        		'nama' => $row['nama'],
	        	'nis' => $row['nis'],
    	    	'jenis_kelamin' => $row['jenis_kelamin'],
    	    	'password' => Hash::make('siswa'),
    	    	'rombel_id' => $this->rombel_id
        	];

        	Siswa::create($data);            	
        }
    }

  public function rules(): array
  {
  	return [
  		'nis' => 'required|unique:siswa,nis'
  	];
  } 
}
