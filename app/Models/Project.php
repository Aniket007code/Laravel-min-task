<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use function Laravel\Prompts\table;

class Project extends Model
{
    protected $fillable = ['project_title', 'description', 'start_date', 'end_date', 'image', 'timeline'];
}
