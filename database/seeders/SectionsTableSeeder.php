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
            ['section_name' => 'Pengelolaan Keuangan', 'description' => 'Bagian yang mengelola Keuangan.'],
            ['section_name' => 'Penyusun Laporan Keuangan', 'description' => 'Bagian yang bertanggung jawab dalam penyusunan laporan keuangan.'],
            ['section_name' => 'Pengelolaan Barang Milik Negara', 'description' => 'Bagian yang mengelola barang milik negara.'],
            ['section_name' => 'Umum', 'description' => 'Bagian yang mengelola urusan umum dan administrasi.'],
            ['section_name' => 'Diseminasi Statistik', 'description' => 'Bagian yang mengelola proses diseminasi statistik.'],
            ['section_name' => 'Sensus/Survei', 'description' => 'Bagian yang mengelola proses sensus/survei.'],
            ['section_name' => 'Pendidikan & Pelatihan', 'description' => 'Bagian yang mengelola proses pendidikan dan pelatihan.'],
            ['section_name' => 'Pengolahan Survei/Sensus', 'description' => 'Bagian yang mengelola proses pengolahan survei/sensus.'],
            ['section_name' => 'Kepegawaian', 'description' => 'Bagian yang mengelola proses kepegawaian.'],
            ['section_name' => 'Pengadaan Barang dan Jasa', 'description' => 'Bagian yang mengelola proses pengadaan barang dan jasa.'],
            ['section_name' => 'Pelayanan Statistik Terpadu (PST)', 'description' => 'Bagian yang mengelola proses pelayanan statistik terpadu.'],
            ['section_name' => 'Pemetaan', 'description' => 'Bagian yang mengelola proses pemetaan.'],
            ['section_name' => 'Pengelola Anggaran', 'description' => 'Bagian yang mengelola proses pengelolaan anggaran.'],
            ['section_name' => 'TI', 'description' => 'Bagian yang mengelola proses TI.'],
            ['section_name' => 'STIS', 'description' => 'Politeknik Statistika STIS.'],
        ];

        DB::table('sections')->insert($sections);
    }
}
