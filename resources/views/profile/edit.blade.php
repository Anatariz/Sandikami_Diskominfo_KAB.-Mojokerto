@extends(auth()->user()->role === 'admin' ? 'layouts.admin' : 'layouts.app')

@section('title', 'Edit Profil Akun - Sandikami')
@section('page_title', 'Edit Profil Akun')

@section('content')
@if(auth()->user()->role !== 'admin')
<div class="container" style="padding-top: 8rem; padding-bottom: 4rem; min-height: 80vh;">
@else
<div style="padding-bottom: 4rem;">
@endif
    <h1 class="mb-4" style="text-align: center; color: var(--color-text); margin-bottom: 2rem;">Edit Profil Akun</h1>
    
    <div class="card p-5" style="max-width: 800px; margin: 0 auto; background-color: rgba(255, 255, 255, 0.05); border: 1px solid var(--glass-border); border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); padding: 40px;">
        
        @if ($errors->any())
            <div class="alert alert-danger" style="background-color: #e74c3c; color: white; padding: 15px; border-radius: 8px; margin-bottom: 1.5rem;">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                <div class="form-group mb-4" style="flex: 1; min-width: 300px;">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required style="background-color: rgba(255,255,255,0.1); border: 1px solid var(--glass-border); color: white;">
                </div>
                
                <div class="form-group mb-4" style="flex: 1; min-width: 300px;">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required style="background-color: rgba(255,255,255,0.1); border: 1px solid var(--glass-border); color: white;">
                </div>
            </div>

            <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                <div class="form-group mb-4" style="flex: 1; min-width: 300px;">
                    <label for="jabatan" class="form-label">Jabatan (Opsional)</label>
                    <input type="text" id="jabatan" name="jabatan" class="form-control" value="{{ old('jabatan', $user->jabatan) }}" placeholder="Contoh: Staff IT" style="background-color: rgba(255,255,255,0.1); border: 1px solid var(--glass-border); color: white;">
                </div>
                
                <div class="form-group mb-4" style="flex: 1; min-width: 300px;">
                    <label for="divisi" class="form-label">Perangkat Daerah / Divisi (Opsional)</label>
                    <input type="text" id="divisi" name="divisi" class="form-control" value="{{ old('divisi', $user->divisi) }}" placeholder="Contoh: Diskominfo" style="background-color: rgba(255,255,255,0.1); border: 1px solid var(--glass-border); color: white;">
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="avatar" class="form-label">Upload Foto Profil Baru (Opsional)</label>
                <div style="display: flex; align-items: center; gap: 15px;">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                    @else
                        <div style="width: 50px; height: 50px; background-color: var(--color-primary); color: white; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 1.5rem;">
                            <i class="ri-user-fill"></i>
                        </div>
                    @endif
                    <input type="file" id="avatar" name="avatar" class="form-control" accept="image/*" style="background-color: rgba(255,255,255,0.1); border: 1px solid var(--glass-border); color: white;">
                </div>
                <small style="color: var(--color-text-muted); display: block; margin-top: 5px;">
                    <i class="ri-information-line"></i> Kosongkan jika tidak ingin mengubah foto. Format yang didukung: JPG, PNG, GIF (maksimal 2MB)
                </small>
            </div>

            <hr style="border-color: rgba(255,255,255,0.1); margin: 2rem 0;">
            <h4 style="margin-bottom: 1.5rem; color: var(--color-secondary);">Ganti Password (Opsional)</h4>

            <div class="form-group mb-4">
                <label for="current_password" class="form-label">Password Saat Ini</label>
                <input type="password" id="current_password" name="current_password" class="form-control" placeholder="Isi jika ingin ganti password" autocomplete="new-password" style="background-color: rgba(255,255,255,0.1); border: 1px solid var(--glass-border); color: white;">
            </div>

            <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                <div class="form-group mb-4" style="flex: 1; min-width: 300px;">
                    <label for="new_password" class="form-label">Password Baru</label>
                    <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Minimal 8 karakter" autocomplete="new-password" style="background-color: rgba(255,255,255,0.1); border: 1px solid var(--glass-border); color: white;">
                </div>
                
                <div class="form-group mb-4" style="flex: 1; min-width: 300px;">
                    <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" autocomplete="new-password" style="background-color: rgba(255,255,255,0.1); border: 1px solid var(--glass-border); color: white;">
                </div>
            </div>

            <div style="display: flex; gap: 15px; margin-top: 1rem;">
                <button type="submit" class="btn btn-primary" style="padding: 10px 25px; border-radius: 5px;">
                    <i class="ri-lock-2-line"></i> Simpan Perubahan
                </button>
                <a href="{{ route('profile.show') }}" class="btn btn-secondary" style="padding: 10px 25px; border-radius: 5px; background-color: transparent; border: 1px solid var(--color-text-muted); color: var(--color-text);">
                    Batal
                </a>
            </div>
        </form>
    </div>
@if(auth()->user()->role !== 'admin')
</div>
@else
</div>
@endif
@endsection
