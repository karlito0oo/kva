<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use PDF;

class PDFExportsController extends Controller
{
    public function exportStudents($type = 'all', $id = null, $preview = 0){
        
        $students = User::enrolledStudents($type, $id);
        //preview
        if ($preview){
            return view('PDFExport/students', [
                'students' => $students,
            ]);
        }
        //download pdf
        $pdf = PDF::loadView('PDFExport/students', [
            'students' => $students,
        ]);
        return $pdf->download('Students.pdf');
    }
}
