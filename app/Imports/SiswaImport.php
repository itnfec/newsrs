<?php

namespace App\Imports;

use Illuminate\Support\Facades\Hash;
use App\Models\Siswa;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SiswaImport implements ToCollection, WithHeadingRow, WithValidation
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
        		'nama' => $row['nama'],
	        	'nis' => $row['nis'],
    	    	'jenis_kelamin' => $row['jenis_kelamin'],
    	    	'password' => Hash::make('siswa'),
    	    	'level_id' => $this->request->level_id,
    	    	'domain_id' => $this->request->school_id,
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
