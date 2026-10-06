<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LayananKatalog;

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
                'deskripsi' => "Layanan ini digunakan untuk mengajukan pembuatan akun surat elektronik (e-mail) resmi Pemerintah Kabupaten Mojokerto dengan domain @mojokertokab.go.id. E-mail resmi digunakan sebagai media komunikasi kedinasan antar instansi maupun dengan pihak eksternal secara aman dan profesional.",
                'ikon' => 'ri-mail-send-line',
                'form_schema' => [
                    'pemohon' => [
                        ['name' => 'nama_lengkap', 'label' => 'Nama Lengkap', 'type' => 'text', 'required' => true],
                        ['name' => 'nip_nik', 'label' => 'NIP/NIK', 'type' => 'text', 'required' => true],
                        ['name' => 'jabatan', 'label' => 'Jabatan', 'type' => 'text', 'required' => true],
                        ['name' => 'pangkat_golongan', 'label' => 'Pangkat/Golongan', 'type' => 'text', 'required' => true],
                        ['name' => 'perangkat_daerah', 'label' => 'Perangkat Daerah/Unit Kerja', 'type' => 'text', 'required' => true],
                        ['name' => 'no_wa', 'label' => 'No Whatsapp', 'type' => 'text', 'required' => true],
                    ],
                    'layanan' => [
                        ['name' => 'email_usulan', 'label' => 'Email yang diusulkan', 'type' => 'text', 'required' => true],
                        ['name' => 'surat_permohonan', 'label' => 'Upload Surat Permohonan', 'type' => 'file', 'required' => true],
                    ]
                ],
                'status' => 'active'
            ],
            [
                'jenis_layanan' => 'tte',
                'nama_layanan' => 'Pengajuan Tanda Tangan Elektronik',
                'deskripsi' => "Layanan ini digunakan untuk mengajukan penerbitan Sertifikat Elektronik sebagai dasar penggunaan Tanda Tangan Elektronik (TTE) pada aplikasi pemerintahan dan dokumen elektronik sesuai ketentuan yang berlaku.",
                'ikon' => 'ri-fingerprint-2-line',
                'form_schema' => [
                    'pemohon' => [
                        ['name' => 'nama_lengkap', 'label' => 'Nama Lengkap', 'type' => 'text', 'required' => true],
                        ['name' => 'nip_nik', 'label' => 'NIP/NIK', 'type' => 'text', 'required' => true],
                        ['name' => 'jabatan', 'label' => 'Jabatan', 'type' => 'text', 'required' => true],
                        ['name' => 'pangkat_golongan', 'label' => 'Pangkat/Golongan', 'type' => 'text', 'required' => true],
                        ['name' => 'perangkat_daerah', 'label' => 'Perangkat Daerah/Unit Kerja', 'type' => 'text', 'required' => true],
                        ['name' => 'email_pemohon', 'label' => 'Email Pemohon', 'type' => 'email', 'required' => true],
                        ['name' => 'no_wa', 'label' => 'No Whatsapp', 'type' => 'text', 'required' => true],
                    ],
                    'layanan' => [
                        ['name' => 'jenis_pengajuan', 'label' => 'Jenis pengajuan', 'type' => 'select', 'required' => true, 'options' => ['Baru', 'Perpanjangan', 'Kendala TTE']],
                        ['name' => 'surat_permohonan', 'label' => 'Upload Surat Permohonan', 'type' => 'file', 'required' => true],
                    ]
                ],
                'status' => 'active'
            ],
            [
                'jenis_layanan' => 'pentest',
                'nama_layanan' => 'Pengujian Keamanan Aplikasi',
                'deskripsi' => "Layanan ini digunakan untuk mengajukan pengujian keamanan (Vulnerability Assessment) terhadap website atau aplikasi milik Pemerintah Kabupaten Mojokerto guna mengidentifikasi potensi kerentanan keamanan informasi dan memberikan rekomendasi perbaikan.",
                'ikon' => 'ri-search-eye-line',
                'form_schema' => [
                    'pemohon' => [
                        ['name' => 'nama_lengkap', 'label' => 'Nama Lengkap', 'type' => 'text', 'required' => true],
                        ['name' => 'nip_nik', 'label' => 'NIP/NIK', 'type' => 'text', 'required' => true],
                        ['name' => 'jabatan', 'label' => 'Jabatan', 'type' => 'text', 'required' => true],
                        ['name' => 'pangkat_golongan', 'label' => 'Pangkat/Golongan', 'type' => 'text', 'required' => true],
                        ['name' => 'perangkat_daerah', 'label' => 'Perangkat Daerah/Unit Kerja', 'type' => 'text', 'required' => true],
                        ['name' => 'no_wa', 'label' => 'No Whatsapp', 'type' => 'text', 'required' => true],
                    ],
                    'layanan' => [
                        ['name' => 'nama_aplikasi', 'label' => 'Nama Aplikasi', 'type' => 'text', 'required' => true],
                        ['name' => 'jenis_aplikasi', 'label' => 'Jenis Aplikasi', 'type' => 'select', 'required' => true, 'options' => ['Website', 'Mobile']],
                        ['name' => 'environment', 'label' => 'Environment', 'type' => 'select', 'required' => true, 'options' => ['Production', 'Staging']],
                        ['name' => 'alamat_aplikasi', 'label' => 'Alamat Aplikasi', 'type' => 'url', 'required' => true],
                        ['name' => 'surat_permohonan', 'label' => 'Upload Surat Permohonan', 'type' => 'file', 'required' => true],
                        ['name' => 'persetujuan_pengujian', 'label' => 'Persetujuan dilakukan pengujian keamanan', 'type' => 'checkbox', 'required' => true],
                    ]
                ],
                'status' => 'active'
            ],
            [
                'jenis_layanan' => 'ssl',
                'nama_layanan' => 'Permohonan SSL',
                'deskripsi' => "Layanan ini digunakan untuk mengajukan pemasangan atau perpanjangan Sertifikat SSL/TLS pada website atau aplikasi Pemerintah Kabupaten Mojokerto guna menjamin keamanan komunikasi data melalui protokol HTTPS.",
                'ikon' => 'ri-lock-2-line',
                'form_schema' => [
                    'pemohon' => [
                        ['name' => 'nama_lengkap', 'label' => 'Nama Lengkap', 'type' => 'text', 'required' => true],
                        ['name' => 'nip_nik', 'label' => 'NIP/NIK', 'type' => 'text', 'required' => true],
                        ['name' => 'jabatan', 'label' => 'Jabatan', 'type' => 'text', 'required' => true],
                        ['name' => 'pangkat_golongan', 'label' => 'Pangkat/Golongan', 'type' => 'text', 'required' => true],
                        ['name' => 'perangkat_daerah', 'label' => 'Perangkat Daerah/Unit Kerja', 'type' => 'text', 'required' => true],
                        ['name' => 'no_wa', 'label' => 'No Whatsapp', 'type' => 'text', 'required' => true],
                    ],
                    'layanan' => [
                        ['name' => 'domain', 'label' => 'Nama Domain / Subdomain', 'type' => 'text', 'required' => true],
                        ['name' => 'ip_address', 'label' => 'Alamat IP Server & Lokasi Hosting', 'type' => 'text', 'required' => true],
                        ['name' => 'surat_permohonan', 'label' => 'Upload Surat Permohonan', 'type' => 'file', 'required' => true],
                    ]
                ],
                'status' => 'active'
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
                ],
                'status' => 'active'
            ],
            [
                'jenis_layanan' => 'awareness',
                'nama_layanan' => 'Security Awareness',
                'deskripsi' => "Layanan ini digunakan untuk mengajukan kegiatan sosialisasi, edukasi, bimbingan teknis, workshop, maupun penyuluhan mengenai keamanan informasi kepada perangkat daerah di lingkungan Pemerintah Kabupaten Mojokerto.",
                'ikon' => 'ri-group-line',
                'form_schema' => [
                    'pemohon' => [
                        ['name' => 'nama_lengkap', 'label' => 'Nama Lengkap', 'type' => 'text', 'required' => true],
                        ['name' => 'nip_nik', 'label' => 'NIP/NIK', 'type' => 'text', 'required' => true],
                        ['name' => 'jabatan', 'label' => 'Jabatan', 'type' => 'text', 'required' => true],
                        ['name' => 'pangkat_golongan', 'label' => 'Pangkat/Golongan', 'type' => 'text', 'required' => true],
                        ['name' => 'perangkat_daerah', 'label' => 'Perangkat Daerah / Unit Kerja', 'type' => 'text', 'required' => true],
                        ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'required' => true],
                        ['name' => 'no_wa', 'label' => 'Nomor WhatsApp', 'type' => 'text', 'required' => true],
                    ],
                    'layanan' => [
                        ['name' => 'jenis_kegiatan', 'label' => 'Jenis Kegiatan', 'type' => 'select', 'required' => true, 'options' => ['Sosialisasi', 'Bimbingan Teknis (Bimtek)', 'Workshop', 'Seminar', 'Edukasi Keamanan Informasi', 'Lainnya']],
                        ['name' => 'tema', 'label' => 'Tema yang Diinginkan', 'type' => 'text', 'required' => true],
                        ['name' => 'jumlah_peserta', 'label' => 'Jumlah Peserta', 'type' => 'number', 'required' => true],
                        ['name' => 'sasaran_peserta', 'label' => 'Sasaran Peserta', 'type' => 'select', 'required' => true, 'options' => ['ASN', 'Administrator Sistem', 'Operator Aplikasi', 'Perangkat Desa', 'Lainnya']],
                        ['name' => 'tanggal_pelaksanaan', 'label' => 'Tanggal Pelaksanaan yang Diusulkan', 'type' => 'date', 'required' => true],
                        ['name' => 'waktu_pelaksanaan', 'label' => 'Waktu Pelaksanaan', 'type' => 'time', 'required' => true],
                        ['name' => 'lokasi_pelaksanaan', 'label' => 'Lokasi Pelaksanaan', 'type' => 'text', 'required' => true],
                        ['name' => 'metode_pelaksanaan', 'label' => 'Metode Pelaksanaan', 'type' => 'select', 'required' => true, 'options' => ['Offline', 'Online', 'Hybrid']],
                        ['name' => 'uraian_kebutuhan', 'label' => 'Uraian Singkat Kebutuhan Kegiatan', 'type' => 'textarea', 'required' => true],
                    ]
                ],
                'status' => 'active'
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
                ],
                'status' => 'active'
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
                ],
                'status' => 'active'
            ]
        ];

        foreach ($layanans as $layanan) {
            LayananKatalog::updateOrCreate(
                ['jenis_layanan' => $layanan['jenis_layanan']],
                $layanan
            );
        }
    }
}
