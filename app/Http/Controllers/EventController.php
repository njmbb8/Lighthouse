<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function getEvents($offset = 0, $limit = 10){
        return DB::table('events')->orderBy('eventStart', 'desc')->skip($offset)->take($limit)->get();
    }
    
    public function getEventByID($eventID){
        $event = DB::table('events')->where('id', $eventID)->first();
        $event->dir = 'storage/events/' . $event->id;
        if(file_exists($event->dir)){
            $scanned_directory = array_diff(scandir($event->dir), array('..', '.'));
            $photoArray = [];
            foreach($scanned_directory as $photo){
                $photoArray[] = $photo;
            }
            $event->photos = $photoArray;
        }

        return $event;
    }

    public function newEvent(Request $request){

        $event = DB::table('events')->insertGetId([
            'name'=>$request->name,
            'about'=>$request->about,
            'location'=>$request->location,
            'eventStart'=>$request->eventStart,
            'eventEnd'=>$request->eventEnd,
            'user_id'=>$request->user()->id
        ]);

        
        if($request->hasFile('photos')){
            Storage::makeDirectory('public/events/' . $request->eventID);
            foreach($request->file('photos') as $photo){
                $photo->store('public/events/' . $request->eventID . '/');
            }
        }
    }

    public function updateEvent(Request $request){
        $eventID = $request->eventID;
        $name = $request->name;
        $about = $request->about;
        $location = $request->location;
        $eventStart = $request->eventStart;
        $eventEnd = $request->eventEnd;
        $directory = 'public/events/' . $request->eventID;

        if($request->hasFile('photos')){
            if(!is_dir($directory)){
                Storage::makeDirectory($directory);
            }
            foreach($request->file('photos') as $photo){
                $photo->store($directory);
            }
        }

        $removeFileNames = explode(" ", $request->removeImages);

        foreach($removeFileNames as $file){
            Storage::delete($directory . '/' . $file);
        }

        DB::table('events')
                ->where('id', $eventID)
                ->update(['name'=>$name, 
                            'about'=>$about,
                            'location'=>$location,
                            'eventStart'=>$eventStart,
                            'eventEnd'=>$eventEnd]);

        
    }

    public function deleteEvent(Request $request){
        DB::table('events')->where('id', $request->eventID)->delete();
        Storage::deleteDirectory('public/events/' . $request->eventID);
    }

    public function adminEventView(){
        $initEvents = $this->getEvents();

        return view('admin.events', compact('initEvents'));
    }

    public function paginateEvent($eventID){
        $event = $this->getEventByID($eventID);

        $event->eventStart = date('m/d/Y H:i', strtotime($event->eventStart));
        $event->eventEnd = date('m/d/Y H:i', strtotime($event->eventEnd));

        return view('event', compact('event'));
    }

    public function eventListView($pageNum = 0){
        $offset = $pageNum * 10;
        $events = $this->getEvents($offset);

        foreach($events as $event){
            $event->eventStart = date('m/d/Y H:i', strtotime($event->eventStart));
            $event->eventEnd = date('m/d/Y H:i', strtotime($event->eventEnd));
        }
        
        return view('events')->with(compact('events'))->with(compact('pageNum'));
    }

    public function getEventJson($eventID){
        $event = $this->getEventByID($eventID);

        return response()->json($event);
    }

    public function getEventsByDate(Request $request){
        $ret = DB::table('events')->whereBetween('eventStart', [$request->start, $request->end])->get();

        return response()->json($ret);
    }

    public function handleForm(Request $request){
        
        if($request->action == "add"){
            $this->newEvent($request);
        }
        else if($request->action == "update"){
            $this->updateEvent($request);
        }
        else if($request->action == "remove"){
            $this->deleteEvent($request);
        }
        
        return redirect('/events');
    }
}
