<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JadwalPeriksa;
use App\Models\User;

class JadwalPeriksaSeeder extends Seeder
{
    public function run(): void
    {
        $dokters = User::where('role', 'dokter')->get();
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        foreach ($dokters as $dokter) {
            $doctorDays = array_slice($days, $dokter->id % 5, 2);
            $firstSchedule = true;

            foreach ($doctorDays as $day) {
                // Jadwal pagi
                JadwalPeriksa::create([
                    'id_dokter' => $dokter->id,
                    'hari' => $day,
                    'jam_mulai' => '08:00:00',
                    'jam_selesai' => '12:00:00',
                    'status' => $firstSchedule ? true : false,
                ]);
                $firstSchedule = false;

                // Jadwal siang (untuk dokter dengan ID genap)
                if ($dokter->id % 2 == 0) {
                    JadwalPeriksa::create([
                        'id_dokter' => $dokter->id,
                        'hari' => $day,
                        'jam_mulai' => '13:00:00',
                        'jam_selesai' => '16:00:00',
                        'status' => false,
                    ]);
                }
            }
        }
    }
}
