<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    protected $fillable = [
        'section_id',
        'link_name',
        'url',
        'vpn',
        'description_link',
        'submitted_by',
        'approved_by',
        'status',
        'note',
        'instansi',
    ];

    public function sectionId()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
