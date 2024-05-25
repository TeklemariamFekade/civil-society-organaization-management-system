<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\CSO;



use Illuminate\Support\Facades\Auth;




use Carbon\Carbon;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // notification Index

    public function viewDataEncoderNotification()
    {
        $loggedInUserId = Auth::id();

        // Retrieve unread notifications assigned to the logged-in user
        $unreadNotifications = Notification::where('user_id', $loggedInUserId)
            ->where('status', false)
            ->get();

        // Retrieve read notifications assigned to the logged-in user
        $readNotifications = Notification::where('user_id', $loggedInUserId)
            ->where('status', true)
            ->get();

        // Combine the unread and read notifications
        $notifications = $unreadNotifications->merge($readNotifications);
        return view("notifications.dataEncoderNotification", compact("notifications"));
    }
    public function viewSupervisorNotification()
    {
        $loggedInUserId = Auth::id();

        // Retrieve unread notifications assigned to the logged-in user
        $unreadNotifications = Notification::where('user_id', $loggedInUserId)
            ->where('status', false)
            ->get();

        // Retrieve read notifications assigned to the logged-in user
        $readNotifications = Notification::where('user_id', $loggedInUserId)
            ->where('status', true)
            ->get();

        // Combine the unread and read notifications
        $notifications = $unreadNotifications->merge($readNotifications);

        return view("notifications.supervisorNotification", compact("notifications"));
    }
    public function viewExpertNotification()
    {
        $loggedInUserId = Auth::id();

        // Retrieve unread notifications assigned to the logged-in user
        $unreadNotifications = Notification::where('user_id', $loggedInUserId)
            ->where('status', false)
            ->get();

        // Retrieve read notifications assigned to the logged-in user
        $readNotifications = Notification::where('user_id', $loggedInUserId)
            ->where('status', true)
            ->get();

        // Combine the unread and read notifications
        $notifications = $unreadNotifications->merge($readNotifications);
        return view("notifications.expertNotification", compact("notifications"));
    }
    public function viewRepresentativeNotification()
    {
        $loggedInUserId = Auth::guard('representative')->id();
        $cso = CSO::where('representative_id', $loggedInUserId)->first();

        if ($cso !== null) {
            // Retrieve all notifications related to the CSO of the logged-in representative
            $allNotifications = Notification::whereHas('cso', function ($query) use ($loggedInUserId) {
                $query->where('representative_id', $loggedInUserId);
            })->get();

            // Separate the unread and read notifications
            $unreadNotifications = $allNotifications->where('status', false);
            $readNotifications = $allNotifications->where('status', true);

            // Combine the unread and read notifications, with unread first
            $notifications = $unreadNotifications->merge($readNotifications);
        } else {
            $notifications = collect([]);
        }

        return view("notifications.representativeNotification", compact("notifications"));
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





    // delate notifications
    public function deleteSupervisorNotification(Notification $notification)
    {
        $notification->delete();

        return redirect()->route('notification.viewSupervisorNotification')
            ->with('success', 'notification  deleted successfully.');
    }

    public function deleteRepresentativeNotification(Notification $notification)
    {
        $notification->delete();

        return redirect()->route('notification.viewRepresentativeNotification')
            ->with('success', 'notification  deleted successfully.');
    }


    public function deleteExpertNotification(Notification $notification)
    {
        $notification->delete();

        return redirect()->route('notification.viewExpertNotification')
            ->with('success', 'notification  deleted successfully.');
    }

    public function deleteDataEncoderNotification(Notification $notification)
    {
        $notification->delete();

        return redirect()->route('notification.viewDataEncoderNotification')
            ->with('success', 'notification  deleted successfully.');
    }
}
