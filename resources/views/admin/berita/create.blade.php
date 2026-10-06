@extends('layouts.admin')

@section('title', 'Tambah Berita - Sandikami')
@section('page_title', 'Tambah Berita')

@section('content')

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="margin: 0; font-size: 1.25rem;">Form Tambah Berita</h2>
        <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">
            <i class="ri-arrow-left-line"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert" style="background-color: rgba(239, 68, 68, 0.1); color: #EF4444; border: 1px solid rgba(239, 68, 68, 0.2); margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label class="form-label" for="judul">Judul Berita <span style="color: #ef4444;">*</span></label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="ringkasan">Ringkasan (Tampil di beranda) <span style="color: #ef4444;">*</span></label>
            <textarea name="ringkasan" id="ringkasan" rows="3" class="form-control" required>{{ old('ringkasan') }}</textarea>
            <small style="color: var(--text-muted);">Tuliskan maksimal 2-3 kalimat ringkasan.</small>
        </div>

        <div class="form-group">
            <label class="form-label" for="isi">Isi Berita <span style="color: #ef4444;">*</span></label>
            <textarea name="isi" id="editor" class="form-control" rows="10">{{ old('isi') }}</textarea>
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
            <label class="form-label" for="gambar">Gambar Thumbnail</label>
            <div style="margin-top: 10px;">
                <div class="file-upload-wrapper">
                    <div class="file-upload-display">
                        <i class="ri-upload-cloud-2-line mr-2" style="font-size: 1.5rem; margin-right: 10px;"></i>
                        <span>Upload Gambar Thumbnail</span>
                    </div>
                    <input type="file" name="gambar" id="gambar" accept="image/*" ondragenter="this.parentElement.classList.add('dragover')" ondragleave="this.parentElement.classList.remove('dragover')" ondrop="this.parentElement.classList.remove('dragover')" onchange="previewImage(event); const d = this.parentElement.querySelector('span'); if(d) { d.textContent = this.files[0] ? this.files[0].name : 'Upload Gambar Thumbnail'; d.style.color = 'var(--color-secondary)'; }">
                </div>
                <div style="margin-top: 15px;">
                    <img id="image-preview" src="#" alt="Preview Gambar" style="display: none; max-width: 100%; max-height: 300px; border-radius: 8px; border: 1px solid var(--border-color);">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="status">Status <span style="color: #ef4444;">*</span></label>
            <select name="status" id="status" class="form-control" required>
                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published (Publikasikan)</option>
                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Simpan sebagai konsep)</option>
            </select>
        </div>

        <div style="margin-top: 30px; display: flex; gap: 15px;">
            <button type="submit" class="btn btn-primary" style="background-color: var(--primary); border-color: var(--primary); padding: 10px 25px;">
                <i class="ri-save-line"></i> Simpan Berita
            </button>
            <button type="reset" class="btn btn-secondary" style="padding: 10px 25px;">Reset</button>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    // Inisialisasi CKEditor
    ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: '{{ route('admin.upload.image') }}?_token={{ csrf_token() }}'
            },
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|', 'imageUpload', 'insertTable', 'undo', 'redo']
        })
        .catch(error => {
            console.error(error);
        });

    // Preview Gambar
    function previewImage(event) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var preview = document.getElementById('image-preview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<style>
    .ck-editor__editable_inline {
        min-height: 300px;
        color: #333;
    }
    .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused) {
        border-color: var(--border-color);
        background-color: rgba(255,255,255,0.9);
    }
    .ck.ck-editor__main>.ck-editor__editable.ck-focused {
        background-color: #fff;
    }
    .ck.ck-toolbar {
        background-color: rgba(255,255,255,0.95);
        border-color: var(--border-color);
    }
</style>
@endpush
