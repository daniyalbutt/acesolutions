<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectFile extends Model
{
    protected $fillable = ['project_id', 'uploaded_by', 'file', 'admin_file'];

    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
    
}
