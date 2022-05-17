<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    
    public function index(Request $request, $uploadTo)
    {

        $exploded = explode(',', $request->image);

        $decoded = base64_decode($exploded[1]);
        if(str_contains($exploded[0], 'jpeg')){
            $extension = 'jpg';
        }
        else if(str_contains($exploded[0], 'pdf')){
            $extension = 'pdf';
        }
        else{
            $extension = 'png';
        }

        $fileName = rand() . '.' . $extension;

        $path = public_path() . '/images/' . $uploadTo . '/' . $fileName;

        file_put_contents($path, $decoded);

        if($uploadTo == 'StudentImage'){
            $user = User::find($request->id);
            $user->image = $fileName;
            $user->save();
        }

        if($uploadTo == 'studentPSA'){
            $user = User::find($request->id);
            $user->birthcertificate = $fileName;
            $user->save();
        }

        if($uploadTo == 'studentGoodMoral'){
            $user = User::find($request->id);
            $user->goodmoral = $fileName;
            $user->save();
        }

        if($uploadTo == 'studentReportCard'){
            $user = User::find($request->id);
            $user->reportCard = $fileName;
            $user->save();
        }

        return $fileName;
    }
}
