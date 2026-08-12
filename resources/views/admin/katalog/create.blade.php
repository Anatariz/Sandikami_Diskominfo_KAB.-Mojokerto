@extends('layouts.admin')

@section('title', 'Tambah Katalog Layanan | Sandikami')
@section('page_title', 'Katalog Layanan')

@section('content')
<div class="card mb-4" style="border-left: 4px solid var(--primary);">
    <h2 class="mb-1" style="font-size: 1.25rem;">Tambah Layanan Baru</h2>
    <p class="text-text-muted mb-0" style="font-size: 0.9rem;"><a href="{{ route('admin.katalog.index') }}" class="text-secondary">Katalog Layanan</a> / Tambah Baru</p>
</div>

<form action="{{ route('admin.katalog.store') }}" method="POST" id="form-builder">
    @csrf
    
    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 30px;">
        <!-- Left Side: Basic Info -->
        <div>
            <div class="card">
                <h3 style="font-size: 1.1rem; margin-bottom: 20px; border-bottom: 1px solid var(--border-color); padding-bottom: 10px; color: var(--primary);">Informasi Dasar</h3>
                
                <div class="form-group">
                    <label class="form-label" for="nama_layanan">Nama Layanan *</label>
                    <input type="text" id="nama_layanan" name="nama_layanan" class="form-control" required placeholder="Contoh: Penerbitan Email Pemda">
                </div>

                <div class="form-group">
                    <label class="form-label" for="deskripsi">Deskripsi Singkat *</label>
                    <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3" required placeholder="Layanan untuk pendaftaran email resmi bagi pegawai..."></textarea>
                </div>


            </div>
        </div>

        <!-- Right Side: Form Builder -->
        <div>
            <!-- Section 1: Data Pemohon -->
            <div class="card mb-4">
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border-color); padding-bottom: 10px; margin-bottom: 20px;">
                    <h3 style="font-size: 1.1rem; color: var(--primary); margin: 0;"><i class="ri-user-line mr-1"></i> Susunan Data Pemohon</h3>
                    <button type="button" id="btn-add-pemohon" class="btn btn-sm btn-secondary" style="font-size: 0.8rem; padding: 5px 10px;">
                        <i class="ri-add-line"></i> Tambah Kolom
                    </button>
                </div>
                <div id="fields-container-pemohon">
                    <!-- Fields will be appended here by JS -->
                </div>
            </div>

            <!-- Section 2: Detail Layanan -->
            <div class="card">
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border-color); padding-bottom: 10px; margin-bottom: 20px;">
                    <h3 style="font-size: 1.1rem; color: var(--primary); margin: 0;"><i class="ri-file-list-3-line mr-1"></i> Susunan Detail Layanan</h3>
                    <button type="button" id="btn-add-layanan" class="btn btn-sm btn-secondary" style="font-size: 0.8rem; padding: 5px 10px;">
                        <i class="ri-add-line"></i> Tambah Kolom
                    </button>
                </div>
                <div id="fields-container-layanan">
                    <!-- Fields will be appended here by JS -->
                </div>

                <input type="hidden" name="form_schema" id="form_schema_input">

                <div style="margin-top: 30px; text-align: right; border-top: 1px solid var(--border-color); padding-top: 20px;">
                    <a href="{{ route('admin.katalog.index') }}" class="btn btn-secondary mr-2">Batal</a>
                    <button type="submit" class="btn btn-primary"><i class="ri-save-line mr-1"></i> Simpan Layanan</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const containerPemohon = document.getElementById('fields-container-pemohon');
        const containerLayanan = document.getElementById('fields-container-layanan');
        const btnAddPemohon = document.getElementById('btn-add-pemohon');
        const btnAddLayanan = document.getElementById('btn-add-layanan');
        const form = document.getElementById('form-builder');
        const schemaInput = document.getElementById('form_schema_input');
        
        let fieldCount = 0;

        function addField(container, data = null) {
            fieldCount++;
            
            const label = data ? data.label : '';
            const type = data ? data.type : 'text';
            const required = data ? (data.required === true || data.required === 'true') : true;
            const options = data && data.options ? data.options.join(', ') : '';
            
            const fieldHTML = `
                <div class="field-item" style="background-color: rgba(0,0,0,0.15); padding: 15px; border-radius: 8px; margin-bottom: 15px; border: 1px dashed var(--border-color); position: relative;">
                    <button type="button" class="btn-remove-field" style="position: absolute; right: 10px; top: 10px; background: none; border: none; color: #ef4444; cursor: pointer; font-size: 1.2rem;">
                        <i class="ri-close-circle-fill"></i>
                    </button>
                    
                    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 15px;">
                        <div>
                            <label style="font-size: 0.8rem; color: var(--text-muted); display: block; margin-bottom: 5px;">Label / Nama Kolom *</label>
                            <input type="text" class="form-control field-label" required placeholder="Contoh: Scan KTP, Alasan Pengajuan..." style="padding: 8px;" value="${label}">
                        </div>
                        <div>
                            <label style="font-size: 0.8rem; color: var(--text-muted); display: block; margin-bottom: 5px;">Tipe Inputan *</label>
                            <select class="form-control field-type" required style="padding: 8px; height: 38px;">
                                <option value="text" ${type === 'text' ? 'selected' : ''}>Teks Pendek</option>
                                <option value="textarea" ${type === 'textarea' ? 'selected' : ''}>Teks Panjang (Paragraf)</option>
                                <option value="file" ${type === 'file' ? 'selected' : ''}>Upload File / Berkas</option>
                                <option value="email" ${type === 'email' ? 'selected' : ''}>Email</option>
                                <option value="select" ${type === 'select' ? 'selected' : ''}>Pilihan (Dropdown)</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="options-container" style="display: ${type === 'select' ? 'block' : 'none'}; margin-top: 15px;">
                        <label style="font-size: 0.8rem; color: var(--text-muted); display: block; margin-bottom: 5px;">Pilihan (Pisahkan dengan koma) *</label>
                        <input type="text" class="form-control field-options" placeholder="Contoh: Baru, Perpanjangan, Kendala TTE" style="padding: 8px;" value="${options}">
                    </div>
                    
                    <div style="margin-top: 15px; display: flex; align-items: center; gap: 10px;">
                        <input type="checkbox" class="field-required" ${required ? 'checked' : ''} id="req_${fieldCount}">
                        <label for="req_${fieldCount}" style="font-size: 0.85rem; color: var(--text-main); cursor: pointer;">Wajib diisi oleh pemohon (Required)</label>
                    </div>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', fieldHTML);
        }

        // Add first fields by default
        addField(containerPemohon, {label: 'Nama Lengkap Pemohon', type: 'text', required: true});
        addField(containerLayanan);

        btnAddPemohon.addEventListener('click', () => addField(containerPemohon));
        btnAddLayanan.addEventListener('click', () => addField(containerLayanan));

        function removeFieldHandler(e) {
            if (e.target.closest('.btn-remove-field')) {
                e.target.closest('.field-item').remove();
            }
        }
        
        function changeTypeHandler(e) {
            if (e.target.classList.contains('field-type')) {
                const item = e.target.closest('.field-item');
                const optionsContainer = item.querySelector('.options-container');
                if (e.target.value === 'select') {
                    optionsContainer.style.display = 'block';
                    optionsContainer.querySelector('.field-options').setAttribute('required', 'required');
                } else {
                    optionsContainer.style.display = 'none';
                    optionsContainer.querySelector('.field-options').removeAttribute('required');
                }
            }
        }

        containerPemohon.addEventListener('click', removeFieldHandler);
        containerLayanan.addEventListener('click', removeFieldHandler);
        containerPemohon.addEventListener('change', changeTypeHandler);
        containerLayanan.addEventListener('change', changeTypeHandler);

        function extractSchema(container) {
            const items = container.querySelectorAll('.field-item');
            const schema = [];
            items.forEach((item, index) => {
                const label = item.querySelector('.field-label').value.trim();
                const type = item.querySelector('.field-type').value;
                const required = item.querySelector('.field-required').checked;
                
                let name = label.toLowerCase()
                            .replace(/[^a-z0-9]/g, '_')
                            .replace(/_+/g, '_')
                            .replace(/^_|_$/g, '');
                
                if (!name) name = 'field_' + index;
                let schemaObj = { name, label, type, required };
                if (type === 'select') {
                    const optionsInput = item.querySelector('.field-options').value;
                    schemaObj.options = optionsInput.split(',').map(s => s.trim()).filter(s => s !== '');
                }
                
                schema.push(schemaObj);
            });
            return schema;
        }

        // Parse fields into JSON on submit
        form.addEventListener('submit', function(e) {
            const schemaPemohon = extractSchema(containerPemohon);
            const schemaLayanan = extractSchema(containerLayanan);

            schemaInput.value = JSON.stringify({
                pemohon: schemaPemohon,
                layanan: schemaLayanan
            });
        });
    });
</script>
@endpush
