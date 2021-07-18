<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    public function run()
    {
        if(!Status::find(1)){
            Status::insert(['id' => 1,'name' => 'INICIADA']);
        }
        if(!Status::find(2)){
            Status::insert(['id' => 2,'name' => 'EM PROCESSO']);
        }
        if(!Status::find(3)){
            Status::insert(['id' => 3,'name' => 'FINALIZADA']);
        }
    }
}
