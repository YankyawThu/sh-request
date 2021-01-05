<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    $get_id = DB::table('role_user')->where('user_id' , $id)->value('role_id');
    return (int) $get_id === (int) Role::where('name' , 'admin')->value('id');
});
