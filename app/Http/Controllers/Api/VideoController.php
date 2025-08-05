<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FavouriteVideo;
use App\Models\Video;
use App\Models\Promotion;
use Carbon\Carbon;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class VideoController extends Controller
{
    private $category;
    private $video;
    private $favouriteVideo;
    private $promotionVideo;

    public function __construct(Category $category,Video $video,FavouriteVideo $favouriteVideo, Promotion $promotionVideo)
    {
        $this->category = $category;
        $this->video = $video;
        $this->favouriteVideo = $favouriteVideo;
        $this->promotionVideo = $promotionVideo;
    }

    public function getCategories()
    {
        $app = app();
        $laravel_object = $app->make('stdClass');
        $laravel_object->id = null;
        $laravel_object->name = 'All';
        $laravel_object->name_spanish = 'Todas';
        $laravel_object->name_french = 'Toute';
        $laravel_object->created_at = null;
        $laravel_object->updated_at = null;
//        $laravel_object->created_at = Carbon::now();
//        $laravel_object->updated_at = Carbon::now();
        $arr[] = $laravel_object;
        $categories = $this->category->getCategories();
        foreach($categories as $val){
            array_push($arr,$val);
        }
        return response()->json(['status'=>true,'response'=>$arr,'message'=>'Get All Categories Successfully']);
    }

    public function favouriteVideos(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'video_id'=>'required',
        ]);
        if($validator->fails()){
            return response()->json(['status'=>false,'message'=>$validator->errors()->first()]);
        }else{
            $checkFav = $this->favouriteVideo->where('user_id',Auth::user()->id)->where('video_id',$request->video_id)->first();
            if($checkFav == null){
                $data = [];
                $data['user_id'] = Auth::user()->id;
                $data['video_id'] = $request->video_id;
                $addFavourite = $this->favouriteVideo->addFavouriteVideo($data);
                if($addFavourite){
                    return response()->json(['status'=>true,'response'=>$addFavourite,'message'=>'Video Favourite Successfully']);
                }else{
                    return response()->json(['status'=>false,'message'=>'Something Error in Add Favourite Video Try Again Later']);
                }
            }else{
                $unFavourite = $this->favouriteVideo->deleteFavourite($checkFav->id);
                if($unFavourite){
                    return response()->json(['status'=>true,'message'=>'Video UnFavourite Successfully']);
                }else{
                    return response()->json(['status'=>false,'message'=>'Something Error in UnFavourite Video Try Again Later']);
                }
            }
        }
    }

    public function getFavouriteVideos()
    {
        $favouriteVideos = $this->favouriteVideo->where('user_id',Auth::user()->id)->with('video')->get();
        foreach ($favouriteVideos as $val) {
            $val->video['favourite'] = true;
        }
        return response()->json(['status'=>true,'response'=>$favouriteVideos,'message'=>'Fetch Favourite Videos Successfully']);
    }

    public function getVideos($id=null)
    {
        $category_id = $id;
        if($category_id == null){
            $mostFav = [];
            $arr = [];
            $final = [];
            $latestVideos = $this->video->orderBy('created_at','DESC')->limit(5)->get();
            foreach($latestVideos as $val1){
                $checkFav = $this->favouriteVideo->where('video_id',$val1->id)->where('user_id',Auth::user()->id)->first();
                if($checkFav){
                    $val1['favourite'] = true;
                }else{
                    $val1['favourite'] = false;
                }
            }
            $final['latest_videos'] = $latestVideos;
            $videos = $this->video->get();
            foreach ($videos as $val) {
                $fav_video = $this->favouriteVideo->where('video_id',$val->id)->get();
                $arr['id'] = $val->id;
                $arr['category_id'] = $val->category_id;
                $arr['title'] = $val->title;
                $arr['description'] = $val->description;
                $arr['thumbnail'] = $val->thumbnail;
                $arr['attachment'] = $val->attachment;
                $arr['subtitle_english'] = $val->subtitle_english;
                $arr['subtitle_spanish'] = $val->subtitle_spanish;
                $arr['subtitle_french'] = $val->subtitle_french;
                $arr['duration'] = $val->duration;
                $arr['created_at'] = $val->created_at;
                $arr['updated_at'] = $val->updated_at;
                $checkFav1 = $this->favouriteVideo->where('video_id',$val->id)->where('user_id',Auth::user()->id)->first();
                if($checkFav1){
                    $arr['favourite'] = true;
                }else{
                    $arr['favourite'] = false;
                }
                if($fav_video != '[]') {
                    $arr['video_count'] = count($fav_video);
                }else{
                    $arr['video_count'] = 0;
                }
                array_push($mostFav,$arr);
//                if($arr['video_count'] > 0){
//                    array_push($mostFav,$arr);
//                }
                $arr = [];
            }
            if($mostFav){
                foreach ($mostFav as $key => $row)
                {
                    $video_count[$key] = $row['video_count'];
                }

                array_multisort($video_count, SORT_DESC, $mostFav);
                $final['most_fav_videos'] = array_slice($mostFav, 0, 5);
                return response()->json(['status'=>true,'response'=>$final,'message'=>'Record Fetch Successfully']);
            }else{
                $final['most_fav_videos'] = [];
                return response()->json(['status'=>false,'response'=>$final,'message'=>'empty']);
            }
        }else{
            $videos = $this->video->where('category_id',$category_id)->paginate('8');
            foreach ($videos as $val2) {
                $checkFav2 = $this->favouriteVideo->where('video_id',$val2->id)->where('user_id',Auth::user()->id)->first();
                if($checkFav2){
                    $val2['favourite'] = true;
                }else{
                    $val2['favourite'] = false;
                }
            }
            return response()->json(['status'=>true,'response'=>$videos,'message'=>'Record Fetch Successfully']);
        }
    }

    public function getMoreVideos()
    {
        $moreVideos = $this->video->paginate('8');
        foreach ($moreVideos as $val) {
            $checkFav = $this->favouriteVideo->where('video_id',$val->id)->where('user_id',Auth::user()->id)->first();
            if($checkFav){
                $val['favourite'] = true;
            }else{
                $val['favourite'] = false;
            }
        }
        if($moreVideos != '[]'){
            return response()->json(['status'=>true,'response'=>$moreVideos,'message'=>'More Videos Fetch Successfully']);
        }else{
            return response()->json(['status'=>false,'message'=>'empty']);
        }
    }

    public function searchVideo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'=>'required',
        ]);
        if($validator->fails()){
            return response()->json(['status'=>false,'message'=>$validator->errors()->first()]);
        }else{
            $videos = $this->video->where('title','like','%'.$request->title.'%')->get();
            if(!$videos->isEmpty()){
                return response()->json(['status'=>true,'response'=>$videos,'message'=>'Search Videos Successfully']);
            }else{
                return response()->json(['status'=>false,'message'=>'Empty']);
            }
        }
    }

    public function allLatestVideos()
    {
        $to = Carbon::now();
        $from = Carbon::now()->subDays(2);
        $latestVideos = $this->video->whereBetween('created_at', [$from, $to])->orderBy('created_at','DESC')->paginate(8);
        foreach ($latestVideos as $val){
            $checkFav = $this->favouriteVideo->where('video_id',$val->id)->where('user_id',Auth::user()->id)->first();
            if($checkFav){
                $val['favourite'] = true;
            }else{
                $val['favourite'] = false;
            }
        }
        return response()->json(['status'=>true,'response'=>$latestVideos,'message'=>'Latest Videos Fetch Successfully']);
    }

    public function mostLikeVideos()
    {
        $arr = [];
        $mostFav = [];
        $final = [];
        $videos = $this->video->get();
        foreach ($videos as $val) {
            $fav_video = $this->favouriteVideo->where('video_id',$val->id)->get();
            $arr['id'] = $val->id;
            $arr['category_id'] = $val->category_id;
            $arr['title'] = $val->title;
            $arr['description'] = $val->description;
            $arr['thumbnail'] = $val->thumbnail;
            $arr['attachment'] = $val->attachment;
            $arr['duration'] = $val->duration;
            $arr['created_at'] = $val->created_at;
            $arr['updated_at'] = $val->updated_at;
            $checkFav1 = $this->favouriteVideo->where('video_id',$val->id)->where('user_id',Auth::user()->id)->first();
            if($checkFav1){
                $arr['favourite'] = true;
            }else{
                $arr['favourite'] = false;
            }
            if($fav_video != '[]') {
                $arr['video_count'] = count($fav_video);
            }else{
                $arr['video_count'] = 0;
            }
            array_push($mostFav,$arr);
//            if($arr['video_count'] > 0){
//                array_push($mostFav,$arr);
//            }
            $arr = [];
        }
        foreach ($mostFav as $key => $row)
        {
            $video_count[$key] = $row['video_count'];
        }
        array_multisort($video_count, SORT_DESC, $mostFav);
        foreach ($mostFav as $fav) {
            if($fav['video_count'] > 0){
                array_push($final, $fav);
            }
        }
        if($final != '[]'){
            $data = $this->paginate($final);
            return response()->json(['status'=>true,'response'=>$data,'message'=>'Most Like Videos Fetch Successfully']);
        }else{
            return response()->json(['status'=>false,'message'=>'empty']);
        }
    }

    public function bannerVideos()
    {
        $arr = [];
        $arr1 = [];
        // $final = [];
        $categories = $this->category->all();
        foreach ($categories as $key => $category) {
            $videos = $this->video->where('category_id',$category->id)->withCount('favouriteVideo')->get();
            foreach ($videos as $key => $video) {
                if($video['favourite_video_count'] > 0){
                    array_push($arr, $video);
                }
            }
        }
        if(!empty($arr)){
            $sortedScores = Arr::sort($arr, function($val)
            {
                return $val->category_id;
            });
            foreach ($sortedScores as $key => $ar)
            {
                if($key > 0)
                {
                    if($sortedScores[$key-1]['category_id'] == $sortedScores[$key]['category_id']){
                        if($sortedScores[$key-1]['favourite_video_count']<$sortedScores[$key]['favourite_video_count'])
                        {
                            $sortedScores[$key-1]['id'] = $sortedScores[$key]['id'];
                            $sortedScores[$key-1]['title'] = $sortedScores[$key]['title'];
                            $sortedScores[$key-1]['description'] = $sortedScores[$key]['description'];
                            $sortedScores[$key-1]['thumbnail'] = $sortedScores[$key]['thumbnail'];
                            $sortedScores[$key-1]['attachment'] = $sortedScores[$key]['attachment'];
                            $sortedScores[$key-1]['duration'] = $sortedScores[$key]['duration'];
                            $sortedScores[$key-1]['created_at'] = $sortedScores[$key]['created_at'];
                            $sortedScores[$key-1]['updated_at'] = $sortedScores[$key]['updated_at'];
                            $sortedScores[$key-1]['favourite_video_count'] = $sortedScores[$key]['favourite_video_count'];
                        }
                    }else {
                        array_push($arr1, $ar);
                    }
                }else {
                    array_push($arr1, $ar);
                }
            }
            foreach ($arr1 as $key => $row)
            {
                $fav_count[$key] = $row['favourite_video_count'];
            }
            array_multisort($fav_count, SORT_DESC, $arr1);
            $final = array_slice($arr1, 0, 3);
            foreach ($final as $val){
                $fav = $this->favouriteVideo->where('user_id',Auth::user()->id)->where('video_id',$val->id)->first();
                if($fav){
                    $val['favourite'] = true;
                }else{
                    $val['favourite'] = false;
                }
            }
            return response()->json(['status'=>true,'response'=>$final,'message'=>'Banner Videos Fetch Successfully']);
        }else{
            return response()->json(['status'=>false,'response'=>$arr,'message'=>'empty']);
        }
    }

    public function promotionVideo()
    {
        $promotionVideo = $this->promotionVideo->with('video')->first();
        return response()->json(['status'=>true,'response'=>$promotionVideo,'message'=>'Promotion Video Fetch Successfully']);
    }

    public function DeDupeArrayOfObjectsByProps($objects, $props) {
        if (empty($objects) || empty($props))
            return $objects;
        $results = array();
        foreach ($objects as $object) {
            $matched = false;
            foreach ($results as $result) {
                $matchs = 0;
                foreach ($props as $prop) {
                    if ($object->$prop == $result->$prop)
                        $matchs++;
                }
                if ($matchs == count($props)) {
                    $matched = true;
                    break;
                }

            }
            if (!$matched)
                $results[] = $object;
        }
        return $results;
    }

    public function paginate($items,$perPage=8)
    {
        $pageStart = \Request::get('page', 1);
        // Start displaying items from this number;
        $offSet = ($pageStart * $perPage) - $perPage;

        // Get only the items you need using array_slice
        $itemsForCurrentPage = array_slice($items, $offSet, $perPage, false);

        return new LengthAwarePaginator($itemsForCurrentPage, count($items), $perPage,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
    }
}
