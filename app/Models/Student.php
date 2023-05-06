<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $primaryKey = 'IDno';

    protected $fillable = [
        'IDno',
        'name',
        'age',
    ];

    public function track()
    {
        return $this->belongsTo(Track::class, 'track_id');
    }
}
