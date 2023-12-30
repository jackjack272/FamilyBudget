<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Db;  

class seedCategories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Db::table('categories')->insert([
        //dads categories
            [
                'name'=>'House',
                'theme'=>'NEEDS',
                'budget_id'=>1,
            ],
            [
                'name'=>'Car',
                'theme'=>'NEEDS',
                'budget_id'=>1,
            ],
            [
                'name'=>'date night ',
                'theme'=>'WANTS',
                'budget_id'=>1,
            ],
        // moms categories 
            [
                'name'=>'Groceries',
                'theme'=>'NEEDS',
                'budget_id'=>2,
            ],
            [
                'name'=>'new applicances.',
                'theme'=>'WANTS',
                'budget_id'=>2,
            ],
            [
                'name'=>'Bell Bills',
                'theme'=>'CREDIT_CARD',
                'budget_id'=>2,
            ],
        ]);        
            //['NEEDS','WANTS','CREDIT_CARD',"MISALANIOUS"];
    }
}
