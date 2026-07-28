<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LayananRequest;
use App\Models\Pengaduan;

class AdminController extends Controller
{
    public function index()
    {
        $layanans = LayananRequest::orderBy('created_at', 'desc')->get();
        $pengaduans = Pengaduan::orderBy('created_at', 'desc')->get();
        
        return view('admin.dashboard', compact('layanans', 'pengaduans'));
    }
}
