<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignedProject extends Model
{
    protected $table = 'assigned_projects';
    protected $fillable = ['project_id', 'employee_id'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

}
