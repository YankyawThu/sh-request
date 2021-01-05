<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use App\Models\Meeting;
use App\Models\User;
use App\Notifications\reqNoti;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserController;

class MeetingRequestController extends Controller
{   
    public $meeting;
    public $userController;

    public function __construct() {
        $this->meeting = new Meeting();
        $this->userController = new UserController();
    }
    public function checkDate(Request $req) {
        $messages = [
            'date.required' => '* Please select a date !' 
        ];
        Validator::make($req->all(),[
            'date' => 'required'
        ],$messages)->validate();
        $result = $this->meeting->checkDate($req);
        return back()->with('data' , $result);
    }

    public function createReq(Request $req) {
        $messages = [
            'meeting_date.required' => '* Meeting Date is empty.',
            'start_time.required' => '* Start Time is empty.',
            'end_time.required' => '* End Time is empty.',
            'meeting_title.required' => '* Meeting Title is empty.',
            'room.required' => '* Room is empty.',
            'host.required' => '* Host is empty.',
            'join.required' => '* Join is empty.',
            'video_conferencing.required' => '* Video Conferencing is empty.',
            'name.required' => '* Name is empty.',
            'position.required' => '* Position is empty.',
            'department.required' => '* Department is empty.',
        ];
        Validator::make($req->all(), [
            'meeting_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'meeting_title' => 'required',
            'room' => 'required',
            'host' => 'required',
            'join' => 'required',
            'video_conferencing' => 'required',
            'name' => 'required',
            'position' => 'required',
            'department' => 'required', 
        ],$messages)->validate();

        $result = $this->meeting->createReq($req);
        $live = Meeting::where('state' , 'live')->get();
        $end = Meeting::where('state' , 'end')->get();
        $coming= Meeting::where('state' , '')->get();
        if($result == 'fail') {
            return back()->with($result, 'Whoops! Someone is already taken.');
        }
        if($result == 'success') {
            $user_id = DB::table('role_user')->where('role_id' , 1)->pluck('user_id');
            foreach($user_id as $id) {
                if( $id != auth()->user()->id) {
                    User::find($id)->notify(new reqNoti(auth()->user()));
                }
            }
            return back()->with($result, 'Requested Successfully.');
        }
    }

    public function view($id) {
        $stateCount = $this->meeting->stateCount();
        $edit = Meeting::where('id' , $id)->get();
        return Inertia::render('Edit' , ['title' => 'Dashboard' , 'stateCount' => $stateCount , 'edit' => $edit]);
    }

    public function upcoming() {
        $stateCount = $this->meeting->stateCount();
        $upcoming = $this->meeting->upcomingState();
        return Inertia::render('Upcoming' , ['title' => 'Dashboard' , 'stateCount' => $stateCount , 'upcoming' => $upcoming]);
    }

    public function live() {
        $stateCount = $this->meeting->stateCount();
        $live = $this->meeting->liveState();
        return Inertia::render('Live' , ['title' => 'Dashboard' , 'stateCount' => $stateCount , 'live' => $live]);    
    }

    public function end() {
        $stateCount = $this->meeting->stateCount();
        $end = $this->meeting->endState();
        return Inertia::render('End' , ['title' => 'Dashboard' , 'stateCount' => $stateCount , 'end' => $end]);
    }

    public function approve($id) {
        $result = $this->meeting->approve($id);
        return back()->with('success' , $result);
    }

    public function edit($id,Request $req) {
        if(Meeting::where('id' , $id)->value('user_id') === auth()->user()->id) {
            $result = $this->meeting->edit($id,$req);
            return back()->with('success' , $result);
        }
        else return 'This is not your request.';
    }

    public function delete($id) {
        if(Meeting::where('id' , $id)->value('user_id') === auth()->user()->id) {
            Meeting::where('id' , $id)->delete();
            return redirect()->route('/');
        }
        else return 'This is not your request.';
    }

}
