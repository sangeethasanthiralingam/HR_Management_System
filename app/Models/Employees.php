<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    public function position()
    {
        return $this->belongsTo(Positions::class, 'position');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    use HasFactory;
}
