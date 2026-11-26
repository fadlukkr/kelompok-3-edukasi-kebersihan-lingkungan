<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function exportPdf()
    {
        // Data sementara untuk pengujian
        $data = [];

        $pdf = Pdf::loadView('view_pdf', [
            'data' => $data
        ]);

        return $pdf->download('laporan-ecolearn.pdf');
    }
}