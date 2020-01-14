<?php namespace App\Http\Controllers;

use Carbon\Carbon;

class WebHookController extends Controller
{


    public function webhook()
    {
        echo $_REQUEST['hub_challenge'] ?? 'ok';

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
