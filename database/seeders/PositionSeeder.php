<?php

namespace Database\Seeders;

use App\Models\Departemen;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            // IT
            ['department' => 'Information Technology', 'name' => 'Backend Developer'],
            ['department' => 'Information Technology', 'name' => 'Frontend Developer'],
            ['department' => 'Information Technology', 'name' => 'Full Stack Developer'],

            // HR
            ['department' => 'Human Resource', 'name' => 'HR Staff'],
            ['department' => 'Human Resource', 'name' => 'HR Manager'],

            // Finance
            ['department' => 'Finance', 'name' => 'Finance Staff'],

            // Marketing
            ['department' => 'Marketing', 'name' => 'Marketing Staff'],
        ];

        foreach ($positions as $position) {

            $department = Departemen::query()->where('name', $position['department'])->first();
 
            Position::updateOrCreate(
                [
                    'departement_id' => $department->id,
                    'name' => $position['name'],
                ],
                [
                    'description' => null,
                ]
            );
        }
    }
}
