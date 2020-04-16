<?php

namespace Tests\Unit;

use App\Console\Commands\SendPendingNotifications;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class NextNotificationDatesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $sender = new SendPendingNotifications();

        $lastPlayed = Carbon::now()->subHour();

        $nextNotification = $sender->calculateNextNotificationAt($lastPlayed);

//        $this->assertEquals($lastPlayed->addDays(2)->addHour()->format('Y-m-d H:i:s'), $nextNotification->format('Y-m-d H:i:s'));

        echo $lastPlayed->format('Y-m-d H:i:s') . ' - ' . $sender->calculateNextNotificationAt($lastPlayed)->format('Y-m-d H:i:s') . "\n";
        $lastPlayed->subDay();
        echo $lastPlayed->format('Y-m-d H:i:s') . ' - ' . $sender->calculateNextNotificationAt($lastPlayed)->format('Y-m-d H:i:s') . "\n";
        $lastPlayed->subDay();
        echo $lastPlayed->format('Y-m-d H:i:s') . ' - ' . $sender->calculateNextNotificationAt($lastPlayed)->format('Y-m-d H:i:s') . "\n";
        $lastPlayed->subDay();
        echo $lastPlayed->format('Y-m-d H:i:s') . ' - ' . $sender->calculateNextNotificationAt($lastPlayed)->format('Y-m-d H:i:s') . "\n";
        $lastPlayed->subDay();
        echo $lastPlayed->format('Y-m-d H:i:s') . ' - ' . $sender->calculateNextNotificationAt($lastPlayed)->format('Y-m-d H:i:s') . "\n";
        $lastPlayed->subDay();
        echo $lastPlayed->format('Y-m-d H:i:s') . ' - ' . $sender->calculateNextNotificationAt($lastPlayed)->format('Y-m-d H:i:s') . "\n";
        $lastPlayed->subDay();
        echo $lastPlayed->format('Y-m-d H:i:s') . ' - ' . $sender->calculateNextNotificationAt($lastPlayed)->format('Y-m-d H:i:s') . "\n";
        $lastPlayed->subDay();
        echo $lastPlayed->format('Y-m-d H:i:s') . ' - ' . $sender->calculateNextNotificationAt($lastPlayed)->format('Y-m-d H:i:s') . "\n";
        $lastPlayed->subDay();
        echo $lastPlayed->format('Y-m-d H:i:s') . ' - ' . $sender->calculateNextNotificationAt($lastPlayed)->format('Y-m-d H:i:s') . "\n";
        $lastPlayed->subDay();
        echo $lastPlayed->format('Y-m-d H:i:s') . ' - ' . $sender->calculateNextNotificationAt($lastPlayed)->format('Y-m-d H:i:s') . "\n";
        $lastPlayed->subDay();
        echo $lastPlayed->format('Y-m-d H:i:s') . ' - ' . $sender->calculateNextNotificationAt($lastPlayed)->format('Y-m-d H:i:s') . "\n";
        $lastPlayed->subDay();
        echo $lastPlayed->format('Y-m-d H:i:s') . ' - ' . $sender->calculateNextNotificationAt($lastPlayed)->format('Y-m-d H:i:s') . "\n";
        $lastPlayed->subDay();
        echo $lastPlayed->format('Y-m-d H:i:s') . ' - ' . $sender->calculateNextNotificationAt($lastPlayed)->format('Y-m-d H:i:s') . "\n";
        $lastPlayed->subDay();
        echo $lastPlayed->format('Y-m-d H:i:s') . ' - ' . $sender->calculateNextNotificationAt($lastPlayed)->format('Y-m-d H:i:s') . "\n";
        $lastPlayed->subDay();
        echo $lastPlayed->format('Y-m-d H:i:s') . ' - ' . $sender->calculateNextNotificationAt($lastPlayed)->format('Y-m-d H:i:s') . "\n";
        $lastPlayed->subDay();
        echo $lastPlayed->format('Y-m-d H:i:s') . ' - ' . $sender->calculateNextNotificationAt($lastPlayed)->format('Y-m-d H:i:s') . "\n";
        $lastPlayed->subDay();
    }
}
