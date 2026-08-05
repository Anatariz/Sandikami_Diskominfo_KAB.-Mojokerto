@extends('layouts.app')
@section('title', 'Tugas dan Fungsi - Diskominfo Kab. Mojokerto')
@section('content')
<div class="container" style="padding-top: 8rem; padding-bottom: 4rem;">
    <h1 class="mb-4">{{ $content->title ?? 'Judul Belum Tersedia' }}</h1>
    <div class="card p-4">
        {!! nl2br(e($content->content ?? 'Konten belum tersedia.')) !!}
    </div>
</div>
@endsection
