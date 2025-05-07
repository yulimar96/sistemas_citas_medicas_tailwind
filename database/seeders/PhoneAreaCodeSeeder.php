<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PhoneAreaCode;

class PhoneAreaCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        PhoneAreaCode::create(['code'=>'0212', 'federals_state_id' =>24]);
        PhoneAreaCode::create(['code'=>'0234', 'federals_state_id' =>7]);
        PhoneAreaCode::create(['code'=>'0241', 'federals_state_id' =>4]);
        PhoneAreaCode::create(['code'=>'0251', 'federals_state_id' =>12]);
        PhoneAreaCode::create(['code'=>'0261', 'federals_state_id' =>13]);
        PhoneAreaCode::create(['code'=>'0273', 'federals_state_id' =>19]);
        PhoneAreaCode::create(['code'=>'0281', 'federals_state_id' =>23]);
        PhoneAreaCode::create(['code'=>'0292', 'federals_state_id' =>5]);
        PhoneAreaCode::create(['code'=>'0293', 'federals_state_id' =>17]);
        PhoneAreaCode::create(['code'=>'0294', 'federals_state_id' =>17]);
        PhoneAreaCode::create(['code'=>'0295', 'federals_state_id' =>20]);
        PhoneAreaCode::create(['code'=>'0296', 'federals_state_id' =>20]);
        PhoneAreaCode::create(['code'=>'0297', 'federals_state_id' =>10]);
        PhoneAreaCode::create(['code'=>'0298', 'federals_state_id' =>18]);
        PhoneAreaCode::create(['code'=>'0299', 'federals_state_id' =>15]);
    }
}
