<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use PDF;

class PDFExportsController extends Controller
{
    public function exportStudents($type = 'all', $id = null){
        
        $students = User::enrolledStudents($type, $id);

        //download pdf, uncomment if want to view instead of downloading
        // $pdf = PDF::loadView('PDFExport/students', [
        //     'students' => $students,
        // ]);
        // return $pdf->download('Students.pdf');
        
        return view('PDFExport/students', [
            'students' => $students,
        ]);
    }
}
