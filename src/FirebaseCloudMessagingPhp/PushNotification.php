<?php
namespace Fcm\FirebaseCloudMessagingPhp\FirebaseCloudMessagingPhp;


class PushNotification
{
    private $client;
    private $serverToken;

    public function __construct(string $serverToken)
    {
        $this->client = new \GuzzleHttp\Client();
        $this->serverToken = $serverToken;
    }

    public function sendMessage(string $clientToken, string $title, string $msm, string $imageUrl, array $data = ['body' => null])
    {
        $body = [
            "to" => $clientToken,
            "collapse_key" => "type_a",
            "notification" => [
                "title" => $title,
                "body" => $msm,
                "image" => $imageUrl,
                "icon" => $imageUrl,
                "link" => array_key_exists('link', $data) ? $data['link'] : "",
                "click_action" => "OPEN_ACTIVITY_1",
            ],
            "data" => $data,
        ];

        $response = $this->client->request('POST', "https://fcm.googleapis.com/fcm/send", [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'key=' . $this->serverToken,
            ],
            'body' => json_encode($body),
        ]);

        return $response->getStatusCode() != "200" ? json_decode([], true) : json_decode($response->getBody(), true);
    }

    public function validateClientToken(string $clientToken)
    {
        $response = $this->client->request('GET', "https://iid.googleapis.com/iid/info/" . $clientToken, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $this->serverToken,
            ],
        ]);

        return $response->getStatusCode() != "200" ? json_decode([], true) : json_decode($response->getBody(), true);
    }
}
