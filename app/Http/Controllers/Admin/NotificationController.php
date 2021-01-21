<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\LeageMatches;
use App\Model\MatchesReferees;
use App\Model\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\AllowancesValue;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $notifications = Notification::get();
        return view('panel.notifications.index',compact('notifications'));
    }
    public function getAllNotifications()
    {
        $notifications = Notification::orderBy('created_at')->whereNull('read_at')->with('referee')->get();
        return response()->json($notifications, 200) ;   /// json 
    }
    
    public function updateNotificationsToRead($id)
    {
        $updateNotifications = Notification::where('referee_id',$id)->update(['read_at'=>now()]);
        return response()->json($updateNotifications, 200) ;   /// json 

    }

}
