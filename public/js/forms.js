const formData = {
  email: {
    title: "Penerbitan E-Mail Pemda",
    desc: "Layanan pengajuan pembuatan akun surat elektronik resmi Pemerintah Kabupaten Mojokerto dengan domain @mojokertokab.go.id.",
    fields: [
      { type: 'text', id: 'nama', label: 'Nama Lengkap', required: true },
      { type: 'text', id: 'nip', label: 'NIP / NIK', required: true },
      { type: 'text', id: 'jabatan', label: 'Jabatan', required: true },
      { type: 'text', id: 'pangkat', label: 'Pangkat / Golongan', required: true },
      { type: 'text', id: 'opd', label: 'Perangkat Daerah / Unit Kerja', required: true },
      { type: 'tel', id: 'wa', label: 'No. WhatsApp Aktif', required: true },
      { type: 'email', id: 'email_usulan', label: 'Email yang Diusulkan', desc: 'Misal: nama@mojokertokab.go.id', required: true },
      { type: 'file', id: 'surat', label: 'Upload Surat Permohonan (PDF)', required: true }
    ]
  },
  tte: {
    title: "Pengajuan Tanda Tangan Elektronik (TTE)",
    desc: "Layanan pengajuan penerbitan Sertifikat Elektronik sebagai dasar penggunaan Tanda Tangan Elektronik (TTE).",
    fields: [
      { type: 'text', id: 'nama', label: 'Nama Lengkap', required: true },
      { type: 'text', id: 'nip', label: 'NIP / NIK', required: true },
      { type: 'text', id: 'jabatan', label: 'Jabatan', required: true },
      { type: 'text', id: 'pangkat', label: 'Pangkat / Golongan', required: true },
      { type: 'text', id: 'opd', label: 'Perangkat Daerah / Unit Kerja', required: true },
      { type: 'email', id: 'email', label: 'Email Pemohon (@mojokertokab.go.id)', required: true },
      { type: 'tel', id: 'wa', label: 'No. WhatsApp Aktif', required: true },
      { type: 'select', id: 'jenis', label: 'Jenis Pengajuan', options: ['Baru', 'Perpanjangan', 'Kendala TTE'], required: true },
      { type: 'file', id: 'surat', label: 'Upload Surat Permohonan (PDF)', required: true }
    ]
  },
  assessment: {
    title: "IT Security Assessment",
    desc: "Pengajuan pengujian keamanan (Vulnerability Assessment) terhadap website atau aplikasi milik Pemerintah Kabupaten Mojokerto.",
    fields: [
      { type: 'text', id: 'nama', label: 'Nama Lengkap (PIC)', required: true },
      { type: 'text', id: 'nip', label: 'NIP / NIK', required: true },
      { type: 'text', id: 'jabatan', label: 'Jabatan', required: true },
      { type: 'text', id: 'pangkat', label: 'Pangkat / Golongan', required: true },
      { type: 'text', id: 'opd', label: 'Perangkat Daerah / Unit Kerja', required: true },
      { type: 'tel', id: 'wa', label: 'No. WhatsApp PIC', required: true },
      { type: 'text', id: 'nama_app', label: 'Nama Aplikasi / Sistem', required: true },
      { type: 'select', id: 'jenis_app', label: 'Jenis Aplikasi', options: ['Website', 'Mobile'], required: true },
      { type: 'select', id: 'env_app', label: 'Environment', options: ['Production', 'Staging'], required: true },
      { type: 'text', id: 'url_app', label: 'Alamat / URL Aplikasi', required: true },
      { type: 'file', id: 'surat', label: 'Upload Surat Permohonan Resmi (PDF)', required: true },
      { type: 'checkbox', id: 'izin', label: 'Saya menyetujui dilakukan pengujian keamanan (Scanning/Pentest) pada target di atas.', required: true }
    ]
  },
  ssl: {
    title: "Permohonan SSL",
    desc: "Pengajuan pemasangan atau perpanjangan Sertifikat SSL/TLS pada website atau aplikasi Pemerintah Kabupaten Mojokerto.",
    fields: [
      { type: 'text', id: 'nama', label: 'Nama Lengkap', required: true },
      { type: 'text', id: 'nip', label: 'NIP / NIK', required: true },
      { type: 'text', id: 'jabatan', label: 'Jabatan', required: true },
      { type: 'text', id: 'pangkat', label: 'Pangkat / Golongan', required: true },
      { type: 'text', id: 'opd', label: 'Perangkat Daerah / Unit Kerja', required: true },
      { type: 'tel', id: 'wa', label: 'No. WhatsApp', required: true },
      { type: 'file', id: 'surat', label: 'Upload Surat Permohonan (PDF)', required: true }
    ]
  },
  awareness: {
    title: "Layanan Security Awareness",
    desc: "Pengajuan kegiatan sosialisasi, edukasi, bimbingan teknis, workshop mengenai keamanan informasi.",
    fields: [
      { type: 'html', content: '<h3 class="form-section-title">A. Data Pemohon</h3>' },
      { type: 'text', id: 'nama', label: 'Nama Lengkap', required: true },
      { type: 'text', id: 'nip', label: 'NIP / NIK', required: true },
      { type: 'text', id: 'jabatan', label: 'Jabatan', required: true },
      { type: 'text', id: 'opd', label: 'Perangkat Daerah / Unit Kerja', required: true },
      { type: 'email', id: 'email', label: 'Email Aktif', required: true },
      { type: 'tel', id: 'wa', label: 'No. WhatsApp', required: true },
      
      { type: 'html', content: '<h3 class="form-section-title">B. Data Permohonan Kegiatan</h3>' },
      { type: 'select', id: 'jenis_keg', label: 'Jenis Kegiatan', options: ['Sosialisasi', 'Bimbingan Teknis (Bimtek)', 'Workshop', 'Seminar', 'Edukasi Keamanan Informasi', 'Lainnya'], required: true },
      { type: 'text', id: 'tema', label: 'Tema yang Diinginkan', required: true },
      { type: 'number', id: 'jml_peserta', label: 'Estimasi Jumlah Peserta', required: true },
      { type: 'select', id: 'sasaran', label: 'Sasaran Peserta', options: ['ASN', 'Administrator Sistem', 'Operator Aplikasi', 'Perangkat Desa', 'Lainnya'], required: true },
      { type: 'date', id: 'tgl', label: 'Tanggal Pelaksanaan (Usulan)', required: true },
      { type: 'time', id: 'waktu', label: 'Waktu Pelaksanaan', required: true },
      { type: 'text', id: 'lokasi', label: 'Lokasi Pelaksanaan', required: true },
      { type: 'select', id: 'metode', label: 'Metode Pelaksanaan', options: ['Offline', 'Online', 'Hybrid'], required: true },
      { type: 'textarea', id: 'uraian', label: 'Uraian Singkat Kebutuhan', required: true },
      { type: 'file', id: 'surat', label: 'Lampiran / Surat Permohonan (Opsional)', required: false }
    ]
  },
  jamming: {
    title: "Layanan Jamming / Kontra Penginderaan",
    desc: "Dukungan pengamanan komunikasi melalui perangkat kontra penginderaan pada kegiatan strategis.",
    fields: [
      { type: 'html', content: '<h3 class="form-section-title">A. Data Pemohon</h3>' },
      { type: 'text', id: 'nama', label: 'Nama Lengkap', required: true },
      { type: 'text', id: 'nip', label: 'NIP / NIK', required: true },
      { type: 'text', id: 'jabatan', label: 'Jabatan', required: true },
      { type: 'text', id: 'opd', label: 'Perangkat Daerah / Unit Kerja', required: true },
      { type: 'tel', id: 'wa', label: 'No. WhatsApp', required: true },
      
      { type: 'html', content: '<h3 class="form-section-title">B. Data Kegiatan</h3>' },
      { type: 'text', id: 'nama_kegiatan', label: 'Nama Kegiatan', required: true },
      { type: 'text', id: 'pj', label: 'Penanggung Jawab Kegiatan', required: true },
      { type: 'date', id: 'tgl', label: 'Tanggal Pelaksanaan', required: true },
      { type: 'time', id: 'mulai', label: 'Waktu Mulai', required: true },
      { type: 'time', id: 'selesai', label: 'Waktu Selesai', required: true },
      { type: 'text', id: 'lokasi', label: 'Lokasi Kegiatan', required: true },
      { type: 'text', id: 'vvip', label: 'Pejabat/VVIP yang Hadir (Opsional)', required: false },
      { type: 'number', id: 'estimasi', label: 'Estimasi Jumlah Peserta', required: true },
      { type: 'file', id: 'surat', label: 'Lampiran Surat Permohonan (PDF)', required: true }
    ]
  },
  csirt: {
    title: "Layanan CSIRT (Insiden Keamanan)",
    desc: "Pelaporan dan penanganan insiden keamanan informasi.",
    fields: [
      { type: 'text', id: 'nama', label: 'Nama Pelapor', required: true },
      { type: 'text', id: 'opd', label: 'Perangkat Daerah', required: true },
      { type: 'tel', id: 'wa', label: 'No. WhatsApp', required: true },
      { type: 'select', id: 'jenis_insiden', label: 'Jenis Insiden', options: ['Website Defacement (Peretasan Web)', 'Data Breach (Kebocoran Data)', 'Malware/Ransomware', 'Gangguan Akses/DDoS', 'Phishing', 'Lainnya'], required: true },
      { type: 'text', id: 'url', label: 'Target Insiden (URL/IP/Sistem)', required: true },
      { type: 'textarea', id: 'kronologi', label: 'Kronologi Kejadian Singkat', required: true },
      { type: 'file', id: 'bukti', label: 'Lampiran Bukti (Screenshot)', required: true }
    ]
  }
};

