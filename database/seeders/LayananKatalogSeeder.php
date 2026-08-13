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
                'deskripsi' => "Layanan ini digunakan untuk mengajukan pembuatan akun surat elektronik (e-mail) resmi Pemerintah Kabupaten Mojokerto dengan domain @mojokertokab.go.id. E-mail resmi digunakan sebagai media komunikasi kedinasan antar instansi maupun dengan pihak eksternal secara aman dan profesional.<br><br>\n\n<b>Syarat:</b>\n<ul>\n<li>Pemohon merupakan ASN, PPPK / pegawai yang berwenang di lingkungan Pemerintah Kabupaten Mojokerto.</li>\n<li>Mengisi formulir permohonan secara lengkap.</li>\n<li>Melampirkan surat permohonan yang telah ditandatangani oleh pejabat yang berwenang.</li>\n<li>Nomor WhatsApp aktif untuk keperluan konfirmasi.</li>\n<li>Belum memiliki akun e-mail resmi / pengajuan merupakan akun baru sesuai kebutuhan organisasi.</li>\n</ul>\n\n<b>Output:</b>\n<ul>\n<li>Akun e-mail resmi Pemerintah Kabupaten Mojokerto.</li>\n<li>Informasi username akun.</li>\n</ul>",
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
                'deskripsi' => "Layanan ini digunakan untuk mengajukan penerbitan Sertifikat Elektronik sebagai dasar penggunaan Tanda Tangan Elektronik (TTE) pada aplikasi pemerintahan dan dokumen elektronik sesuai ketentuan yang berlaku.<br><br>\n\n<b>Syarat:</b>\n<ul>\n<li>Pemohon merupakan ASN yang berwenang menggunakan Tanda Tangan Elektronik.</li>\n<li>Memiliki e-mail resmi Pemerintah Kabupaten Mojokerto yang masih aktif.</li>\n<li>Mengisi formulir permohonan secara lengkap.</li>\n<li>Melampirkan surat permohonan dari perangkat daerah.</li>\n<li>Nomor WhatsApp aktif untuk proses verifikasi.</li>\n</ul>\n\n<b>Output:</b>\n<ul>\n<li>Permohonan diteruskan untuk proses penerbitan Sertifikat Elektronik.</li>\n<li>Informasi status permohonan.</li>\n<li>Sertifikat Elektronik/TTE aktif setelah proses penerbitan selesai.</li>\n</ul>",
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
                'deskripsi' => "Layanan ini digunakan untuk mengajukan pengujian keamanan (Vulnerability Assessment) terhadap website atau aplikasi milik Pemerintah Kabupaten Mojokerto guna mengidentifikasi potensi kerentanan keamanan informasi dan memberikan rekomendasi perbaikan.<br><br>\n\n<b>Syarat:</b>\n<ul>\n<li>Website atau aplikasi merupakan milik Pemerintah Kabupaten Mojokerto.</li>\n<li>Pemohon merupakan pengelola atau PIC aplikasi.</li>\n<li>Mengisi formulir permohonan secara lengkap.</li>\n<li>Melampirkan surat permohonan resmi.</li>\n<li>Memberikan informasi alamat website atau aplikasi yang akan diuji.</li>\n<li>Bersedia memberikan informasi teknis apabila diperlukan selama proses assessment.</li>\n</ul>\n\n<b>Output:</b>\n<ul>\n<li>Pelaksanaan Vulnerability Assessment.</li>\n<li>Laporan hasil pengujian keamanan.</li>\n<li>Daftar temuan kerentanan beserta tingkat risikonya.</li>\n<li>Rekomendasi mitigasi dan perbaikan keamanan.</li>\n</ul>",
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
                'deskripsi' => "Layanan ini digunakan untuk mengajukan pemasangan atau perpanjangan Sertifikat SSL/TLS pada website atau aplikasi Pemerintah Kabupaten Mojokerto guna menjamin keamanan komunikasi data melalui protokol HTTPS.<br><br>\n\n<b>Syarat:</b>\n<ul>\n<li>Domain atau subdomain merupakan milik Pemerintah Kabupaten Mojokerto.</li>\n<li>Mengisi formulir permohonan secara lengkap.</li>\n<li>Melampirkan surat permohonan.</li>\n<li>Menyampaikan informasi alamat IP server dan lokasi hosting.</li>\n<li>Pemohon merupakan pengelola website atau aplikasi.</li>\n</ul>\n\n<b>Output:</b>\n<ul>\n<li>Sertifikat SSL diterbitkan atau diperpanjang.</li>\n<li>File sertifikat SSL.</li>\n</ul>",
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
                'deskripsi' => "Layanan ini digunakan untuk mengajukan kegiatan sosialisasi, edukasi, bimbingan teknis, workshop, maupun penyuluhan mengenai keamanan informasi kepada perangkat daerah di lingkungan Pemerintah Kabupaten Mojokerto.<br><br>\n\n<b>Syarat:</b>\n<ul>\n<li>Pengajuan dilakukan oleh perangkat daerah.</li>\n<li>Mengisi formulir permohonan.</li>\n<li>Menjelaskan kebutuhan kegiatan.</li>\n<li>Mengusulkan waktu pelaksanaan.</li>\n<li>Melampirkan surat permohonan apabila diperlukan.</li>\n</ul>\n\n<b>Output:</b>\n<ul>\n<li>Jadwal kegiatan Security Awareness.</li>\n<li>Materi sosialisasi atau pelatihan.</li>\n<li>Dokumentasi kegiatan.</li>\n<li>Daftar hadir peserta (apabila diperlukan).</li>\n</ul>",
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
