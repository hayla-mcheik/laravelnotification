<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function sendNotification(Request $request)
    {
        // Retrieve the FCM token and notification data from the request
        $fcmToken = $request->input('fcmToken');
        $notificationData = $request->all();

        // Implement your logic to send notifications using FCM here
        // You can use Firebase Admin SDK for PHP or Firebase PHP SDK to send FCM messages

        // Example using Firebase Admin SDK for PHP:
        $firebase = app('firebase');
        $messaging = $firebase->getMessaging();

        $message = \Kreait\Firebase\Messaging\Message::fromArray([
            'token' => $fcmToken,
            'notification' => [
                'title' => $notificationData['title'],
                'body' => $notificationData['body'],
            ],
        ]);

        try {
            $messaging->send($message);

            // Successfully sent notification
            return response()->json(['message' => 'Notification sent successfully']);
        } catch (\Exception $e) {
            // Failed to send notification
            return response()->json(['error' => 'Failed to send notification']);
        }
    }

    public function storeApprovalRequest(Request $request)
    {
        // Validate the approval request and store it in the database
        $this->validate($request, [
            'reqapproval' => 'required',
            'reqdays' => 'required|numeric',
        ]);

        $approvalRequest = new ApprovalRequest([
            'user_id' => auth()->id(),
            'reason' => $request->input('reqapproval'),
            'days_needed' => $request->input('reqdays'),
            'status' => 'pending', // Initial status
        ]);

        $approvalRequest->save();

        return response()->json(['message' => 'Approval request submitted successfully']);
    }
}
