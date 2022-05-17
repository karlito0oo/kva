<?php

namespace App;

use App\Level;
use App\Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'description', 'prerequisite_id', 'registration', 'tuition', 'insurance', 'library', 'science', 'computer', 'athletics', 'misc', 'books', 'school_uniform', 'pe_uniform',
    ];

    protected $appends = ['totalFees'];
    
    public function prerequisite()
    {
        return $this->hasOne('App\Level', 'id', 'prerequisite_id');
    }

    public static function activeLevel(){
        $schoolyear_id = Setting::first()->schoolyear_id;

        return Level::select('levels.*')
            ->join('enrollments', 'enrollments.level_id', 'levels.id')
            ->where('enrollments.schoolyear_id', $schoolyear_id)
            ->where('enrollments.status', 'Enrolled')
            ->distinct()
            ->orderByRaw('LENGTH(name)')
            ->orderBy('name')
            ->get();
    }

    public function getTotalFeesAttribute(){
        $total = $this->registration + $this->tuition + $this->insurance + $this->library + $this->science + $this->computer + $this->athletics + $this->misc + $this->books + $this->school_uniform + $this->pe_uniform;
        return number_format($total, 2);
    }
}
