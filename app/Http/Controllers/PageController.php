<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{

    public function index() {
        return view('home');
    }

    public function about() {
        return view('about');
    }

    public function service() {
        return view('service');
    }

    public function schedule() {
    // 1. Membuat data dummy array multidimensi
    $jadwalBus = [
        ['id' => 'B01', 'rute' => 'Gedung Rektorat - Fakultas Teknik', 'status' => 'Beroperasi'],
        ['id' => 'B02', 'rute' => 'Asrama Mahasiswa - Perpustakaan', 'status' => 'Maintenance'],
        ['id' => 'B03', 'rute' => 'Stasiun MRT - Gerbang Utama', 'status' => 'Beroperasi'],
    ];

    // 2. Mengirim data ke View 'schedule.blade.php' menggunakan compact
    return view('schedule', compact('jadwalBus'));
}

public function schedule_master()
    {
        $title = 'Jadwal Bus Kampus';
        $jadwalBus = [
            ['id' => 'B01', 'rute' => 'Gedung Rektorat - Fakultas Teknik', 'status' => 'Beroperasi'],
            ['id' => 'B02', 'rute' => 'Asrama Mahasiswa - Perpustakaan', 'status' => 'Maintenance'],
            ['id' => 'B03', 'rute' => 'Stasiun MRT - Gerbang Utama', 'status' => 'Beroperasi'],
        ];
        $content = view('schedule', compact('jadwalBus'))->render();

        return view('layouts.master', compact('title', 'content'));
    }
}
