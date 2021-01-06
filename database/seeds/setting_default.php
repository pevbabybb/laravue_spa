<?php

use Illuminate\Database\Seeder;

class setting_default extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            ['id'=> 1,'enable_specialDay'=>1,'enable_birth_event'=>1,'enable_death_event'=>0,'transition'=>'default','duration'=>4]
        ]);
    }
}
