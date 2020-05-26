<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FormsController extends Controller
{

    public function getFormsRange($offset = 0, $limit = 10){
        return DB::table('forms')->orderBy('updated_at', 'desc')->skip($offset)->take($limit)->get();
    }

    public function addForm(Request $request){
        $highID = DB::table('forms')->select('id')->orderBy('id', 'desc')->first();
        $currID = $highID->id + 1;
        $dir = '/public/forms/'.$currID;
        $savePath = '';
        if($request->hasFile('formUpload')){
            Storage::makeDirectory($dir);
            $path = $request->file('formUpload')->store($dir);
            if(Storage::exists($path)){
                $realPath = preg_replace('/\/public/m', '/public/storage', base_path($path));
                $dirNames = explode('/', $realPath);
                for($i = 0; $i < count($dirNames)-1; $i++){
                    $savePath = $savePath . ($i > 0 ? '/' : '') . $dirNames[$i];
                }
                $file = new \Spatie\PdfToImage\Pdf($realPath);
                $file->saveImage($savePath.'/thumbnail.jpg');
            }
        }

        DB::table('forms')->insert([
            "title" => $request->title,
            "description" => $request->description,
            "path" => $path,
            'updated_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),
            'user_id' => $request->user()->id,
            'thumbnail' => '/storage/forms/'.$currID.'/thumbnail.jpg'
        ]);
    }

    public function updateForm(Request $request){
        $currID = $request->id;
        if($request->hasFile('formUpload')){
            $path = $request->file('formUpload')->store('/public/forms/'.$currID);
        }
        else{
            $path = $request->path;
        }

        DB::table('forms')->where('id', $request->id)->update([
            "title" => $request->title,
            "description" => $request->description,
            "path" => $path,
            'updated_at' => date("Y-m-d H:i:s"),
            'user_id' => $request->user()->id,
            'thumbnail' => $path.'/thumbnail.jpg'
        ]);
    }

    public function removeForm(Request $request){
        DB::table('forms')->where('id', $request->id)->remove();
    }

    public function getForm($id){
        $ret = DB::table('forms')->where('id', $id)->first();

        return response()->json($ret);
    }

    public function formAction(Request $request){
        if($request->action == "add"){
            $this->addForm($request);
        }
        else if($request->action == "update"){
            $this->updateForm($request);
        }
        else if($request->action == "remove"){
            $tihs->removeForm($request);
        }
        return redirect('/forms');
    }

    public function formView(Request $request){
        $forms = DB::table('forms')->orderBy('created_at', 'desc')->get();

        return view('admin.formupload', compact('forms'));
    }

    public function formsList($pageNum = 0){
        $offset = $pageNum * 10;

        $forms = $this->getFormsRange($offset);

        return view('forms')->with(compact('forms'))->with(compact('pageNum'));
    }
}
