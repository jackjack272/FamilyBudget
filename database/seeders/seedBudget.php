<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class seedBudget extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Db::table('budgets')->insert([
            [
                'for_who'=>'sponge bob',
                'total_inflow'=>1500,
                'total_outflow'=>500,
                'user_id'=>1    
            ],
            [
                'for_who'=>'patricks',
                'total_inflow'=>2500,
                'total_outflow'=>700,
                'user_id'=>1    
            ],

        ]);        
    }
}
