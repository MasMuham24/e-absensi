<?php

namespace Database\Seeders;

use App\Models\Departemen;
use Illuminate\Database\Seeder;

class DepartemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name' => 'Information Technology',
                'description' => 'Divisi Teknologi Informasi',
            ],
            [
                'name' => 'Human Resource',
                'description' => 'Divisi Sumber Daya Manusia',
            ],
            [
                'name' => 'Finance',
                'description' => 'Divisi Keuangan',
            ],
            [
                'name' => 'Marketing',
                'description' => 'Divisi Pemasaran',
            ],
        ];

        foreach ($departments as $department) {
            Departemen::updateOrCreate(
                ['name' => $department['name']],
                $department
            );
        }
    }
}
