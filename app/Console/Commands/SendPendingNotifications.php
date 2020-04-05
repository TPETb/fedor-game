<?php namespace App\Console\Commands;

use App\Models\Player;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class SendPendingNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:send-pending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends notifications to all players who played more then 24 hours ago.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $token = config('facebook.token');

        $client = new Client([
            'base_uri' => "https://graph.facebook.com/v2.6/me/messages?access_token={$token}",
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);

        /** @var Player[] $playersPendingNotification */
        $playersPendingNotification = Player::query()
            ->whereDate('last_played_at', '<=', Carbon::now()->subDay()) // excessive. safety trigger for future dev. see WebhookController trick
            ->whereDate('last_notified_at', '<=', Carbon::now()->subDay())
            ->get();

        foreach ($playersPendingNotification as $player) {
            if (!in_array($player->psid, config('facebook.allowed_psids'))) {
                continue;
            }

            try {
                $client->post('', [
                    'body' => \GuzzleHttp\json_encode($this->getBody($player->psid))
                ]);
            } finally {
                $player->last_notified_at = Carbon::now();
                $player->save();
            }
        }
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