@extends('layouts.admin')

@section('title', 'Edit Panduan | Sandikami')
@section('page_title', 'Edit Panduan')

@section('content')
<div class="card mb-4" style="border-left: 4px solid var(--primary);">
    <h2 class="mb-1" style="font-size: 1.25rem;">Edit Panduan</h2>
    <p class="text-text-muted mb-0" style="font-size: 0.9rem;">Pilih halaman panduan yang ingin Anda perbarui teks/kontennya.</p>
</div>

        @if(session('success'))
        <div class="alert alert-success mb-4" style="background-color: #2ecc71; color: white; padding: 15px; border-radius: 8px;">
            {{ session('success') }}
        </div>
        @endif

        <div class="card p-0" style="overflow-x: auto;">
            <table class="table" style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background-color: rgba(255,255,255,0.1);">
                        <th style="padding: 15px; border-bottom: 1px solid var(--border-color);">Halaman Panduan</th>
                        <th style="padding: 15px; border-bottom: 1px solid var(--border-color);">URL / Slug</th>
                        <th style="padding: 15px; border-bottom: 1px solid var(--border-color);">Terakhir Diperbarui</th>
                        <th style="padding: 15px; border-bottom: 1px solid var(--border-color); text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pages as $page)
                    <tr>
                        <td style="padding: 15px; border-bottom: 1px solid var(--border-color);">
                            @if($page->slug == 'panduan-insiden')
                                <strong>Panduan Penanganan Insiden</strong>
                            @elseif($page->slug == 'panduan-sop')
                                <strong>SOP Keamanan</strong>
                            @elseif($page->slug == 'panduan-produk-hukum')
                                <strong>Produk Hukum</strong>
                            @else
                                <strong>{{ $page->slug }}</strong>
                            @endif
                        </td>
                        <td style="padding: 15px; border-bottom: 1px solid var(--border-color);">/panduan/{{ str_replace('panduan-', '', $page->slug) }}</td>
                        <td style="padding: 15px; border-bottom: 1px solid var(--border-color);">{{ $page->updated_at->format('d M Y H:i') }}</td>
                        <td style="padding: 15px; border-bottom: 1px solid var(--border-color); text-align: right;">
                            <a href="{{ route('admin.panduan.edit', $page->id) }}" class="btn btn-sm btn-warning" style="background-color: #f1c40f; color: black; padding: 6px 12px; font-size: 0.8rem;">Edit Tulisan</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

@endsection
