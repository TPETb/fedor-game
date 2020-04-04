<?php namespace App\Http\Controllers;

use App\Models\PendingNotification;
use Carbon\Carbon;

class WebHookController extends Controller
{
    public function webhook()
    {
        $input = '{"object":"page","entry":[{"id":"111690237027664","time":1586012820046,"messaging":[{"recipient":{"id":"111690237027664"},"timestamp":1586012820046,"sender":{"id":"3800092663364887"},"game_play":{"game_id":"384784729008553","player_id":"2922417977837036"}}]}]}';

        $data = json_decode($input, true);

        try {
            $psid = $data['entry'][0]['messaging'][0]['sender']['id'];
        } catch (\Exception $exception) {
            return;
        }

        $notification = PendingNotification::where('psid', $psid)->first();

        if (!$notification) {
            $notification = new PendingNotification();
        }

        $notification->psid = $psid;
        $notification->last_played_at = Carbon::now();

        $notification->save();
    }
}
