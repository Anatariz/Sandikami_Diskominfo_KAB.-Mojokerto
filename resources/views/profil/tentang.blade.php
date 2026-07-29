@extends('layouts.app')
@section('title', 'Tentang Sandikami - Diskominfo Kab. Mojokerto')
@section('content')
<div class="container" style="padding-top: 8rem; padding-bottom: 4rem;">
    <div class="card p-4">
        {!! $content->content ?? '<p>Konten belum tersedia.</p>' !!}
    </div>
</div>
@endsection
