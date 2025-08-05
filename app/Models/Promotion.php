<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $guarded = [
        'id','_token'
    ];

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
