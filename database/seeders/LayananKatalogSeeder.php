<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LayananKatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $layanans = [
            [
                'jenis_layanan' => 'email',
                'nama_layanan' => 'Pengajuan Akun E-Mail Pemda',
                'deskripsi' => 'Penerbitan akun surat elektronik resmi @mojokertokab.go.id',
                'ikon' => 'ri-mail-secure-line',
                'form_schema' => [
                    ['name' => 'instansi', 'label' => 'Nama Instansi', 'type' => 'text', 'required' => true],
                    ['name' => 'nip', 'label' => 'NIP', 'type' => 'text', 'required' => true],
                    ['name' => 'nama_lengkap', 'label' => 'Nama Lengkap', 'type' => 'text', 'required' => true],
                    ['name' => 'surat_pengajuan', 'label' => 'Surat Pengajuan (PDF)', 'type' => 'file', 'required' => true]
                ]
            ],
            [
                'jenis_layanan' => 'tte',
                'nama_layanan' => 'Penerbitan Sertifikat Elektronik',
                'deskripsi' => 'Penerbitan sertifikat elektronik untuk pengesahan dokumen.',
                'ikon' => 'ri-fingerprint-line',
                'form_schema' => [
                    ['name' => 'nip', 'label' => 'NIP', 'type' => 'text', 'required' => true],
                    ['name' => 'nama_lengkap', 'label' => 'Nama Lengkap', 'type' => 'text', 'required' => true],
                    ['name' => 'jabatan', 'label' => 'Jabatan', 'type' => 'text', 'required' => true],
                    ['name' => 'ktp', 'label' => 'Scan KTP (PDF/JPG)', 'type' => 'file', 'required' => true],
                    ['name' => 'surat_rekomendasi', 'label' => 'Surat Rekomendasi (PDF)', 'type' => 'file', 'required' => true]
                ]
            ],
            [
                'jenis_layanan' => 'assessment',
                'nama_layanan' => 'Pengujian Keamanan Aplikasi',
                'deskripsi' => 'Pengujian kerentanan (Vulnerability Assessment) aplikasi pemda.',
                'ikon' => 'ri-bug-line',
                'form_schema' => [
                    ['name' => 'url', 'label' => 'URL Aplikasi', 'type' => 'url', 'required' => true],
                    ['name' => 'deskripsi_aplikasi', 'label' => 'Deskripsi Aplikasi', 'type' => 'textarea', 'required' => true],
                    ['name' => 'kontak_teknis', 'label' => 'Nama & No HP Kontak Teknis', 'type' => 'text', 'required' => true]
                ]
            ],
            [
                'jenis_layanan' => 'csirt',
                'nama_layanan' => 'Laporan Insiden Keamanan (CSIRT)',
                'deskripsi' => 'Penanganan insiden keamanan informasi di lingkungan pemda.',
                'ikon' => 'ri-macbook-line',
                'form_schema' => [
                    ['name' => 'jenis_insiden', 'label' => 'Jenis Insiden (Web Defacement, Malware, dll)', 'type' => 'text', 'required' => true],
                    ['name' => 'waktu_kejadian', 'label' => 'Waktu Kejadian', 'type' => 'date', 'required' => true],
                    ['name' => 'dampak', 'label' => 'Dampak Insiden', 'type' => 'textarea', 'required' => true],
                    ['name' => 'bukti_screenshot', 'label' => 'Bukti Screenshot', 'type' => 'file', 'required' => true]
                ]
            ],
        ];

        foreach ($layanans as $layanan) {
            \App\Models\LayananKatalog::create($layanan);
        }
    }
}