document.addEventListener('DOMContentLoaded', () => {
  // formType is defined in form-layanan.blade.php
  const type = typeof formType !== 'undefined' ? formType : 'email';
  
  const formConfig = formData[type];
  if (!formConfig) {
    document.getElementById('formTitle').innerHTML = 'Formulir <span>Tidak Ditemukan</span>';
    return;
  }
  
  document.getElementById('formTitle').innerHTML = formConfig.title;
  document.getElementById('formDesc').textContent = formConfig.desc;
  
  const container = document.getElementById('formFieldsContainer');
  let html = '<div class="grid-2-cols">';
  let openGrid = true;
  
  formConfig.fields.forEach(field => {
    if (field.type === 'html') {
      if (openGrid) { html += '</div>'; openGrid = false; }
      html += field.content;
      html += '<div class="grid-2-cols">';
      openGrid = true;
      return;
    }
    
    // Group wrapper
    const colSpan = (field.type === 'textarea' || field.type === 'checkbox' || field.type === 'file' || field.id === 'surat') ? 'style="grid-column: 1 / -1;"' : '';
    html += `<div class="form-group" ${colSpan}>`;
    
    if (field.type !== 'checkbox') {
      html += `<label class="form-label" for="${field.id}">${field.label} ${field.required ? '<span class="text-danger">*</span>' : ''}</label>`;
    }
    
    if (field.type === 'select') {
      html += `<select class="form-control" name="${field.id}" id="${field.id}" ${field.required ? 'required' : ''}>
        <option value="" disabled selected>-- Pilih --</option>`;
      field.options.forEach(opt => {
        html += `<option value="${opt}">${opt}</option>`;
      });
      html += `</select>`;
    } else if (field.type === 'textarea') {
      html += `<textarea class="form-control" name="${field.id}" id="${field.id}" rows="4" ${field.required ? 'required' : ''}></textarea>`;
    } else if (field.type === 'file') {
      html += `<div class="file-upload-wrapper">
        <div class="file-upload-display">
          <i class="ri-upload-cloud-2-line mr-2" style="font-size: 1.5rem; margin-right: 10px;"></i>
          <span>${field.label}</span>
        </div>
        <input type="file" name="${field.id}" id="${field.id}" ${field.required ? 'required' : ''}>
      </div>`;
    } else if (field.type === 'checkbox') {
      html += `<div class="form-check">
        <input type="checkbox" name="${field.id}" class="form-check-input" id="${field.id}" ${field.required ? 'required' : ''} value="1">
        <label class="form-check-label" for="${field.id}">${field.label}</label>
      </div>`;
    } else {
      html += `<input type="${field.type}" name="${field.id}" class="form-control" id="${field.id}" ${field.required ? 'required' : ''}>`;
    }
    
    if (field.desc) {
      html += `<span class="form-text">${field.desc}</span>`;
    }
    
    html += `</div>`;
  });
  
  if (openGrid) { html += '</div>'; }
  
  // Append Persetujuan & Captcha
  html += `
    <hr style="border-color: var(--glass-border); margin: 30px 0;">
    <h3 class="form-section-title" style="margin-top:0;">Pernyataan</h3>
    <div class="form-group" style="grid-column: 1 / -1;">
      <div class="form-check">
        <input type="checkbox" class="form-check-input" name="kebenaran" id="kebnaran" required value="1">
        <label class="form-check-label" for="kebnaran">Dengan ini saya menyatakan bahwa data yang saya isikan adalah <b>benar</b> dan dapat dipertanggungjawabkan.</label>
      </div>
      <div class="form-check">
        <input type="checkbox" class="form-check-input" name="persetujuan" id="persetujuan" required value="1">
        <label class="form-check-label" for="persetujuan">Saya menyetujui pemrosesan data untuk keperluan layanan Persandian dan Keamanan Informasi.</label>
      </div>
    </div>
    
    <div class="form-group" style="max-width: 200px;">
      <label class="form-label">Captcha</label>
      <div style="background: rgba(0,0,0,0.5); padding: 10px; text-align: center; font-family: monospace; letter-spacing: 5px; font-size: 1.2rem; margin-bottom: 10px; border-radius: 4px; color: #fff;">
        X 9 F 2 Q
      </div>
      <input type="text" class="form-control" placeholder="Masukkan kode di atas" required>
    </div>
    
    <div style="margin-top: 30px;">
      <button type="submit" class="btn btn-accent btn-block" style="padding: 15px; font-size: 1.1rem;"><i class="ri-send-plane-fill mr-2"></i> Kirim Permohonan</button>
    </div>
  `;
  
  container.innerHTML = html;
  
  // Re-attach file listener for dynamically generated file inputs
  const fileInputs = container.querySelectorAll('.file-upload-wrapper input[type="file"]');
  fileInputs.forEach(input => {
    input.addEventListener('change', function(e) {
      const fileName = e.target.files[0] ? e.target.files[0].name : 'File terpilih';
      const display = this.parentElement.querySelector('span');
      if (display) {
        display.textContent = fileName;
        display.style.color = 'var(--color-secondary)';
      }
    });
  });
});
