<?php

use Illuminate\Database\Seeder;

class BrokerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Broker::create([
            'user_id'       => 1,
            'name'          => 'Jefferson',
            'email'         => 'jefferson@gmail.com',
            'password'      => bcrypt(123),
            'phone'         => '51989898998',
            'active'        => true,
            'admin'         => false
        ]);

        \App\Broker::create([
            'user_id'       => 1,
            'name'          => 'Douglas',
            'email'         => 'douglas@gmail.com',
            'password'      => bcrypt(123),
            'phone'         => '51989898998',
            'active'        => true,
            'admin'         => false
        ]);

        \App\Broker::create([
            'user_id'       => 1,
            'name'          => 'Cleito',
            'email'         => 'cleito@gmail.com',
            'password'      => bcrypt(123),
            'phone'         => '51989898998',
            'active'        => true,
            'admin'         => false
        ]);

    }
}
