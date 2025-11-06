<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->delete();
    //   User::create([
    //   'first_name'     => 'Stijn',
    //   'last_name'     => 'Mensing',
    //   'entered_event' => '',
    //   'email'    => 'management@tronic-solutions.nl',
    //   'password' => Hash::make('wachtwoord'),
    //   'permission' => '1',
    //   'street' => 'Buitendijk 29',
    //   'zip' => '4273GC',
    //   'town' => 'Hank',
    //   'country' => 'Nederland'
    // ]);
      User::create([
      'first_name'     => 'Stijn',
      'last_name'     => 'Mensing',
      'entered_event' => '',
      'email'    => 'admin@admin.com',
      'password' => Hash::make('123456789'),
      'permission' => '3',
      'street' => 'Buitendijk 29',
      'zip' => '4273GC',
      'town' => 'Hank',
      'country' => 'Nederland'
    ]);
      User::create([
      'first_name'     => 'Vendor',
      'last_name'     => 'Mensing',
      'entered_event' => '',
      'email'    => 'vendor@vendor.com',
      'password' => Hash::make('123456789'),
      'permission' => '2',
      'street' => 'Buitendijk 29',
      'zip' => '4273GC',
      'town' => 'Hank',
      'country' => 'Nederland'
    ]);
      User::create([
      'first_name'     => 'User',
      'last_name'     => 'Mensing',
      'entered_event' => '',
      'email'    => 'user@user.com',
      'password' => Hash::make('123456789'),
      'permission' => '1',
      'street' => 'Buitendijk 29',
      'zip' => '4273GC',
      'town' => 'Hank',
      'country' => 'Nederland'
    ]);

    }
}
