<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnnouncementController extends Controller
{
    public function getAnnouncements($offset = 0, $limit = 10){
        $announcements = DB::table('announcements')->orderBy('updated_at', 'desc')->skip($offset)->take($limit)->get();

        return $announcements;
    }

    public function getAnnouncement($id){
        return DB::table('announcements')->where('id', $id)->first();
    }

    public function getAnnouncementJSON($id){
        $announcement = $this->getAnnouncement($id);

        return response()->json($announcement);
    }

    public function addAnnouncement(Request $request){
        DB::table('announcements')->insert([
            'title' => $request->title,
            'content' => $request->content,
            'updated_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),
            'user_id' => $request->user()->id
        ]);
    }

    public function updateAnnouncement(Request $request){
        DB::table('announcements')
                                ->where('id', $request->id)
                                ->update([
                                    'title' => $request->title,
                                    'content' => $request->content,
                                    'updated_at' => date("Y-m-d H:i:s"),
                                ]);
    }

    public function removeAnnouncement(Request $request){
        DB::table('announcements')->where('id', $request->id)->delete();
    }

    public function announcementsFormAction(Request $request){
        if($request->action == "add"){
            $this->addAnnouncement($request);
        }
        else if($request->action == "update"){
            $this->updateAnnouncement($request);
        }
        else if($request->action == "remove"){
            $this->removeAnnouncement($request);
        }

        return redirect('/announcements');
    }

    public function adminAnnouncementsView(){
        $announcements = $this->getAnnouncements(0, 10);

        foreach($announcements as $announcement){
            $announcement->sample = substr($announcement->content, 0, 100);
        }

        return view('admin.announcements')->with(compact('announcements'));
    }

    public function announcementView($announcementID){
        $announcement = $this->getAnnouncement($announcementID);

        return view('announcement', compact('announcement'));
    }

    public function announcementListView($pageNum = 0){
        $offset = $pageNum * 10;
        $announcements = $this->getAnnouncements($offset);

        foreach($announcements as $announcement){
            $announcement->sample = substr($announcement->content, 0, 500);
        }
        
        return view('announcements')->with(compact('announcements'))->with(compact('pageNum'));
    }
}
