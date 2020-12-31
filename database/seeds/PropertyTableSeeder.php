<?php

use Illuminate\Database\Seeder;

class PropertyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 20; $i++) {
            $property = \App\Property::create([
                'name'              => 'Teste de apresentação '.$i,
                'address'           => 'teste '.$i,
                'city'              => 'Porto Alegre',
                'state'             => 'RS',
                'cep'               => '93888123',
                'type'              => 'Casa',
                'floor'             => 3,
                'garage'            => true,
                'garage_vacancy'    => 2,
                'contact_phone'     => '99999999999',
                'contact_email'     => $i.'teste@gmail.com',
                'price'             => '1230000',
                'rentals'           => '1234',
                'property_detail'   => 'teste de descrição',
                'user_id'           => 1
            ]);

            \App\Image::create([
                'user_id'       => 1,
                'property_id'   => $property->id,
                'image'         => 'https://s3-sa-east-1.amazonaws.com/easymovel/easymovel/cGxhbnRhMS5qcGcxMjM6NTk6Mzg%3D'
            ]);
        }
    }
}
