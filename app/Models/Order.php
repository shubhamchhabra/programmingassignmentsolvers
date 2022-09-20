<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    //Requirement
    CONST EXECUTABLE_CODE = 'Executable Code';
    CONST WELL_COMMENTED_CODE = 'Well Commented Code';
    CONST EXECUTABLE_CODE_REPORT = 'Executable Code & Report';
    //Academic
    CONST UNDERGRADUATE = 'Undergraduate';
    CONST GRADUATE = 'Graduate';
    CONST MASTERS = 'Masters';
    CONST PHD = 'PhD';
    CONST ORDER_SUBMITTED = 'Order Submitted';
    CONST QUOTE_GIVEN = 'Quote Given';
    CONST ORDER_COMPLETED = 'Order Completed';

    protected $fillable = [
        'name', 'email', 'subject', 'subject_title', 'deadline', 'timezone', 'ref_code', 'requirement', 'academic', 'no_pages', 'assignment_file', 'description'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
