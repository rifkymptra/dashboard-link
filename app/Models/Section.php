<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_name',
        'description'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function links()
    {
        return $this->hasMany(Link::class);
    }
}
