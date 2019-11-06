<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $events = DB::table('events')->orderBy('eventStart', 'desc')->limit(10)->get();

        foreach($events as $event){
            $event->eventStart = date('m/d/Y H:i', strtotime($event->eventStart));
            $event->eventEnd = date('m/d/Y H:i', strtotime($event->eventEnd));
        }

        $announcements = DB::table('announcements')->orderBy('updated_at', 'desc')->limit(10)->get();

        

        return view('home', compact('events'))->with(compact('announcements'));
    }
}
