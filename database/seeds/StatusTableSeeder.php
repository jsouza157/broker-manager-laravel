<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
          'name'  => 'Aguardando atendimento'
        ]);
        Status::create([
          'name'  => 'Em atendimento'
        ]);
        Status::create([
          'name'  => 'Recusou atendimento'
        ]);
    }
}
