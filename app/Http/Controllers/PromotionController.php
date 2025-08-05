<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Promotion;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use App\Helpers\VideoStream;
use Validator;
use Illuminate\Support\Str;

class PromotionController extends Controller
{
    public function promotionView()
    {
        $videos = Video::all();
        $promotion = Promotion::first();
        return view('admin.video-promotion', compact('promotion','videos'));
    }

    public function addPromotionVideo(Request $request)
    {
        $this->validate($request, [
            'video_id'=>'required',
        ]);
        $formData = $request->all();
        $video = Video::find($formData['video_id']);
        $formData['video'] = $video->attachment;
        $formData['description'] = $video->description;
        $formData['description_spanish'] = $video->description_spanish;
        $formData['description_french'] = $video->description_french;
        if($formData['title'] == null)
        {
            $formData['title'] = $video->title;
        }
        if($formData['title_spanish'] == null)
        {
            $formData['title_spanish'] = $video->title_spanish;
        }
        if($formData['title_french'] == null)
        {
            $formData['title_french'] = $video->title_french;
        }
        if(!$formData['status'])
        {
            $formData['status'] = 'off';
        }
        if($request->hasFile('image'))
        {
            $filename = time() . '-' . $request->file('image')->getClientOriginalName();
            Storage::disk('thumbnails')->put($filename, file_get_contents($request->file('image')->getRealPath()));
           $formData['image'] = 'uploads/thumbnails/' . $filename;
        }else{
            $formData['image'] = $video->thumbnail;
        }
        $savePromotion = Promotion::create($formData);
        if($savePromotion){
            Session::flash('success', 'Promotion Video Add Successfully');
            return back();
        }else{
            Session::flash('error', 'Failed Try Again Later');
            return back();
        }
    }

    public function updatePromotion(Request $request)
    {
        $promotion = Promotion::find($request->promotion_id);
        if($request->video_id){
            $video = Video::find($request->video_id);
            $promotion->description = $video->description;
            $promotion->description_spanish = $video->description_spanish;
            $promotion->description_french = $video->description_french;
            $promotion->video = $video->attachment;
            $promotion->video_id = $video->id;
            $promotion->title = $video->title;
            $promotion->title_spanish = $video->title_spanish;
            $promotion->title_french = $video->title_french;
            $promotion->image = $video->thumbnail;

        }
        if ($request->status == 'on') {
            $promotion->status = 'on';
        } else {
            $promotion->status = 'off';
        }
        if ($request->title) {
            $promotion->title = $request->title;
        }
        if ($request->title_spanish) {
            $promotion->title_spanish = $request->title_spanish;
        }
        if ($request->title_french) {
            $promotion->title_french = $request->title_french;
        }
//        if ($request->description) {
//            $promotion->description = $request->description;
//        }
//        if ($request->description_spanish) {
//            $promotion->description_spanish = $request->description_spanish;
//        }
//        if ($request->description_french) {
//            $promotion->description_french = $request->description_french;
//        }
        if ($request->hasFile('image')) {
            $filename = time() . '-' . $request->file('image')->getClientOriginalName();
            Storage::disk('thumbnails')->put($filename, file_get_contents($request->file('image')->getRealPath()));
            $promotion->image = 'uploads/thumbnails/' . $filename;
        }
//        if ($request->hasFile('video')) {
//            $filename = time() . '-' . $request->file('video')->getClientOriginalName();
//            Storage::disk('attachment')->put($filename, file_get_contents($request->file('video')->getRealPath()));
//            $promotion->video = 'uploads/videos/' . $filename;
//        }
        $save = $promotion->save();
        if ($save) {
            Session::flash('success', 'Promotion Update Successfully');
            return back();
        } else {
            Session::flash('error', 'Failed Try Again Later');
            return back();
        }
    }

    public function videoTesting()
    {
        return view('admin.video-testing');
    }


    public function stream($filename)
    {
        $videosDir = public_path('uploads/videos/');
        if (file_exists($filePath = $videosDir."/".$filename)) {
            $stream = new VideoStream($filePath);
            return response()->stream(function() use ($stream) {
                $stream->start();
            });
        }
        return response("File doesn't exists", 404);
    }


