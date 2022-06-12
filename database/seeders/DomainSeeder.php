<?php

namespace Database\Seeders;

use App\Models\Domain;
use Illuminate\Database\Seeder;

class DomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'binailmi.readingsystem.id',
                'school_name' => 'Bina Ilmi',
                'logo' => null,
            ],
            [
                'name' => 'siba-ummulqurodepok.id',
                'school_name' => 'Ummul Quro',
                'logo' => null,
            ],
            [
                'name' => 'nf-testingcenter.org',
                'school_name' => 'SRS - NF Testing Center',
                'logo' => null,
            ],
            [
                'name' => 'kaifa.readingsystem.id',
                'school_name' => 'Kaifa',
                'logo' => null,
            ],
            [
                'name' => 'newsrs.test',
                'school_name' => 'SRS - NEW',
                'logo' => null,
            ],
        ];
        foreach ($data as $key => $value) {
            Domain::create($value);
        }
    }
}
