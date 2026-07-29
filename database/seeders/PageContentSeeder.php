<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'slug' => 'tentang-sandikami',
                'content' => '<h2>Tentang Sandikami</h2><p>Sandikami (Sandi Keamanan Informasi) adalah portal resmi Pemerintah Kabupaten Mojokerto...</p>'
            ],
            [
                'slug' => 'tugas-fungsi',
                'content' => '<h2>Tugas dan Fungsi</h2><p>Melaksanakan pengamanan informasi pemerintah daerah...</p>'
            ],
            [
                'slug' => 'program-kerja',
                'content' => '<h2>Program Kerja</h2><p>Program kerja yang sedang dan akan dilaksanakan...</p>'
            ]
        ];

        foreach ($pages as $page) {
            \App\Models\PageContent::firstOrCreate(['slug' => $page['slug']], $page);
        }
    }
}
