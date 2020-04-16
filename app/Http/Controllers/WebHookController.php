<?php namespace App\Http\Controllers;

use App\Models\Player;
use Carbon\Carbon;

class WebHookController extends Controller
{
    public function webhook()
    {
        echo $_REQUEST['hub_challenge'] ?? 'ok';

        $this->log();

        $input = file_get_contents('php://input');

        $data = json_decode($input, true);

        try {
            $psid = $data['entry'][0]['messaging'][0]['sender']['id'];
        } catch (\Exception $exception) {
            return;
        }

        $player = Player::query()->where('psid', $psid)->first();

        if (!$player) {
            $player = new Player();
        }

        $player->psid = $psid;
        $player->last_played_at = Carbon::now();
        $player->next_notification_at = Carbon::now()->addHour();

        $player->save();
    }


    private function log()
    {
        $data = '#### $_REQUEST ####';
        $data .= "\n";
        $data .= print_r($_REQUEST, 1);
        $data .= "\n\n";
        $data .= '#### $_SERVER ####';
        $data .= "\n";
        $data .= print_r($_SERVER, 1);
        $data .= "\n\n";
        $data .= '#### php://input ####';
        $data .= "\n";
        $data .= file_get_contents('php://input');

        file_put_contents('../log/' . Carbon::now()->format('Y-m-d H:i:s.u') . '.log', $data);
    }
}
