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
        return DB::table('events')->where('id', $eventID)->first();
    }

    public function newEvent(Request $request){

        $eventID = DB::table('events')->insertGetId([
            'name'=>$request->name,
            'about'=>$request->about,
            'location'=>$request->location,
            'eventStart'=>$request->eventStart,
            'eventEnd'=>$request->eventEnd,
            'user_id'=>$request->user()->id
        ]);

        
        if($request->hasFile('photos')){
            Storage::makeDirectory('events' . $eventID);
            foreach($request->file('photos') as $photo){
                $photo->store($eventID . "/");
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
        $offset = $pageNum + 10;
        $events = $this->getEvents($offset);

        foreach($events as $event){
            $event->eventStart = date('m/d/Y H:i', strtotime($event->eventStart));
            $event->eventEnd = date('m/d/Y H:i', strtotime($event->eventEnd));
        }

        return view('events', compact('events'));
    }

    public function getEventJson($eventID){
        $event = DB::table('events')->where('id', $eventID)->first();

        return response()->json($event);
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
