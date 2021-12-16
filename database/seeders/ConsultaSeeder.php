<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Consulta;

class ConsultaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Consulta::factory(10)->create();
    }
}
