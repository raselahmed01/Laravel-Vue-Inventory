<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        
        'emp_name', 'emp_email', 'emp_phone','emp_salary','emp_address','emp_nid','emp_join_date','emp_photo'
    ];
}
