<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

use App\Models\PaymentMethod;
class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $methods = [
            [
                'bank_account_number' => '0451000438770',
                'name_receiver' => 'NGUYEN VAN TRONG',
                'qr_url' => 'https://res.cloudinary.com/dz2nppyex/image/upload/v1677033672/z4128332432556_e81b1037b91a56226616c16f65d82c8f_qsmxl4.jpg',
                'payment_id' => PAYMENT_TYPE_VIETCOMBANK,
            ],

        ];

        DB::beginTransaction();
        try{
            PaymentMethod::truncate();
            foreach($methods  as $method){
                PaymentMethod::create([
                    "bank_account_number" => $method['bank_account_number'],
                    'name_receiver' =>  $method['name_receiver'],
                    'qr_url' =>  $method['qr_url'],
                    'payment_id' =>  $method['payment_id'],
                ]);
            }

            DB::commit();
        }catch(\Exception $e){
            Log::debug('service type seeder : '.$e);
            DB::rollBack();
        }
    }
}
