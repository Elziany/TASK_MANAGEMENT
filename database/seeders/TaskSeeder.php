<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task ;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            'title' => 'task test' ,
            'description' => 'task test' ,
            'due_to_date' => '30-3-2024 2:00 pm' ,
            'user_id' => '1' , // it refers to manager 
        ]);

        Task::create([
            'title' => 'task  test two' ,
            'description' => 'task test two' ,
            'due_to_date' => '30-3-2024 2:00 pm' ,
            'user_id' => '1' , // it refers to manager 
        ]);
    }
}
