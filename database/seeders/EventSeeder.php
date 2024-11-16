<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            ['name' => 'Seminar', 'harga' => 5000000],
            ['name' => 'Pernikahan', 'harga' => 12000000],
            ['name' => 'Perpisahan Sekolah', 'harga' => 7000000],
            ['name' => 'Tahfiz Quran', 'harga' => 7000000],
        ];

        Event::insert($events);
    }
}
