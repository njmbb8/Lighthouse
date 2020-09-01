<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use FFMpeg;

require '../vendor/autoload.php';

class VideoController extends Controller
{
    public function videoView(){
        $videos = DB::table('videos')->orderBy('created_at', 'desc')->get();

        return view('admin.video', compact('videos'));
    }

    public function videoPageView($pageNum = 0){
        $videos = $this->getVideoRange($pageNum);

        return view('videos', compact('videos'));
    }

    public function getVideos(){

    }

    public function getVideoRange($offset = 0, $limit =10){
        return DB::table('videos')->orderBy('updated_at', 'desc')->skip($offset)->take($limit)->get();
    }

    public function getVideo($id){
        $ret = DB::table('videos')->where('id', $id)->first();

        return response()->json($ret);
    }

    public function uploadVideo(Request $request){
        $highID = DB::table('videos')->select('id')->orderBy('id', 'desc')->first();
        if(!isset($highID)){
            $highID = 0;
        }
        else{
            $highID = $highID->id;
        }
        $currID = $highID + 1;
        $dir = '/public/videos/'.$currID;
        $savePath = '';
        $filename = '';
        if($request->hasFile('videoUpload')){
            Storage::makeDirectory($dir);
            $path = $request->file('videoUpload')->store($dir);
            if(Storage::exists($path)){
                $realPath = preg_replace('/\/public/m', '/public/storage', base_path($path));
                $dirNames = explode('/', $realPath);
                for($i = 0; $i < count($dirNames)-1; $i++){
                    $savePath = $savePath . ($i > 0 ? '/' : '') . $dirNames[$i];
                }

                $ffmpeg = FFMpeg\FFMpeg::create(array(
                    'ffmpeg.binaries'  => '/usr/bin/ffmpeg',
                    'ffprobe.binaries' => '/usr/bin/ffprobe',
                    'timeout'          => 3600, // The timeout for the underlying process
                    'ffmpeg.threads'   => 12,   // The number of threads that FFMpeg should use
                ));

                $filename = explode('/', $realPath);
                $filename = $filename[count($filename)-1];

                $video = $ffmpeg->open($realPath);
                $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(10))->save($savePath.'/thumbnail.jpg');
            }
        }

        DB::table('videos')->insert([
            "title" => $request->title,
            "about" => $request->about,
            "filename" => $filename,
            'updated_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),
            'uploader' => $request->user()->id,
            'thumbnail' => '/storage/videos/'.$currID.'/thumbnail.jpg'
        ]);
    }

    public function updateVideo(Request $request){
        DB::table('videos')->where('id', $request->id)->update([
            "title" => $request->title,
            "about" => $request->about,
            "updated_at" => date("Y-m-d H:i:s")
        ]);
    }

    public function removeVideo(Request $request){
        DB::table('forms')->where('id', $request->id)->remove();
    }

    public function videoAction(Request $request){
        if($request->action == "add"){
            $this->uploadVideo($request);
        }
        else if($request->action == "update"){
            $this->updateVideo($request);
        }
        else if($request->action == "remove"){
            $this->removeVideo($request);
        }
        return redirect('/videos');
    }
}
