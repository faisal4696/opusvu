<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

//    protected $fillable = [
//        'category_id',
//        'title',
//        'description',
//        'thumbnail',
//        'attachment',
//    ];

    protected $guarded = [
        'id','_token'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function promotionVideo()
    {
        return $this->hasMany(Promotion::class,'video_id');
    }

    public function favouriteVideo()
    {
        return $this->hasMany(FavouriteVideo::class);
    }

    public function getVideos($id=null)
    {
        if($id == null){
            $query = Video::all();
            return $query;
        }else{
            $query = Video::where('id',$id)->first();
            return $query;
        }
    }

    public function deleteVideo($id)
    {
        $video = Video::find($id);
        $query = $video->delete();
        return $query;
    }
}
