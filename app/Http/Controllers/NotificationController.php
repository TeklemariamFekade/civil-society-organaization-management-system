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


    public function send_address_change_notification()
    {
    }
    public function send_name_change_notification()
    {
    }
    public function send_logo_letter_notification()
    {
    }
    public function send_meeting_letter_notification()
    {
    }

    public function send_task_notification()
    {
    }
}
