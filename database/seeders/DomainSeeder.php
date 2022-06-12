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
        $domain = new Domain();
                $domain->name = 'localhost:800' . $i;
                $domain->school_name = 'testes' . $i;
                $domain->save();
    }
}
