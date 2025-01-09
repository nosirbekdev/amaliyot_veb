<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    public function run()
    {
        Task::create([
            'title' => 'CRM System Design',
            'participant' => 'Azhar',
            'date_added' => '2021-04-12',
            'deadline' => '2021-04-21',
            'priority' => 'Medium',
            'status' => 'to_do',
        ]);

        Task::create([
            'title' => 'Statistics',
            'participant' => 'Artur',
            'date_added' => '2021-04-12',
            'deadline' => '2021-04-21',
            'priority' => 'Low',
            'status' => 'to_do',
        ]);

        Task::create([
            'title' => 'Database Design',
            'participant' => 'Azhar',
            'date_added' => '2021-04-12',
            'deadline' => '2021-04-21',
            'priority' => 'High',
            'status' => 'to_do',
        ]);

        Task::create([
            'title' => 'Frontend Development',
            'participant' => 'Artur',
            'date_added' => '2021-04-12',
            'deadline' => '2021-04-21',
            'priority' => 'Medium',
            'status' => 'closed',
        ]);

        Task::create([
            'title' => 'Backend Development',
            'participant' => 'Azhar',
            'date_added' => '2021-04-12',
            'deadline' => '2021-04-21',
            'priority' => 'High',
            'status' => 'frozen',
        ]);

        Task::create([
            'title' => 'Testing',
            'participant' => 'Artur',
            'date_added' => '2021-04-12',
            'deadline' => '2021-04-21',
            'priority' => 'Low',
            'status' => 'in_progress',
        ]);
    }
}

