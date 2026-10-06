@extends('layouts.admin')

@section('title', 'Katalog Layanan | Sandikami')
@section('page_title', 'Katalog Layanan')

@section('content')
<div class="card mb-4" style="display: flex; justify-content: space-between; align-items: center; border-left: 4px solid var(--primary);">
    <div>
        <h2 class="mb-1" style="font-size: 1.25rem;">Katalog Layanan </h2>
        <p class="text-text-muted mb-0" style="font-size: 0.9rem;">Konfigurasi jenis layanan yang tersedia beserta field formulirnya.</p>
    </div>
    <div>
        <a href="{{ route('admin.katalog.create') }}" class="btn btn-primary"><i class="ri-add-line mr-1"></i> Tambah Layanan</a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

{{-- Filter Kategori --}}
<div class="card mb-4" style="padding: 16px 20px;">
    <form method="GET" action="{{ route('admin.katalog.index') }}" style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
        <div style="display: flex; align-items: center; gap: 8px; font-size: 0.9rem; font-weight: 600;">
            <i class="ri-filter-3-line" style="color: var(--primary);"></i>
            Filter Kategori:
        </div>

        <a href="{{ route('admin.katalog.index') }}"
           style="
               padding: 5px 14px; border-radius: 20px; font-size: 0.82rem; font-weight: 600;
               text-decoration: none; transition: all .2s;
               {{ !request('kategori') ? 'background: var(--primary); color: white;' : 'background: rgba(255,255,255,0.07); color: var(--text-muted); border: 1px solid var(--border-color);' }}
           ">
            Semua ({{ \App\Models\LayananKatalog::count() }})
        </a>

        @foreach($kategoris as $kat)
        <a href="{{ route('admin.katalog.index', ['kategori' => $kat]) }}"
           style="
               padding: 5px 14px; border-radius: 20px; font-size: 0.82rem; font-weight: 600;
               text-decoration: none; transition: all .2s; text-transform: uppercase;
               {{ request('kategori') === $kat ? 'background: var(--primary); color: white;' : 'background: rgba(255,255,255,0.07); color: var(--text-muted); border: 1px solid var(--border-color);' }}
           ">
            {{ strtoupper($kat) }} ({{ \App\Models\LayananKatalog::where('kategori', $kat)->count() }})
        </a>
        @endforeach
    </form>
</div>

<div class="card p-0" style="overflow-x: auto;">
    <table class="table">
        <thead>
            <tr>
                <th>Layanan</th>
                <th style="width: 160px;">Kategori</th>
                <th>Total Kolom Form</th>
                <th>Status</th>
                <th width="150">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($layanans as $layanan)
            <tr>
                <td>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div>
                            <strong>{{ $layanan->nama_layanan }}</strong>
                            <div style="font-size: 0.78rem; color: var(--text-muted); margin-top: 2px;">
                                {{ Str::limit($layanan->deskripsi, 60) }}
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    @php
                        $kat = strtoupper($layanan->kategori ?? 'UMUM');
                        $colors = [
                            'KONSULTASI'    => ['bg' => 'rgba(52,152,219,0.2)',  'color' => '#3498db'],
                            'PENGAJUAN'     => ['bg' => 'rgba(46,204,113,0.2)',  'color' => '#2ecc71'],
                            'PEMELIHARAAN'  => ['bg' => 'rgba(241,196,15,0.2)',  'color' => '#e6b800'],
                            'PELATIHAN'     => ['bg' => 'rgba(155,89,182,0.2)',  'color' => '#9b59b6'],
                            'INFRASTRUKTUR' => ['bg' => 'rgba(230,126,34,0.2)',  'color' => '#e67e22'],
                            'KEAMANAN'      => ['bg' => 'rgba(231,76,60,0.2)',   'color' => '#e74c3c'],
                            'INFORMASI'     => ['bg' => 'rgba(26,188,156,0.2)',  'color' => '#1abc9c'],
                        ];
                        $style = $colors[$kat] ?? ['bg' => 'rgba(127,140,141,0.2)', 'color' => '#95a5a6'];
                    @endphp
                    <span style="
                        display: inline-block;
                        padding: 3px 10px;
                        border-radius: 20px;
                        font-size: 0.75rem;
                        font-weight: 700;
                        letter-spacing: 0.05em;
                        background: {{ $style['bg'] }};
                        color: {{ $style['color'] }};
                        border: 1px solid {{ $style['color'] }}55;
                    ">{{ $kat }}</span>
                </td>
                <td>
                    <span style="font-size: 0.9rem;">
                        {{ is_array($layanan->form_schema) ? count($layanan->form_schema) : 0 }} Kolom
                    </span>
                </td>
                <td>
                    @if($layanan->status == 'active')
                        <span style="color: #10B981; font-weight: 500; font-size: 0.85rem;"><i class="ri-checkbox-circle-line"></i> Aktif</span>
                    @else
                        <span style="color: var(--text-muted); font-size: 0.85rem;"><i class="ri-close-circle-line"></i> Nonaktif</span>
                    @endif
                </td>
                <td>
                    <div style="display: flex; gap: 5px;">
                        <a href="{{ route('admin.katalog.edit', $layanan->id) }}" class="btn btn-sm btn-info" style="background-color: #3b82f6; color: white; padding: 5px 10px; font-size: 0.8rem; border: none;">Edit</a>
                        <form action="{{ route('admin.katalog.destroy', $layanan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus layanan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" style="padding: 5px 10px; font-size: 0.8rem;">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center" style="padding: 30px; color: var(--text-muted);">
                    <i class="ri-inbox-line" style="font-size: 2rem; display: block; margin-bottom: 8px;"></i>
                    Belum ada layanan
                    @if(request('kategori'))untuk kategori <strong>{{ request('kategori') }}</strong>@endif.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
