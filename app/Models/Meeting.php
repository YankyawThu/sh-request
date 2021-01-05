<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class Meeting extends Model
{
    use HasFactory;

    public function __construct() {
        $this->live();
        $this->end();
    }

    public function createReq($req) {
        $s = $this->checkStart($req);
        $e = $this->checkEnd($req);
        if($s != '[]' || $e != '[]') {
            return 'fail';
        }
        else 
        $this->meeting_date = $req->meeting_date;
        $this->s_time = $req->start_time;
        $this->e_time = $req->end_time;
        $this->title = $req->meeting_title;
        $this->room = $req->room;
        $this->host = $req->host;
        $this->join = $req->join;
        $this->vc = $req->video_conferencing;
        $this->name = $req->name;
        $this->pos = $req->position;
        $this->dept = $req->department;
        $this->user_id = auth()->user()->id;
        $this->save();
        return 'success';
    }

    public function checkStart($req) {
        $date = $req->meeting_date;
        $s_time = $req->start_time;
        $room = $req->room;
        $result = DB::table('meetings')->where([
            ['meeting_date', '=', $date],
            ['s_time', '<=', $s_time],
            ['e_time', '>', $s_time],
            ['room', '=', $room],
        ])->get();
        return $result;
    }

    public function checkEnd($req) {
        $date = $req->meeting_date;
        $s_time = $req->start_time;
        $e_time = $req->end_time;
        $room = $req->room;
        $result = DB::table('meetings')->where([
            ['meeting_date', '=', $date],
            ['s_time', '>=', $s_time],
            ['s_time', '<', $e_time],
            ['room', '=', $room],
        ])->get();
        return $result;
    }

    public function live() {
        $get_date = Carbon::now('Asia/Yangon')->toDateString();
        $get_time = Carbon::now('Asia/Yangon')->toTimeString();
        DB::table('meetings')->where([
            ['meeting_date', '=', $get_date],
            ['s_time', '<=', $get_time]
            ])->update([
                'state' => 'live'
            ]);
    }

    public function end() {
        $get_date = Carbon::now('Asia/Yangon')->toDateString();
        $get_time = Carbon::now('Asia/Yangon')->toTimeString();
        DB::table('meetings')->where('meeting_date' , '<' , $get_date)->orWhere([
            ['meeting_date', '=', $get_date],
            ['e_time', '<=', $get_time]
            ])->update([
                'state' => 'end'
            ]);
    }

    public function checkDate($req) {
        return DB::table('meetings')->where('meeting_date', $req->date)->get();
    }

    public function stateCount() {
        $live = count(Meeting::where('state' , 'live')->get());
        $end = count(Meeting::where('state' , 'end')->get());
        $upcoming= count(Meeting::where('state' , null)->get());
        return $result = array($live, $upcoming, $end);
    }

    public function upcomingState() {
        return DB::table('meetings')->where('state' , null)->get();
    }

    public function liveState() {
        return DB::table('meetings')->where('state' , 'live')->get();
    }

    public function endState() {
        return DB::table('meetings')->where('state' , 'end')->get();
    }

    public function approve($id) {
        DB::table('meetings')->where('id' , $id)->update(['approve' => 'yes']);
        return 'Approved';
    }

    public function edit($id,$req) {
        DB::table('meetings')->where('id' , $id)->update([
            'vc' => $req->vc,
            'title' => $req->title,
            'host' => $req->host,
            'join' => $req->join,
            'name' => $req->name,
            'pos' => $req->pos,
            'dept' => $req->dept
        ]);
        return 'updated';
    }

}
