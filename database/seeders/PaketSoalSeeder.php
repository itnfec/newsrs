<?php

namespace Database\Seeders;

use App\Models\PaketSoal;
use Illuminate\Database\Seeder;

class PaketSoalSeeder extends Seeder
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
                'judul' => 'tes judul',
                'author' => 'tes author',
                'publisher' => 'tes piblisher',
                'level' => 3,
                'point' => 1.4,
                'jenis' => 'buku',
            ]
        ];
        foreach ($data as $key => $value) {
            PaketSoal::create($value);
        }
    }
}
