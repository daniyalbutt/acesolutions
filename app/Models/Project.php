<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'company_name',
        'company_address',
        'name',
        'company_phone',
        'company_email',
        'description',
        'additional_notes',
        'file',
        'status',
        'user_id',
        'show_project',
        'remarks'
    ];

    public const STATUS = [
        0 => 'Pending',
        1 => 'In Progress',
        2 => 'Completed',
        3 => 'Rejected',
    ];

    public const STATUS_CLASS = [
        0 => 'bg-info',
        1 => 'bg-warning',
        2 => 'bg-success',
        3 => 'bg-danger',
    ];

    public function getStatusLabelAttribute()
    {
        return self::STATUS[$this->status] ?? 'Unknown';
    }

    public function getStatusClassAttribute()
    {
        return self::STATUS_CLASS[$this->status] ?? 'bg-secondary';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function files()
    {
        return $this->hasMany(ProjectFile::class);
    }

}
