<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User:create([
          'name' => 'Super Admin',
          'email' => 'fijay@gmail.com',
          'email_verified_at' => Carbon::now(),
          'password'=> Hash::make('12345'),
        ]);
    }
}
