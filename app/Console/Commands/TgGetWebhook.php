<?php

namespace App\Console\Commands;

use App\Models\Telebot;
use Illuminate\Console\Command;
use TgBotApi\BotApiBase\Method\GetWebhookInfoMethod;

class TgGetWebhook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tg:webhookget';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Telegram Get WebHook';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $bot = new Telebot();
        print_r($bot->getWebhookInfo(new GetWebhookInfoMethod()));
        return 0;
    }
}
