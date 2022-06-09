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
        $domain = Domain::first();

        if (!$domain) {
            $domain = new Domain;
        }

        $domain->name = 'testestes';
        $domain->school_name = 'testes 1';
        $domain->save();
    }
}
