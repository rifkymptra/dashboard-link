<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            ['section_name' => 'Pengelola Anggaran', 'description' => 'Bagian yang mengelola anggaran.'],
            ['section_name' => 'Penyusun Laporan Keuangan', 'description' => 'Bagian yang bertanggung jawab dalam penyusunan laporan keuangan.'],
            ['section_name' => 'Pengelolaan Barang Milik Negara', 'description' => 'Bagian yang mengelola barang milik negara.'],
            ['section_name' => 'Sosial', 'description' => 'Bagian yang terkait dengan kegiatan sosial.'],
            ['section_name' => 'Ekonomi', 'description' => 'Bagian yang mengelola kegiatan ekonomi.'],
            ['section_name' => 'IPDS', 'description' => 'Bagian yang berhubungan dengan informasi dan pengolahan data statistik.'],
            ['section_name' => 'Pengolahan', 'description' => 'Bagian yang mengelola proses pengolahan data.'],
            ['section_name' => 'Umum', 'description' => 'Bagian yang mengelola urusan umum dan administrasi.'],
        ];

        DB::table('sections')->insert($sections);
    }
}
