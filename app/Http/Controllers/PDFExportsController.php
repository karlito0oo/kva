<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Setting;
use App\SchoolYear;
use PDF;

class PDFExportsController extends Controller
{
    public function exportStudents($type = 'all', $id = null, $preview = 0){
        
        $students = User::enrolledStudents($type, $id);
        if($type == 'all'){
            $students = User::allStudents();
        }
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

    public function exportStudentGoodMoral($id = null, $requestor = null, $preview = 0){
        
        $student = User::find($id);
        $SY = SchoolYear::find(Setting::first()->schoolyear_id);
        //preview
        if ($preview){
            return view('PDFExport/studentGoodMoral', [
                'student' => $student,
                'requestor' => $requestor,
                'SY' => $SY,
            ]);
        }
        //download pdf
        $pdf = PDF::loadView('PDFExport/studentGoodMoral', [
            'student' => $student,
            'requestor' => $requestor,
            'SY' => $SY,
        ]);
        return $pdf->download($student->name . ' ' . $student->lname . ' - Good Moral.pdf');
    }

    public function exportStudentRegForm($id = null, $preview = 0){
        
        $student = User::find($id);
        $SY = SchoolYear::find(Setting::first()->schoolyear_id);
        //preview
        if ($preview){
            return view('PDFExport/studentRegForm', [
                'student' => $student,
                'SY' => $SY,
                'subjects' => User::enrolledSubjects($student->currentEnrollment->id),
            ]);
        }
        //download pdf
        $pdf = PDF::loadView('PDFExport/studentRegForm', [
            'student' => $student,
            'SY' => $SY,
            'subjects' => User::enrolledSubjects($student->currentEnrollment->id),
        ]);
        return $pdf->download($student->name . ' ' . $student->lname . ' - Registration Form.pdf');
    }
}
