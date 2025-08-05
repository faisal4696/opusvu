<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;
use Session;
use Storage;
use URL;
use Validator;
use FFMpeg;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
use Carbon\Carbon;

class VideoController extends Controller
{
    private $video;
    private $category;

    public function __construct(Video $video, Category $category)
    {
        $this->video = $video;
        $this->category = $category;
    }

    public function viewVideos()
    {
        $videos = $this->video->with('category')->paginate(8);
        $categories = $this->category->getCategories();
        return view('admin.view-videos', compact('videos','categories'));
    }

    public function addVideoView()
    {
        $categories = $this->category->getCategories();
        return view('admin.add-video', compact('categories'));
    }

    public function addVideo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'title' => 'required',
            'title_spanish' => 'required',
            'title_french' => 'required',
            'attachment' => 'required|mimes:mp4,ogg',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
            'description_spanish' => 'required',
            'description_french' => 'required',
        ]);
        $filename = time() . '-' . $request->file('attachment')->getClientOriginalName();
        Storage::disk('attachment')->put($filename, file_get_contents($request->file('attachment')->getRealPath()));

        $thumbnail_name = time() . '-' . $request->file('thumbnail')->getClientOriginalName();
        Storage::disk('thumbnails')->put($thumbnail_name, file_get_contents($request->file('thumbnail')->getRealPath()));

//        $thumbnail_name = 'thumbnail-'.rand().'.png';
//        $ffmpeg = FFMpeg::fromDisk('attachment')
//            ->open($filename)
//            ->getFrameFromSeconds(2)
//            ->export()
//            ->toDisk('thumbnails')
//            ->save($thumbnail_name);
//        $getDuration = FFMpeg::fromDisk('attachment')->open($filename)->getDurationInSeconds();
//        $videoDuration = gmdate("H:i:s", $getDuration);
//        if ($ffmpeg) {
            $video = [];
            $video['category_id'] = $request->category_id;
            $video['title'] = $request->title;
            $video['title_spanish'] = $request->title_spanish;
            $video['title_french'] = $request->title_french;
            $video['attachment'] = 'uploads/videos/'.$filename;
            $video['description'] = $request->description;
            $video['description_spanish'] = $request->description_spanish;
            $video['description_french'] = $request->description_french;
            $video['thumbnail'] = 'uploads/thumbnails/'.$thumbnail_name;
            $video['duration'] = '00:00:00';/*$videoDuration*/;
            $createVideo = $this->video->create($video);
            if ($createVideo) {
                Session::flash('success', 'Video Upload Successfully');
                return back();
            } else {
                Session::flash('error', 'Something Error Try Again Later');
                return back();
            }
//        } else {
//            Session::flash('error', 'Error in Thumbnail Creation');
//            return back();
//        }
    }

    public function deleteVideo($id)
    {
        $video = $this->video->deleteVideo($id);
        if ($video) {
            Session::flash('success', 'Video Delete Successfully');
            return back();
        } else {
            Session::flash('error', 'Failed Try Again Later');
            return back();
        }
    }

    public function editVideo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attachment' => 'mimes:mp4,ogg',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'subtitle_eng' => 'mimes:vtt',
            'subtitle_spanish' => 'mimes:vtt',
            'subtitle_french' => 'mimes:vtt',
        ]);
        $video = $this->video->getVideos($request->video_id);
        if($request->hasFile('attachment')){
            $filename = time() . '-' . $request->file('attachment')->getClientOriginalName();
            Storage::disk('attachment')->put($filename, file_get_contents($request->file('attachment')->getRealPath()));

//            $thumbnail_name = 'thumbnail-'.rand().'.png';
//            $ffmpeg = FFMpeg::fromDisk('attachment')
//                ->open($filename)
//                ->getFrameFromSeconds(2)
//                ->export()
//                ->toDisk('thumbnails')
//                ->save($thumbnail_name);
//            $getDuration = FFMpeg::fromDisk('attachment')->open($filename)->getDurationInSeconds();
//            $videoDuration = gmdate("H:i:s", $getDuration);
            $video['attachment'] = 'uploads/videos/'.$filename;
//            $video['thumbnail'] = 'uploads/thumbnails/'.$thumbnail_name;
            $video['duration'] = '00:00:00';/*$videoDuration*/;
        }
        if($request->hasFile('thumbnail')){
            $thumbnail_name = time() . '-' . $request->file('thumbnail')->getClientOriginalName();
            Storage::disk('thumbnails')->put($thumbnail_name, file_get_contents($request->file('thumbnail')->getRealPath()));
            $video['thumbnail'] = 'uploads/thumbnails/'.$thumbnail_name;
        }
        if($request->hasFile('subtitle_eng')){
            $subtitle_eng = $request->file('subtitle_eng');
            $sub_eng_name  = $subtitle_eng->getClientOriginalName();
            Storage::disk('subtitles')->put($sub_eng_name, file_get_contents($request->file('subtitle_eng')->getRealPath()));
            $video['subtitle_english'] = 'uploads/subtitles/'.$sub_eng_name;
        }
        if($request->hasFile('subtitle_spanish')){
            $subtitle_spanish = $request->file('subtitle_spanish');
            $sub_spanish_name  = $subtitle_spanish->getClientOriginalName();
            Storage::disk('subtitles')->put($sub_spanish_name, file_get_contents($request->file('subtitle_spanish')->getRealPath()));
            $video['subtitle_spanish'] = 'uploads/subtitles/'.$sub_spanish_name;
        }
        if($request->hasFile('subtitle_french')){
            $subtitle_french = $request->file('subtitle_french');
            $sub_french_name  = $subtitle_french->getClientOriginalName();
            Storage::disk('subtitles')->put($sub_french_name, file_get_contents($request->file('subtitle_french')->getRealPath()));
            $video['subtitle_french'] = 'uploads/subtitles/'.$sub_french_name;
        }
        if($request->category_id != null){
            $video['category_id'] = $request->category_id;
        }
        if($request->title != null){
            $video['title'] = $request->title;
        }
        if($request->title_spanish != null){
            $video['title_spanish'] = $request->title_spanish;
        }
        if($request->title_french != null){
            $video['title_french'] = $request->title_french;
        }
        if($request->description != null){
            $video['description'] = $request->description;
        }
        if($request->description_spanish != null){
            $video['description_spanish'] = $request->description_spanish;
        }
        if($request->description_french != null){
            $video['description_french'] = $request->description_french;
        }
        $save = $video->save();
        if($save){
            Session::flash('success','Video Update Successfully');
            return back();
        }else{
            Session::flash('error','Failed Try Again Later');
            return back();
        }
    }
}
