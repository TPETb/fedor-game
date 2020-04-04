<?php namespace App\Http\Controllers;

use App\Models\PendingNotification;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Monolog\Handler\TestHandler;
use Monolog\Logger;
use Namshi\Cuzzle\Middleware\CurlFormatterMiddleware;

class MessageController extends Controller
{

    public function notifyAllPending()
    {
        $token = config('facebook.token');

        $client = new Client([
            'base_uri' => "https://graph.facebook.com/v2.6/me/messages?access_token={$token}",
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);

        $pendingNotifications = PendingNotification::query()->whereDate('last_played_at', '<=', Carbon::now()->subDay());

        foreach ($pendingNotifications as $notification) {
            try {
                $client->post('', [
                    'body' => $this->getBody($notification->psid)
                ]);
            } finally {
                $notification->delete();
            }
        }
    }

    public function test()
    {
        $token = config('facebook.token');

        $psid = '3800092663364887';
        $psid = '2781369061911499';

        $messageBody = $this->getBody($psid);


        $logger = new Logger('guzzle.to.curl'); //initialize the logger
        $testHandler = new TestHandler(); //test logger handler
        $logger->pushHandler($testHandler);

        $handler = HandlerStack::create();
        $handler->after('cookies', new CurlFormatterMiddleware($logger)); //add the cURL formatter middleware

        $client = new Client([
            'base_uri' => "https://graph.facebook.com/v2.6/me/messages?access_token={$token}",
            'handler' => $handler,
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);


        try {
            $response = $client->post('', [
                'body' => \GuzzleHttp\json_encode($messageBody)
            ]);
            var_dump($response);
            var_dump($response->getBody()->getContents());
        } catch (\Exception $e) {
//            throw $e;
        }
        var_dump($testHandler->getRecords()); //check the cURL request in the logs,
    }


    private function getBody($psid)
    {
        return [
            "recipient" => [
                "id" => $psid
            ],
            "message" => [
                "attachment" => [
                    "type" => "template",
                    "payload" => [
                        "template_type" => "generic",
                        "elements" => [
                            [
                                "title" => "Got a minute? ❤️",
                                "image_url" => "https://slesarev.xyz/logo.jpg",
                                "subtitle" => "Relax & guess puzzles in OMG Guess Quiz",
                                "default_action" => [
                                    "type" => "web_url",
                                    "url" => "https://www.facebook.com/instantgames/384784729008553/",
                                    "messenger_extensions" => false,
                                    "webview_height_ratio" => "tall",
                                ],
                                "buttons" => [
                                    [
                                        "type" => "game_play",
                                        "title" => "Play"
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }
}
