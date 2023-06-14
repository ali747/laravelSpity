<?php

namespace Database\Seeders;

use App\Models\AttendanceUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        AttendanceUser::create([
            'ip_address' => '192.168.1.1',
            'location' => 'PF Ground 1'
        ]);

        AttendanceUser::create([
            'ip_address' => '192.168.1.2',
            'location' => 'PF Ground 2'
        ]);

        AttendanceUser::create([
            'ip_address' => '127.0.0.1',
            'location' => 'PF Ground 2'
        ]);
    }
}
