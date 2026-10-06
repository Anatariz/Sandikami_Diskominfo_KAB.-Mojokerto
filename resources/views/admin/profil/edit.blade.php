@extends('layouts.admin')

@section('title', 'Edit Profil Web | Sandikami')
@section('page_title', 'Edit Profil Web')

@section('content')
<div class="card mb-4" style="border-left: 4px solid var(--primary);">
    <h2 class="mb-1" style="font-size: 1.25rem;">Edit Teks Profil: {{ $page->title }}</h2>
    <p class="text-text-muted mb-0" style="font-size: 0.9rem;"><a href="{{ route('admin.profil.index') }}" class="text-secondary">Edit Profil Web</a> / {{ $page->title }}</p>
</div>

        <div class="card">
            <form action="{{ route('admin.profil.update', $page->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group mb-4">
                    <label class="form-label" for="title">Judul Halaman</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $page->title) }}" required>
                    @error('title') <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group mb-4">
                    <label class="form-label" for="content">Isi Teks / Konten (Mendukung Tag HTML)</label>
                    <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="15" required>{{ old('content', $page->content) }}</textarea>
                    @error('content') <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span> @enderror
                </div>
                
                <div class="mt-4 pt-3" style="border-top: 1px solid var(--border-color);">
                    <button type="submit" class="btn btn-warning" style="background-color: #f1c40f; color: black; padding: 10px 20px;">Update Konten</button>
                    <a href="{{ route('admin.profil.index') }}" class="btn btn-secondary" style="padding: 10px 20px; margin-left: 10px;">Batal</a>
                </div>
            </form>
        </div>

@push('styles')
<style>
    .ck-editor__editable_inline {
        min-height: 400px;
        color: #000;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    class MyUploadAdapter {
        constructor( loader ) {
            this.loader = loader;
        }

        upload() {
            return this.loader.file
                .then( file => new Promise( ( resolve, reject ) => {
                    this._initRequest();
                    this._initListeners( resolve, reject, file );
                    this._sendRequest( file );
                } ) );
        }

        abort() {
            if ( this.xhr ) {
                this.xhr.abort();
            }
        }

        _initRequest() {
            const xhr = this.xhr = new XMLHttpRequest();
            xhr.open( 'POST', '{{ route('admin.upload.image') }}', true );
            xhr.setRequestHeader('x-csrf-token', '{{ csrf_token() }}');
            xhr.responseType = 'json';
        }

        _initListeners( resolve, reject, file ) {
            const xhr = this.xhr;
            const loader = this.loader;
            const genericErrorText = `Couldn't upload file: ${ file.name }.`;

            xhr.addEventListener( 'error', () => reject( genericErrorText ) );
            xhr.addEventListener( 'abort', () => reject() );
            xhr.addEventListener( 'load', () => {
                const response = xhr.response;

                if ( !response || response.error ) {
                    return reject( response && response.error ? response.error.message : genericErrorText );
                }

                resolve( {
                    default: response.url
                } );
            } );

            if ( xhr.upload ) {
                xhr.upload.addEventListener( 'progress', evt => {
                    if ( evt.lengthComputable ) {
                        loader.uploadTotal = evt.total;
                        loader.uploaded = evt.loaded;
                    }
                } );
            }
        }

        _sendRequest( file ) {
            const data = new FormData();
            data.append( 'upload', file );
            this.xhr.send( data );
        }
    }

    function MyCustomUploadAdapterPlugin( editor ) {
        editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
            return new MyUploadAdapter( loader );
        };
    }

    ClassicEditor
        .create( document.querySelector( '#content' ), {
            extraPlugins: [ MyCustomUploadAdapterPlugin ],
        } )
        .catch( error => {
            console.error( error );
        } );
</script>
@endpush

@endsection
