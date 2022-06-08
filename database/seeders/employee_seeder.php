<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class employee_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            'emp_fname'=>'admin',
            'emp_lname'=>'admin',
            'emp_gender'=>'admin',
            'emp_joining_date'=>'2022-03-02',
            'emp_phone'=>'3318308323',
            'emp_address'=>'Johar Karachi',
            'username'=>'admin',
            'email'  => 'admin@gmail.com',
            'password' =>  bcrypt('admin123'),
            'role' =>'Admin'
        ]);
    }
}
