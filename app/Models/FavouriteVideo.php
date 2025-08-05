<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavouriteVideo extends Model
{
    use HasFactory;

//    protected $fillable = [
//        'user_id',
//        'video_id',
//    ];

    protected $guarded = [
        'id','_token'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function addFavouriteVideo($data)
    {
        $query = FavouriteVideo::create($data);
        return $query;
    }

    public function deleteFavourite($id)
    {
        $video = FavouriteVideo::find($id);
        $query = $video->delete();
        return $query;
    }
}
