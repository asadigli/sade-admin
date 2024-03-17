<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->delete();
      $users = array(
        array(
          'name' => 'Azad',
          'email'=> 'azad@admin.com',
          'surname'=> 'Sadigli',
          'gender' => '1',
          'country' => '1',
          'city'=> '1',
          'dob' => Carbon::create('1995', '12', '12'),
          'mobile' => '324234',
          'postalcode' => 'AZ34534',
          'address'  => 'Baku,Binagadi',
          'role_id' => '4',
          'password' => Hash::make('admin1admin'),

        )
      );
        // $user->name = "Azad";
        // $user->email= "azad@admin.com";
        // $user->surname= "Sadigli",
        // $user->gender = "1";
        // $user->country = "1";
        // $user->city= "1";
        // $user->dob ="29/11/1995";
        // $user->mobile = "324234";
        // $user->postalcode = "AZ34534";
        // $user->address  = "Baku,Binagadi";
        // $user->role_id = "4";
        // $user->password = Hash::make('admin1admin');
        // $user->save();
        DB::table('users')->insert($users);
    }
}
