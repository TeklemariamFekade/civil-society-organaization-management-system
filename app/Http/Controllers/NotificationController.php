<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\CSO;



use Illuminate\Support\Facades\Auth;




use Carbon\Carbon;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    public function index()
    {
    }

    public function viewDataEncoderNotification()
    {
        $loggedInUserId = Auth::id();

        // Retrieve tasks assigned to the logged-in user
        $notifications = Notification::where('user_id', $loggedInUserId)
            ->get();
        return view("notifications.dataEncoderNotification", compact("notifications"));
    }

    public function viewSupervisorNotification()
    {
        $loggedInUserId = Auth::id();

        // Retrieve tasks assigned to the logged-in user
        $notifications = Notification::where('user_id', $loggedInUserId)
            ->get();
        return view("notifications.supervisorNotification", compact("notifications"));
    }
    public function viewExpertNotification()
    {
        $loggedInUserId = Auth::id();

        // Retrieve tasks assigned to the logged-in user
        $notifications = Notification::where('user_id', $loggedInUserId)
            ->get();
        return view("notifications.expertNotification", compact("notifications"));
    }
    public function viewRepresentativeNotification()
    {

        $loggedInUserId  = Auth::guard('representative')->id();

        // Get the representative record for the logged-in user
        $cso = CSO::where('representative_id', $loggedInUserId)->first();

        if ($cso !== null) {
            $notifications = Notification::whereHas('cso', function ($query) use ($loggedInUserId) {
                $query->where('representative_id', $loggedInUserId);
            })->get();

            return view("notifications.representativeNotification", compact("notifications"));
        } else {
            return view("notifications.representativeNotification", ['notifications' => []]);
        }
    }



    //Vew detail notification Detail

    public function notificationDetail($id)
    {
        $notification = Notification::find($id);
        if ($notification->status == false) {
            $notification->status = true;
            $notification->save();
        }
        return view('notifications.notificationDetail', compact('notification'));
    }
    public function supervisorNotificationDetail($id)
    {
        $notification = Notification::find($id);
        if ($notification->status == false) {
            $notification->status = true;
            $notification->save();
        }
        return view('notifications.supervisorNotificationDetail', compact('notification'));
    }
    public function expertNotificationDetail($id)
    {
        $notification = Notification::find($id);
        if ($notification->status == false) {
            $notification->status = true;
            $notification->save();
        }
        return view('notifications.expertDetailNotification', compact('notification'));
    }
    public function dataEncoderNotificationDetail($id)
    {
        $notification = Notification::find($id);
        if ($notification->status == false) {
            $notification->status = true;
            $notification->save();
        }
        return view('notifications.dataEncoderDetailNotification', compact('notification'));
    }

    // delete notification


    public function deleteRepresentativeNotification($id)
    {
        $notification = Notification::find($id);
        $notification->delete();
        return view('notifications.notificationDetail', compact('notification'));
    }

    public function deleteExpertNotification($id)
    {
        $notification = Notification::find($id);
        $notification->delete();
        return view('notifications.expertDetailNotification', compact('notification'));
    }

    public function deleteDataEncoderNotification($id)
    {
        $notification = Notification::find($id);
        $notification->delete();

        return view('notifications.dataEncoderDetailNotification', compact('notification'));
    }

    public function deleteSupervisorNotification($id)
    {
        $notification = Notification::find($id);
        $notification->delete();
        return view('notifications.supervisorNotificationDetail', compact('notification'));
    }
}
