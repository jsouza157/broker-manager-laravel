<?php

use Illuminate\Database\Seeder;

class PlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \App\Plan::create([
          'name'              => 'Básico',
          'qtd_users'         => 5,
          'qtd_imgs'          => 5,
          'qtd_properties'    => 50,
          'value'             => '59.90',
          'tasting'           => false
      ]);

      \App\Plan::create([
          'name'              => 'Intermediário',
          'qtd_users'         => 10,
          'qtd_imgs'          => 5,
          'qtd_properties'    => 200,
          'value'             => '89.90',
          'tasting'           => false
      ]);

      \App\Plan::create([
          'name'              => 'Max',
          'qtd_users'         => 20,
          'qtd_imgs'          => 8,
          'qtd_properties'    => null,
          'value'             => '110.90',
          'tasting'           => false
      ]);

      \App\Plan::create([
          'name'              => 'Free',
          'qtd_users'         => 2,
          'qtd_imgs'          => 3,
          'qtd_properties'    => 30,
          'value'             => '0.0',
          'tasting'           => true
      ]);
    }
}
