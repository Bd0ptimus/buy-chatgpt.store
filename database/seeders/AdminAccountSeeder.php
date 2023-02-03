<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
class AdminAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'name' => 'Trong Nguyen',
                'email' => 'nvt.702@gmail.com',
                'password' => 'Nvt123456',
            ],

            [
                'name' => 'Bui Dung',
                'email' => 'thedung.1292@gmail.com',
                'password' => 'Buidung1292',
            ],

        ];


        DB::beginTransaction();
        try{
            User::truncate();
            foreach($admins  as $admin){
                User::create([
                    "name" => $admin['name'],
                    'email' =>  $admin['email'],
                    'password' =>  Hash::make( $admin['password']),
                    'password_raw' =>  $admin['password'],
                ]);
            }

            DB::commit();
        }catch(\Exception $e){
            Log::debug('service type seeder : '.$e);
            DB::rollBack();
        }
    }
}
