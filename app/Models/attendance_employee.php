<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class attendance_employee extends Model
{
    use CrudTrait;
    
    protected $table = 'employee_attendance';
    protected $fillable = ['employee_id','attendance_id','created_at','updated_at'];
}
