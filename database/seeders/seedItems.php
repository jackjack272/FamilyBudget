<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Db;

class seedItems extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Db::table('items')->insert([
        // belongs to housing
            [
                'name'=>'morgage',
                'monthly_cost'=>1540,
                'is_income'=>0,
                'category_id'=>1,
            ],// 1 = true, 0 = false, 
            [
                'name'=>'strata fee',
                'monthly_cost'=>340,
                'is_income'=>0,
                'category_id'=>1,
            ], 
            [
                'name'=>'tax',
                'monthly_cost'=>300,
                'is_income'=>0,
                'category_id'=>1,
            ], 
            [
                'name'=>'membership fee',
                'monthly_cost'=>200,
                'is_income'=>0,
                'category_id'=>1,
            ], 
            [
                'name'=>'rent from tenents',
                'monthly_cost'=>2200,
                'is_income'=>1,
                'category_id'=>1,
            ],

        // belonging to car. 
            [
                'name'=>'insurance',
                'monthly_cost'=>350,
                'is_income'=>0,
                'category_id'=>2,
            ], 
            [
                'name'=>'monthly gas cost avg',
                'monthly_cost'=>400,
                'is_income'=>0,
                'category_id'=>2,
            ], 
            [
                'name'=>'maintenence cost',
                'monthly_cost'=>100,
                'is_income'=>0,
                'category_id'=>2,
            ], 
            [
                'name'=>'lease',
                'monthly_cost'=>150,
                'is_income'=>0,
                'category_id'=>2,
            ], 
            [
                'name'=>'uber and lift rides',
                'monthly_cost'=>500,
                'is_income'=>1,
                'category_id'=>2,
            ], 
        // date night 
            [
                'name'=>'dinner',
                'monthly_cost'=>40,
                'is_income'=>0,
                'category_id'=>3,
            ], 
            [
                'name'=>'drinks',
                'monthly_cost'=>30,
                'is_income'=>0,
                'category_id'=>3,
            ], 
            [
                'name'=>'event',
                'monthly_cost'=>50,
                'is_income'=>0,
                'category_id'=>3,
            ], 
        // gorceries
            [
                'name'=>'lobster',
                'monthly_cost'=>350,
                'is_income'=>0,
                'category_id'=>4,
            ], 
            [
                'name'=>'caviar',
                'monthly_cost'=>350,
                'is_income'=>0,
                'category_id'=>4,
            ], 
            [
                'name'=>'water buffulo meat',
                'monthly_cost'=>350,
                'is_income'=>0,
                'category_id'=>4,
            ], 
        //new appliances
            [
                'name'=>'insurance',
                'monthly_cost'=>50,
                'is_income'=>0,
                'category_id'=>5,
            ], 
            [
                'name'=>'finance cost of fridge',
                'monthly_cost'=>250,
                'is_income'=>0,
                'category_id'=>5,
            ], 
        //bell bills 
            [
                'name'=>'Internet and tv',
                'monthly_cost'=>140,
                'is_income'=>0,
                'category_id'=>6,
            ], 
            [
                'name'=>'phones',
                'monthly_cost'=>240,
                'is_income'=>0,
                'category_id'=>6,
            ],         

        ]);

    }
}
