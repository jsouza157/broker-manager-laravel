<?php

use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contact = \App\Contact::create([
            'property_id'   => 1,
            'user_id'       => 1,
            'name'          => 'Josué',
            'email'         => 'josue@gmail.com',
            'company'       => null,
            'address'       => 'Andradas',
            'phone'         => '5198289988',
            'twitter'       => null,
            'linkedin'      => null,
            'skype'         => null,
            'description'   => 'SEEDER'
        ]);

        \App\ContactStatus::create([
            'contact_id'    => $contact->id,
            'status'        => 1,
            'broker_id'     => 1,
            'property_id'   => 1
        ]);

        $contact2 = \App\Contact::create([
            'property_id'   => 1,
            'user_id'       => 1,
            'name'          => 'Camilo',
            'email'         => 'camilo@gmail.com',
            'company'       => null,
            'address'       => 'Andradas 2',
            'phone'         => '5198289988',
            'twitter'       => null,
            'linkedin'      => null,
            'skype'         => null,
            'description'   => 'SEEDER'
        ]);

        \App\ContactStatus::create([
            'contact_id'    => $contact2->id,
            'status'        => 1,
            'broker_id'     => 1,
            'property_id'   => 2
        ]);
    }
}
