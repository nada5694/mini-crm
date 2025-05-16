<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Action;
use Illuminate\Support\Str;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Action::create([
        'id' => (string) Str::uuid(),
        'customer_id' => 'c801862d-730a-42dc-b9e5-4fba9122eef0',
        'user_id'     => 'a7ba44c7-ecba-41b5-b1c4-692d1fbb070d',
        'type'        => 'call',
        'result'      => 'Successfully contacted customer',
        'created_at'  => now(),
    ]);

    Action::create([
        'id' => (string) Str::uuid(),
        'customer_id' => '02f2cd84-85ba-4926-93ae-986df1231c75',
        'user_id'     => '7a06e753-c7ce-422c-9f98-ba047f12954f',
        'type'        => 'visit',
        'result'      => 'Customer showed interest',
        'created_at'  => now(),
    ]);
    }
}
