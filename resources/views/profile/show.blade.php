@extends(auth()->user()->role === 'admin' ? 'layouts.admin' : 'layouts.app')

@section('title', 'Profil Akun - Sandikami')
@section('page_title', 'Profil Akun')

@section('content')
@if(auth()->user()->role !== 'admin')
<div class="container" style="padding-top: 8rem; padding-bottom: 4rem; min-height: 80vh;">
@else
<div style="padding-bottom: 4rem;">
@endif
    <h1 class="mb-4" style="text-align: center; color: var(--color-text); margin-bottom: 2rem;">Profil Akun</h1>
    
    <div class="card p-5" style="max-width: 600px; margin: 0 auto; background-color: rgba(255, 255, 255, 0.05); border: 1px solid var(--glass-border); border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); padding: 40px;">
        
        @if(session('success'))
            <div class="alert alert-success" style="background-color: rgba(46, 204, 113, 0.2); color: #2ecc71; padding: 15px; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid #2ecc71;">
                <i class="ri-checkbox-circle-line"></i> {{ session('success') }}
            </div>
        @endif

        <div style="text-align: center; margin-bottom: 2rem;">
            @if($user->avatar)
                <div style="margin-bottom: 1rem;">
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; box-shadow: 0 4px 15px rgba(0, 168, 232, 0.4); border: 3px solid var(--color-primary); margin: 0 auto;">
                </div>
            @else
                <div style="width: 120px; height: 120px; background-color: var(--color-primary); color: white; border-radius: 50%; display: inline-flex; justify-content: center; align-items: center; font-size: 4rem; box-shadow: 0 4px 15px rgba(0, 168, 232, 0.4); margin-bottom: 1rem;">
                    <i class="ri-user-fill"></i>
                </div>
            @endif
            <h2 style="color: var(--color-secondary); margin-bottom: 5px;">{{ $user->name }}</h2>
            <p style="color: var(--color-text-muted); font-size: 1.1rem;">
                @if($user->role === 'admin')
                    <span style="background-color: rgba(46, 204, 113, 0.2); color: #2ecc71; padding: 4px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; border: 1px solid #2ecc71;"><i class="ri-shield-user-fill"></i> Administrator</span>
                @else
                    <span style="background-color: rgba(52, 152, 219, 0.2); color: #3498db; padding: 4px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; border: 1px solid #3498db;"><i class="ri-user-smile-fill"></i> Pengguna Umum</span>
                @endif
            </p>
        </div>

        <div style="margin-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 2rem;">
            
            <div style="display: flex; align-items: center; margin-bottom: 20px;">
                <div style="width: 40px; height: 40px; background-color: rgba(255,255,255,0.1); border-radius: 8px; display: flex; justify-content: center; align-items: center; margin-right: 15px; color: var(--color-primary-light);">
                    <i class="ri-mail-line" style="font-size: 1.2rem;"></i>
                </div>
                <div>
                    <div style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.6); font-weight: 600; margin-bottom: 2px;">Email</div>
                    <div style="color: white; font-size: 1.05rem;">{{ $user->email }}</div>
                </div>
            </div>

            @if($user->jabatan)
            <div style="display: flex; align-items: center; margin-bottom: 20px;">
                <div style="width: 40px; height: 40px; background-color: rgba(255,255,255,0.1); border-radius: 8px; display: flex; justify-content: center; align-items: center; margin-right: 15px; color: var(--color-primary-light);">
                    <i class="ri-briefcase-line" style="font-size: 1.2rem;"></i>
                </div>
                <div>
                    <div style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.6); font-weight: 600; margin-bottom: 2px;">Jabatan</div>
                    <div style="color: white; font-size: 1.05rem;">{{ $user->jabatan }}</div>
                </div>
            </div>
            @endif

            @if($user->divisi)
            <div style="display: flex; align-items: center; margin-bottom: 20px;">
                <div style="width: 40px; height: 40px; background-color: rgba(255,255,255,0.1); border-radius: 8px; display: flex; justify-content: center; align-items: center; margin-right: 15px; color: var(--color-primary-light);">
                    <i class="ri-building-line" style="font-size: 1.2rem;"></i>
                </div>
                <div>
                    <div style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.6); font-weight: 600; margin-bottom: 2px;">Perangkat Daerah / Divisi</div>
                    <div style="color: white; font-size: 1.05rem;">{{ $user->divisi }}</div>
                </div>
            </div>
            @endif

            <div style="display: flex; align-items: center; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 20px;">
                <div style="width: 40px; height: 40px; background-color: rgba(255,255,255,0.1); border-radius: 8px; display: flex; justify-content: center; align-items: center; margin-right: 15px; color: var(--color-primary-light);">
                    <i class="ri-calendar-line" style="font-size: 1.2rem;"></i>
                </div>
                <div>
                    <div style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.6); font-weight: 600; margin-bottom: 2px;">Bergabung Sejak</div>
                    <div style="color: white; font-size: 1.05rem;">{{ $user->created_at->translatedFormat('d F Y') }}</div>
                </div>
            </div>
        </div>
        
        <div style="display: flex; gap: 15px; justify-content: center; margin-top: 2rem;">
            @if(auth()->user()->role !== 'admin')
            <a href="{{ route('profile.edit') }}" class="btn btn-primary" style="padding: 8px 20px; border-radius: 30px; transition: all 0.3s ease;">
                <i class="ri-edit-box-line"></i> Edit Profil
            </a>
            @endif
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary" style="background-color: transparent; border: 1px solid var(--color-secondary, #00d8ff); color: var(--color-secondary, #00d8ff); padding: 8px 20px; border-radius: 30px; transition: all 0.3s ease; text-decoration: none;">
                <i class="ri-arrow-left-line"></i> Kembali ke Dashboard
            </a>
            @else
            <a href="{{ route('home') }}" class="btn btn-secondary" style="background-color: transparent; border: 1px solid var(--color-secondary, #00d8ff); color: var(--color-secondary, #00d8ff); padding: 8px 20px; border-radius: 30px; transition: all 0.3s ease; text-decoration: none;">
                <i class="ri-arrow-left-line"></i> Kembali ke Beranda
            </a>
            @endif
        </div>
    </div>

    @if(auth()->user()->role !== 'admin')
    <div class="card mt-4" style="max-width: 900px; margin: 2rem auto 0; background-color: rgba(2, 12, 27, 0.5); border: 1px solid var(--glass-border); border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); padding: 30px; overflow-x: auto;">
        <div style="display: flex; align-items: center; margin-bottom: 25px;">
            <div style="width: 45px; height: 45px; background-color: #20c997; border-radius: 10px; display: flex; justify-content: center; align-items: center; color: white; margin-right: 15px; flex-shrink: 0;">
                <i class="ri-mail-send-fill" style="font-size: 1.5rem;"></i>
            </div>
            <div>
                <h3 style="color: white; margin-bottom: 2px; font-size: 1.3rem;">Surat yang Diajukan</h3>
                <p style="color: var(--color-text-muted); font-size: 0.85rem; margin-bottom: 0;">Daftar surat pengajuan layanan yang pernah Anda buat</p>
            </div>
        </div>

        <table style="width: 100%; border-collapse: collapse; min-width: 600px;">
            <thead>
                <tr style="border-bottom: 1px solid rgba(255,255,255,0.1); color: white; text-align: left;">
                    <th style="padding: 12px 15px; font-weight: 600; font-size: 0.9rem;">Tanggal</th>
                    <th style="padding: 12px 15px; font-weight: 600; font-size: 0.9rem;">Jenis Surat</th>
                    <th style="padding: 12px 15px; font-weight: 600; font-size: 0.9rem;">Nama Pemohon</th>
                    <th style="padding: 12px 15px; font-weight: 600; font-size: 0.9rem;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($layanans as $layanan)
                <tr style="border-bottom: 1px solid rgba(255,255,255,0.05); color: var(--color-text-muted); transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='rgba(255,255,255,0.02)'" onmouseout="this.style.backgroundColor='transparent'">
                    <td style="padding: 15px; font-size: 0.9rem;">{{ $layanan->created_at->translatedFormat('d M Y') }}</td>
                    <td style="padding: 15px; font-size: 0.9rem; color: white;">{{ strtoupper(str_replace('-', ' ', $layanan->jenis_layanan)) }}</td>
                    <td style="padding: 15px; font-size: 0.9rem;">{{ $layanan->nama_lengkap }}</td>
                    <td style="padding: 15px;">
                        @if($layanan->status === 'pending')
                            <span style="background-color: rgba(245, 158, 11, 0.2); color: #F59E0B; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">Pending</span>
                        @elseif($layanan->status === 'approved')
                            <span style="background-color: rgba(16, 185, 129, 0.2); color: #10B981; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">Disetujui</span>
                        @else
                            <span style="background-color: rgba(239, 68, 68, 0.2); color: #EF4444; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">Ditolak</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="padding: 30px 15px; text-align: center; color: var(--color-text-muted); font-size: 0.9rem;">
                        Belum ada surat yang pernah Anda ajukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="card mt-4" style="max-width: 900px; margin: 2rem auto 0; background-color: rgba(2, 12, 27, 0.5); border: 1px solid var(--glass-border); border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); padding: 30px; overflow-x: auto;">
        <div style="display: flex; align-items: center; margin-bottom: 25px;">
            <div style="width: 45px; height: 45px; background-color: #e74c3c; border-radius: 10px; display: flex; justify-content: center; align-items: center; color: white; margin-right: 15px; flex-shrink: 0;">
                <i class="ri-feedback-fill" style="font-size: 1.5rem;"></i>
            </div>
            <div>
                <h3 style="color: white; margin-bottom: 2px; font-size: 1.3rem;">Pengaduan yang Diajukan</h3>
                <p style="color: var(--color-text-muted); font-size: 0.85rem; margin-bottom: 0;">Daftar laporan atau pengaduan yang pernah Anda buat</p>
            </div>
        </div>

        <table style="width: 100%; border-collapse: collapse; min-width: 600px;">
            <thead>
                <tr style="border-bottom: 1px solid rgba(255,255,255,0.1); color: white; text-align: left;">
                    <th style="padding: 12px 15px; font-weight: 600; font-size: 0.9rem;">Tanggal</th>
                    <th style="padding: 12px 15px; font-weight: 600; font-size: 0.9rem;">Kategori</th>
                    <th style="padding: 12px 15px; font-weight: 600; font-size: 0.9rem;">Judul Laporan</th>
                    <th style="padding: 12px 15px; font-weight: 600; font-size: 0.9rem;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengaduans as $pengaduan)
                <tr style="border-bottom: 1px solid rgba(255,255,255,0.05); color: var(--color-text-muted); transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='rgba(255,255,255,0.02)'" onmouseout="this.style.backgroundColor='transparent'">
                    <td style="padding: 15px; font-size: 0.9rem;">{{ $pengaduan->created_at->translatedFormat('d M Y') }}</td>
                    <td style="padding: 15px; font-size: 0.9rem; color: white; text-transform: capitalize;">{{ $pengaduan->kategori }}</td>
                    <td style="padding: 15px; font-size: 0.9rem;">{{ $pengaduan->judul }}</td>
                    <td style="padding: 15px;">
                        @php
                            $statusLower = strtolower($pengaduan->status ?? 'pending');
                            $bgColor = 'rgba(127, 140, 141, 0.2)';
                            $textColor = '#7f8c8d';
                            
                            if ($statusLower == 'diproses') {
                                $bgColor = 'rgba(241, 196, 15, 0.2)';
                                $textColor = '#f1c40f';
                            } elseif ($statusLower == 'selesai' || $statusLower == 'approved') {
                                $bgColor = 'rgba(46, 204, 113, 0.2)';
                                $textColor = '#2ecc71';
                            } elseif ($statusLower == 'ditolak' || $statusLower == 'rejected') {
                                $bgColor = 'rgba(231, 76, 60, 0.2)';
                                $textColor = '#e74c3c';
                            }
                        @endphp
                        <span style="background-color: {{ $bgColor }}; color: {{ $textColor }}; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">{{ ucfirst($pengaduan->status ?? 'Pending') }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="padding: 30px 15px; text-align: center; color: var(--color-text-muted); font-size: 0.9rem;">
                        Belum ada pengaduan yang pernah Anda ajukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @endif
@if(auth()->user()->role !== 'admin')
</div>
@else
</div>
@endif
@endsection
