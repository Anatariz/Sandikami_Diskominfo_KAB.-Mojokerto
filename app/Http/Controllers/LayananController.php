<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LayananRequest;

class LayananController extends Controller
{

    public function form($type)
    {
        $layanan = \App\Models\LayananKatalog::where('jenis_layanan', $type)->where('status', 'active')->firstOrFail();
        return view("form-layanan", compact('type', 'layanan'));
    }

    public function submit(Request $request, $type)
    {
        $layanan = \App\Models\LayananKatalog::where('jenis_layanan', $type)->where('status', 'active')->firstOrFail();

        $schemaPemohon = isset($layanan->form_schema['pemohon']) ? $layanan->form_schema['pemohon'] : [];
        $schemaLayanan = isset($layanan->form_schema['layanan']) ? $layanan->form_schema['layanan'] : (isset($layanan->form_schema[0]) ? $layanan->form_schema : []);
        $allSchema = array_merge($schemaPemohon, $schemaLayanan);

        $rules = [
            'persetujuan' => 'accepted',
            'kebenaran' => 'accepted',
            'captcha_answer' => 'required|same:captcha_expected'
        ];

        // Build dynamic rules based on schema
        foreach ($allSchema as $field) {
            $rule = [];
            if ($field['required']) {
                $rule[] = 'required';
            } else {
                $rule[] = 'nullable';
            }

            if ($field['type'] === 'file') {
                $rule[] = 'file';
                $rule[] = 'max:5120'; // 5MB max
            } elseif ($field['type'] === 'email') {
                $rule[] = 'email';
            } else {
                $rule[] = 'string';
            }

            $rules[$field['name']] = implode('|', $rule);
        }

        $validated = $request->validate($rules);

        // Process file uploads dynamically
        $dataTambahan = [];
        $primaryFilePath = null;

        foreach ($allSchema as $field) {
            $name = $field['name'];
            if ($field['type'] === 'file' && $request->hasFile($name)) {
                $path = $request->file($name)->store('layanan', 'public');
                $dataTambahan[$name] = $path; // Store path in JSON
                if (!$primaryFilePath) {
                    $primaryFilePath = $path; // Use first found file as primary
                }
            } else {
                // Ignore persetujuan and kebenaran from extra data
                if (isset($validated[$name])) {
                    $dataTambahan[$name] = $validated[$name];
                }
            }
        }

        LayananRequest::create([
            'user_id' => auth()->id(),
            'jenis_layanan' => $type,
            'nama_lengkap' => $dataTambahan['nama_lengkap'] ?? $dataTambahan['nama'] ?? 'Tanpa Nama',
            'nip_nik' => $dataTambahan['nip_nik'] ?? $dataTambahan['nip'] ?? null,
            'jabatan' => $dataTambahan['jabatan'] ?? null,
            'pangkat_golongan' => $dataTambahan['pangkat_golongan'] ?? $dataTambahan['pangkat'] ?? null,
            'perangkat_daerah' => $dataTambahan['perangkat_daerah'] ?? $dataTambahan['opd'] ?? null,
            'no_wa' => $dataTambahan['no_wa'] ?? $dataTambahan['wa'] ?? null,
            'file_lampiran' => $primaryFilePath,
            'data_tambahan' => $dataTambahan,
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Pengajuan layanan berhasil disubmit! Kami akan memprosesnya segera.');
    }
}
