<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class seedUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Db::table('users')->insert([
            [// admin  user
                'name'=>'Mr.Bob Sponge.',
                'email'=>'admin@money.com',
                'password'=>bcrypt('money'),
                'is_admin'=>true,
                'is_timed_out'=>false,
            ],
        ]);
        
    }
}