    public function upload(Request $request) {
        if($request->video_id){
            // create the file receiver
            $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));
            // check if the upload is success
            if ($receiver->isUploaded()) {
                // receive the file
                $save = $receiver->receive();
                // check if the upload has finished (in chunk mode it will send smaller files)
                if ($save->isFinished()) {
                    // save the file and return any response you need
                    $fileObj        = $this->saveFile($save->getFile());
                    // $fileData       = json_decode($fileObj);
//                Log::useDailyFiles(storage_path().'/logs/upload.log');
//                Log::info($fileObj);

//                    $name           = $request->name;
//                    $ip             = $request->ip;
//                    $fileName       = $fileObj['file'];
//                    $fileType       = $fileObj['mime'];

//                    $image = $request->file('thumb');
//                    $filename  = time() . '.' . $image->getClientOriginalExtension();
//                    Storage::disk('thumbnails')->put($filename, file_get_contents($request->file('thumb')->getRealPath()));

                    $video = $request->file('file')->getClientOriginalName();
                    $videoObj   = Video::where('id',$request->video_id)->first();

                    //$thumbnail      = $this->getThumnail($fileName,$fileObj['path']);
                    // $duration       = $this->getDuration($fileObj['path']);

                    $videoObj->attachment             = 'uploads/videos/'.$video;
                    // $videoObj->thumbnail        = $thumbnail;
                    // $videoObj->image            = $path;
//                $videoObj->thumbnail        = $path;

                    $videoObj->save();

                    // return $this->saveFile($save->getFile());
                    return response()->json($fileObj);
                } else {
                    // we are in chunk mode, lets send the current progress
                    /** @var AbstractHandler $handler */
                    $handler = $save->handler();
                    return response()->json([
                        "done" => $handler->getPercentageDone(),
                    ]);
                }
            } else {
                throw new UploadMissingFileException();
            }
        }elseif($request->promotion_video_id) {

            // create the file receiver
            $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));
            // check if the upload is success
            if ($receiver->isUploaded()) {
                // receive the file
                $save = $receiver->receive();
                // check if the upload has finished (in chunk mode it will send smaller files)
                if ($save->isFinished()) {
                    // save the file and return any response you need
                    $fileObj        = $this->saveFile($save->getFile());
                    // $fileData       = json_decode($fileObj);
//                Log::useDailyFiles(storage_path().'/logs/upload.log');
//                Log::info($fileObj);

//                    $name           = $request->name;
//                    $ip             = $request->ip;
//                    $fileName       = $fileObj['file'];
//                    $fileType       = $fileObj['mime'];

//                    $image = $request->file('thumb');
//                    $filename  = time() . '.' . $image->getClientOriginalExtension();
//                    Storage::disk('thumbnails')->put($filename, file_get_contents($request->file('thumb')->getRealPath()));

                    $video = $request->file('file')->getClientOriginalName();
                    $videoObj   = Promotion::where('id',$request->promotion_video_id)->first();

                    //$thumbnail      = $this->getThumnail($fileName,$fileObj['path']);
                    // $duration       = $this->getDuration($fileObj['path']);

                    $videoObj->video             = 'uploads/videos/'.$video;
                    // $videoObj->thumbnail        = $thumbnail;
                    // $videoObj->image            = $path;
//                $videoObj->thumbnail        = $path;

                    $videoObj->save();

                    // return $this->saveFile($save->getFile());
                    return response()->json($fileObj);
                } else {
                    // we are in chunk mode, lets send the current progress
                    /** @var AbstractHandler $handler */
                    $handler = $save->handler();
                    return response()->json([
                        "done" => $handler->getPercentageDone(),
                    ]);
                }
            } else {
                throw new UploadMissingFileException();
            }

        }else{
            // create the file receiver
            $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));
            // check if the upload is success
            if ($receiver->isUploaded()) {
                // receive the file
                $save = $receiver->receive();
                // check if the upload has finished (in chunk mode it will send smaller files)
                if ($save->isFinished()) {
                    // save the file and return any response you need
                    $fileObj        = $this->saveFile($save->getFile());
                    // $fileData       = json_decode($fileObj);
//                Log::useDailyFiles(storage_path().'/logs/upload.log');
//                Log::info($fileObj);

                    $name           = $request->name;
                    $ip             = $request->ip;
                    $fileName       = $fileObj['file'];
                    $fileType       = $fileObj['mime'];

                    $image = $request->file('thumb');
                    $filename  = time() . '.' . $image->getClientOriginalExtension();
                    Storage::disk('thumbnails')->put($filename, file_get_contents($request->file('thumb')->getRealPath()));

                    $subtitle_eng = $request->file('subtitle_eng');
                    $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890');
                    $suffle = substr($random, 0, 5);
                    $sub_eng_name  = time() . $suffle . '.' .$subtitle_eng->getClientOriginalExtension();
                    Storage::disk('subtitles')->put($sub_eng_name, file_get_contents($request->file('subtitle_eng')->getRealPath()));

                    $subtitle_spanish = $request->file('subtitle_spanish');
                    $sub_spanish_name  = time() . $suffle . '.' . $subtitle_spanish->getClientOriginalExtension();
                    Storage::disk('subtitles')->put($sub_spanish_name, file_get_contents($request->file('subtitle_spanish')->getRealPath()));

                    $subtitle_french = $request->file('subtitle_french');
                    $sub_french_name  = time() . $suffle . '.' . $subtitle_french->getClientOriginalExtension();
                    Storage::disk('subtitles')->put($sub_french_name, file_get_contents($request->file('subtitle_french')->getRealPath()));

                    $video = $request->file('file')->getClientOriginalName();
                    $videoObj   = new Video();

                    //$thumbnail      = $this->getThumnail($fileName,$fileObj['path']);
                    // $duration       = $this->getDuration($fileObj['path']);
                    $videoObj->category_id            = $request->category_id;
                    $videoObj->title               = $request->title;
                    $videoObj->title_spanish       = $request->title_spanish;
                    $videoObj->title_french       = $request->title_french;
                    $videoObj->description      = $request->description;
                    $videoObj->description_spanish      = $request->description_spanish;
                    $videoObj->description_french      = $request->description_french;
                    $videoObj->attachment             = 'uploads/videos/'.$video;
                    $videoObj->thumbnail         = 'uploads/thumbnails/'.$filename;
                    $videoObj->subtitle_english         = 'uploads/subtitles/'.$sub_eng_name;
                    $videoObj->subtitle_spanish         = 'uploads/subtitles/'.$sub_spanish_name;
                    $videoObj->subtitle_french         = 'uploads/subtitles/'.$sub_french_name;
                    $videoObj->duration         = '00:00:00';
                    // $videoObj->thumbnail        = $thumbnail;
                    // $videoObj->image            = $path;
//                $videoObj->thumbnail        = $path;

                    $videoObj->save();

                    // return $this->saveFile($save->getFile());
                    return response()->json($fileObj);
                } else {
                    // we are in chunk mode, lets send the current progress
                    /** @var AbstractHandler $handler */
                    $handler = $save->handler();
                    return response()->json([
                        "done" => $handler->getPercentageDone(),
                    ]);
                }
            } else {
                throw new UploadMissingFileException();
            }
        }
    }

    public function editVideoView($id)
    {
        $video = Video::find($id);
        $categories = Category::all();
        return view('admin.edit-video',compact('video','categories'));
    }

    public function editPromotionVideoView($id)
    {
        $promotionVideo = Promotion::find($id);
        return view('admin.edit-promotion-video',compact('promotionVideo'));
    }

    private function saveFile(UploadedFile $file) {
        $fileName = $file->getClientOriginalName();//rename

        $path = public_path("uploads/videos");
        // move the file name
        $file->move($path, $fileName);

        $response   = [
            'path' => $path.'/'.$fileName,
            'file' => $fileName,
            'mime' => mime_content_type($path.'/'.$fileName),
        ];

        return $response;
    }

    private function getThumnail($fileName, $vedioFile)
    {

        $path = public_path("thumbs/");
        $fileName   = $fileName.'_thumb.jpg';

        $thumbnail_status = Thumbnail::getThumbnail($vedioFile,$path,$fileName,5);

        if($thumbnail_status){
            return $fileName;
        }
        else{
            return 'NULL';
        }

    }
}
