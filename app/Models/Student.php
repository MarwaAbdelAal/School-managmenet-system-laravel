<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'IDno';

    protected $fillable = [
        'IDno',
        'name',
        'age',
        'user_id',
    ];

    public function track()
    {
        return $this->belongsTo(Track::class, 'track_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function scopeSearch($query, $val)
    {
        return $query
            ->where('name', 'like', '%' . $val . '%')
            ->orWhere('age', 'like', '%' . $val . '%');
    }
    public function scopeStartWithK($query)
    {
        return $query->where('name', 'like', 'K%');
    }
}
