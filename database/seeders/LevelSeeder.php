<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
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
                'name' => '1',
                'point' => 1.2,
            ],
            [
                'name' => '2',
                'point' => 2.2,
            ],
            [
                'name' => '3',
                'point' => 3.2,
            ],
            [
                'name' => '4',
                'point' => 4.2,
            ],
            [
                'name' => '5',
                'point' => 5.2,
            ],
        ];
        foreach ($data as $key => $value) {
            Level::create($value);
        }
    }
}
