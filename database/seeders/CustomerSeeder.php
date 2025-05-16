<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'id'          => 'c801862d-730a-42dc-b9e5-4fba9122eef0',
            'name'        => 'Customer One',
            'email'       => 'customer1@example.com',
            'phone'       => '123456789',
            'created_by'  => 'a7ba44c7-ecba-41b5-b1c4-692d1fbb070d',
            'assigned_to' => '7a06e753-c7ce-422c-9f98-ba047f12954f',
        ]);

        Customer::create([
            'id'           => '02f2cd84-85ba-4926-93ae-986df1231c75',
            'name'         => 'Customer Two',
            'email'        => 'customer2@example.com',
            'phone'        => '987654321',
            'created_by'   => '7a06e753-c7ce-422c-9f98-ba047f12954f',
            'assigned_to'  => '7a06e753-c7ce-422c-9f98-ba047f12954f',
        ]);
    }

}
