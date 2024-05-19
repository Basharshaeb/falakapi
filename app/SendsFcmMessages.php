<?php
namespace App;

trait SendsFcmMessages
{
    /**
     * Send an FCM message to a specific device.
     *
     * @param string $token
     * @param string $title
     * @param string $body
     * @param array $data
     * @return bool|string
     */
    public function sendFcmMessageToDevice($token, $title, $body, $data = [])
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $serverKey = env('FCM_SERVER_KEY');

        $notification = [
            'title' => $title,
            'body' => $body,
            'sound' => 'default'
        ];

        $fields = [
            'to' => $token,
            'notification' => $notification,
            'data' => $data,
        ];

        $headers = [
            'Authorization: key=' . $serverKey,
            'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);

        return $result;
    }

    /**
     * Send an FCM message to a specific topic.
     *
     * @param string $topic
     * @param string $title
     * @param string $body
     * @param array $data
     * @return bool|string
     */
    public function sendFcmMessageToTopic($topic, $title, $body, $data = [])
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $serverKey = env('FCM_SERVER_KEY');

        $notification = [
            'title' => $title,
            'body' => $body,
            'sound' => 'default'
        ];

        $fields = [
            'to' => '/topics/' . $topic,
            'notification' => $notification,
            'data' => $data,
        ];

        $headers = [
            'Authorization: key=' . $serverKey,
            'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);

        return $result;
    }
}
