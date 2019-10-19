<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashController extends Controller
{
    public function getUserStats(){
        $stats = (object)[];

        $stats->total = DB::table('users')->count();

        $roles = DB::table('roles')->get();

        foreach($roles as $role){
            $roleName = $role->name;
            $stats->$roleName = DB::table('users')->where('role_id', $role->id)->count();
        }

        return $stats;
    }

    public function getEventStats(){
        $stats = (object)[];

        $stats->events = DB::table('events')->count();

        $stats->upcoming = DB::table('events')->where('eventStart', '>=', date('y-m-d'))->count();

        $stats->past = DB::table('events')->where('eventEnd', '<', date('y-m-d'))->count();

        return $stats;
    }

    public function getStats(){
        $userStats = $this->getUserStats();
        $eventStats = $this->getEventStats();

        return view('admin.dashboard')
            ->with(compact('userStats'))
            ->with(compact('eventStats'));
    }
}
