<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LayananRequest;

class LayananController extends Controller
{
    public function index()
    {
        return view('layanan');
    }

    public function form($type)
    {
        $validTypes = ['email', 'tte', 'pentest', 'ssl', 'csirt', 'awareness', 'konsultasi', 'jamming'];
        if (!in_array($type, $validTypes)) {
            abort(404);
        }
        return view("form-layanan", compact('type'));
    }

    public function submit(Request $request, $type)
    {
        $validTypes = ['email', 'tte', 'pentest', 'ssl', 'csirt', 'awareness', 'konsultasi', 'jamming'];
        if (!in_array($type, $validTypes)) {
            abort(404);
        }

        // Common validation mapping names from forms.js
        $rules = [
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'pangkat' => 'nullable|string|max:255',
            'opd' => 'required|string|max:255',
            'wa' => 'required|string|max:50',
            'surat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'persetujuan' => 'accepted'
        ];

        // Specific fields validation handled dynamically later if needed, but for now we accept all extra data
        $request->validate($rules);

        $path = null;
        if ($request->hasFile('surat')) {
            $path = $request->file('surat')->store('layanan', 'public');
        } elseif ($request->hasFile('bukti')) { // for csirt
            $path = $request->file('bukti')->store('layanan', 'public');
        }

        // Collect extra fields to save as JSON
        $commonFields = array_keys($rules);
        $commonFields[] = '_token';
        $commonFields[] = 'persetujuan';
        $commonFields[] = 'kebenaran';
        $commonFields[] = 'bukti';
        $extraData = $request->except($commonFields);

        LayananRequest::create([
            'jenis_layanan' => $type,
            'nama_lengkap' => $request->nama,
            'nip_nik' => $request->nip,
            'jabatan' => $request->jabatan,
            'pangkat_golongan' => $request->pangkat,
            'perangkat_daerah' => $request->opd,
            'no_wa' => $request->wa,
            'file_lampiran' => $path,
            'data_tambahan' => $extraData,
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Pengajuan layanan berhasil disubmit! Kami akan memprosesnya segera.');
    }
}
