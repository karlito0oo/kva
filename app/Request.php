<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Request extends Model
{
    use SoftDeletes;

    protected $casts = [
        'created_at' => 'datetime:M d, Y H:i:s A',
        'updated_at' => 'datetime:Y-m-d',
        'deleted_at' => 'datetime:Y-m-d h:i:s'
     ];
    
    protected $appends = ['formatted_date'];

    public function users(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    
    public function getFormattedDateAttribute(){
        return "test";
    }
}
