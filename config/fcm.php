<?php
/*
 * FCM/GCM Keys
 *
 * Dbs key: AIzaSyD7sCpKM8bCIVilGnGTwNg6X9iJOwdHKLE
 * Firebase key: AIzaSyDyJgISBTGWG7serUrHYzew0keips-Lmq0
 * Sender id: 892494730759
 *
 */

return [
    'driver' => env('FCM_PROTOCOL', 'http'),
    'log_enabled' => true,

    'http' => [
        'server_key' => env('FCM_SERVER_KEY', 'AAAAz8zU1gc:APA91bEdrNMK_uo6a8YSAzKMlo578FJZZwP1AKpptIljkFHZj-AIgi_EWKVICkY51XJSM_DkXm74mHZIapXtjyKldnxkVeYW4wH0X1BTEuCGR1kSXDqXSsogX29EXdHEvetUusSKJWBu'),
        'sender_id' => env('FCM_SENDER_ID', '892494730759'),
        'server_send_url' => 'https://fcm.googleapis.com/fcm/send',
        'server_group_url' => 'https://android.googleapis.com/gcm/notification',
        'timeout' => 99.0, // in seconds
    ],
];
