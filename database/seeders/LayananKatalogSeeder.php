<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LayananKatalogSeeder extends Seeder
{
    public function run(): void
    {
        $defaultPemohon = [
            ['name' => 'nama_lengkap', 'label' => 'Nama Lengkap Pemohon', 'type' => 'text', 'required' => true],
            ['name' => 'nip_nik', 'label' => 'NIP / NIK', 'type' => 'text', 'required' => false],
            ['name' => 'jabatan', 'label' => 'Jabatan', 'type' => 'text', 'required' => false],
            ['name' => 'pangkat_golongan', 'label' => 'Pangkat / Golongan', 'type' => 'text', 'required' => false],
            ['name' => 'perangkat_daerah', 'label' => 'Perangkat Daerah / Unit Kerja', 'type' => 'text', 'required' => true],
            ['name' => 'no_wa', 'label' => 'Nomor WhatsApp Aktif', 'type' => 'text', 'required' => true],
        ];

        $layanans = [
            [
                'jenis_layanan' => 'email',
                'nama_layanan' => 'Penerbitan E-Mail Pemda',
                'deskripsi' => 'Layanan pengajuan pembuatan akun surat elektronik resmi dengan domain @mojokertokab.go.id.',
                'ikon' => 'ri-mail-add-line',
                'form_schema' => [
                    'pemohon' => $defaultPemohon,
                    'layanan' => [
                        ['name' => 'surat_pengajuan', 'label' => 'Surat Pengajuan (PDF)', 'type' => 'file', 'required' => true]
                    ]
                ]
            ],
            [
                'jenis_layanan' => 'tte',
                'nama_layanan' => 'Pengajuan Tanda Tangan Elektronik',
                'deskripsi' => 'Penerbitan Sertifikat Elektronik sebagai dasar penggunaan Tanda Tangan Elektronik (TTE).',
                'ikon' => 'ri-fingerprint-2-line',
                'form_schema' => [
                    'pemohon' => $defaultPemohon,
                    'layanan' => [
                        ['name' => 'ktp', 'label' => 'Scan KTP (PDF/JPG)', 'type' => 'file', 'required' => true],
                        ['name' => 'surat_rekomendasi', 'label' => 'Surat Rekomendasi (PDF)', 'type' => 'file', 'required' => true]
                    ]
                ]
            ],
            [
                'jenis_layanan' => 'pentest',
                'nama_layanan' => 'Pengujian Keamanan Aplikasi',
                'deskripsi' => 'Pengujian kerentanan (Vulnerability Assessment) terhadap website atau aplikasi pemda.',
                'ikon' => 'ri-search-eye-line',
                'form_schema' => [
                    'pemohon' => $defaultPemohon,
                    'layanan' => [
                        ['name' => 'url', 'label' => 'URL Aplikasi', 'type' => 'text', 'required' => true],
                        ['name' => 'deskripsi_aplikasi', 'label' => 'Deskripsi Aplikasi', 'type' => 'textarea', 'required' => true]
                    ]
                ]
            ],
            [
                'jenis_layanan' => 'ssl',
                'nama_layanan' => 'Permohonan SSL',
                'deskripsi' => 'Pengajuan pemasangan atau perpanjangan Sertifikat SSL/TLS pada website pemda.',
                'ikon' => 'ri-lock-2-line',
                'form_schema' => [
                    'pemohon' => $defaultPemohon,
                    'layanan' => [
                        ['name' => 'domain', 'label' => 'Nama Domain / Subdomain', 'type' => 'text', 'required' => true],
                        ['name' => 'ip_address', 'label' => 'IP Address Server', 'type' => 'text', 'required' => true]
                    ]
                ]
            ],
            [
                'jenis_layanan' => 'csirt',
                'nama_layanan' => 'Layanan CSIRT',
                'deskripsi' => 'Penanganan dan mitigasi insiden keamanan informasi di lingkungan Pemkab Mojokerto.',
                'ikon' => 'ri-macbook-line',
                'form_schema' => [
                    'pemohon' => $defaultPemohon,
                    'layanan' => [
                        ['name' => 'jenis_insiden', 'label' => 'Jenis Insiden (Defacement, Malware, dll)', 'type' => 'text', 'required' => true],
                        ['name' => 'dampak', 'label' => 'Dampak Insiden', 'type' => 'textarea', 'required' => true],
                        ['name' => 'bukti_screenshot', 'label' => 'Bukti Screenshot', 'type' => 'file', 'required' => true]
                    ]
                ]
            ],
            [
                'jenis_layanan' => 'awareness',
                'nama_layanan' => 'Security Awareness',
                'deskripsi' => 'Sosialisasi, edukasi, bimtek, workshop mengenai keamanan informasi.',
                'ikon' => 'ri-group-line',
                'form_schema' => [
                    'pemohon' => $defaultPemohon,
                    'layanan' => [
                        ['name' => 'target_peserta', 'label' => 'Target Peserta', 'type' => 'text', 'required' => true],
                        ['name' => 'jumlah_peserta', 'label' => 'Perkiraan Jumlah Peserta', 'type' => 'text', 'required' => true],
                        ['name' => 'tanggal_kegiatan', 'label' => 'Rencana Tanggal Kegiatan', 'type' => 'text', 'required' => true]
                    ]
                ]
            ],
            [
                'jenis_layanan' => 'konsultasi',
                'nama_layanan' => 'Konsultasi Keamanan Informasi',
                'deskripsi' => 'Layanan konsultasi terkait penerapan sistem manajemen keamanan informasi (SMKI).',
                'ikon' => 'ri-customer-service-2-line',
                'form_schema' => [
                    'pemohon' => $defaultPemohon,
                    'layanan' => [
                        ['name' => 'topik_konsultasi', 'label' => 'Topik Konsultasi', 'type' => 'textarea', 'required' => true]
                    ]
                ]
            ],
            [
                'jenis_layanan' => 'jamming',
                'nama_layanan' => 'Layanan Jamming',
                'deskripsi' => 'Dukungan pengamanan komunikasi melalui perangkat kontra penginderaan pada kegiatan strategis.',
                'ikon' => 'ri-rfid-line',
                'form_schema' => [
                    'pemohon' => $defaultPemohon,
                    'layanan' => [
                        ['name' => 'nama_kegiatan', 'label' => 'Nama Kegiatan Strategis', 'type' => 'text', 'required' => true],
                        ['name' => 'lokasi', 'label' => 'Lokasi Kegiatan', 'type' => 'text', 'required' => true],
                        ['name' => 'tanggal', 'label' => 'Tanggal & Waktu Pelaksanaan', 'type' => 'text', 'required' => true],
                        ['name' => 'surat_permohonan', 'label' => 'Surat Permohonan Resmi (PDF)', 'type' => 'file', 'required' => true]
                    ]
                ]
            ]
        ];

        foreach ($layanans as $layanan) {
            \App\Models\LayananKatalog::updateOrCreate(
                ['jenis_layanan' => $layanan['jenis_layanan']],
                $layanan
            );
        }
    }
}
