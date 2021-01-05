<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use App\Models\Meeting;
use App\Actions\Fortify\CreateNewUser;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\MeetingRequestController;

class UserController extends Controller
{
    public function __construct() {
        
    }

    public function create_user(Request $req) {
        $user = new CreateNewUser();
        $input = [
            'name' => $req->name,
            'email' => $req->email,
            'role' => $req->role,
            'password' => $req->password,
        ];
        if( Gate::allows('admin') ) {
            $user->create($input);
            return back()->with('success' , 'Created.');
        }
    }

    public function approve_req($id) {
        if( Gate::allows('admin') ) {
            return redirect()->route('approve', [$id]);
        }
        else return 'Contact Admin';
    }

    public function notiList() {
        $user = User::find(auth()->user()->id);
        $noti = array();
        foreach ($user->notifications as $notification) {
            array_push($noti,$notification);
        }
        return $noti;
    }
}
