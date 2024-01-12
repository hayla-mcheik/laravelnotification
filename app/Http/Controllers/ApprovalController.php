<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function submitRequest(Request $request)
    {
        // Store the user's request in the database with a "pending" status
        $approvalRequest = new ApprovalRequest([
            'user_id' => auth()->id(),
            'reason' => $request->input('reqapproval'),
            'days_needed' => $request->input('reqdays'),
            'status' => 'pending', // Initial status
        ]);
        $approvalRequest->save();

        // Send a notification to the admin about the new request
        $adminUser = AdminUser::find($adminUserId); // Replace with the appropriate method to retrieve the admin user
        $adminFcmToken = $adminUser->fcm_token;
        $notificationData = [
            'title' => 'New Approval Request',
            'body' => 'A new approval request has been submitted.',
        ];
        $this->sendNotification($adminFcmToken, $notificationData);

        return response()->json(['message' => 'Approval request submitted successfully']);
    }

    public function reviewRequest(Request $request, $requestId)
    {
        // Admin reviews the request and makes a decision (approve or reject)

        // Update the status of the request in the database
        $status = $request->input('status'); // 'approved' or 'rejected'
        $approvalRequest = ApprovalRequest::findOrFail($requestId);
        $approvalRequest->status = $status;
        $approvalRequest->save();

        // Send a notification to the user who submitted the request
        $userFcmToken = 'user_fcm_token'; // Replace with the user's FCM token
        $notificationData = [
            'title' => 'Request Status Update',
            'body' => "Your request has been $status by the admin.",
        ];
        $this->sendNotification($userFcmToken, $notificationData);

        return response()->json(['message' => 'Request status updated successfully']);
    }

    private function sendNotification($fcmToken, $notificationData)
    {
        // Implement the FCM notification sending logic using Firebase Admin SDK
        // Example using Firebase Admin SDK for PHP:
        $firebase = app('firebase');
        $messaging = $firebase->getMessaging();

        $message = \Kreait\Firebase\Messaging\Message::fromArray([
            'token' => $fcmToken,
            'notification' => $notificationData,
        ]);

        try {
            $messaging->send($message);
        } catch (\Exception $e) {
            // Handle notification sending error
            // Log or return an error message
        }
    }
}
