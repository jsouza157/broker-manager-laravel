<?php

use Illuminate\Database\Seeder;

use App\User;
use App\UserPlan;
use carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::create([
        'company'   => 'Admin',
        'name'      => 'Admin',
        'email'     => 'admin@admin.com',
        'site'      => 'www.brokermanager.com.br',
        'api_token' => md5('admin@admin.com'.Carbon::now()),
        'password'  => bcrypt('123'),
        'active'    => true
      ]);

      UserPlan::firstOrCreate([
        'plan_id'       => 4,
        'user_id'       => 1, 
        'pay_day'       => Carbon::now(), 
        'status_pay'    => 'free',
        'token'         => '000000000',
        'correlationid' => '000000000',
        'build'         => '000000000',
        'PayerID'       => null
      ]);
    }
  }
