<?php

namespace App\Console\Commands;

use App\Models\Telebot;
use Illuminate\Console\Command;
use TgBotApi\BotApiBase\Method\SetWebhookMethod;

class TgSetWebhook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tg:webhookset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Telegram Set WebHook';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $bot = new Telebot();
        $webHookMethod = new SetWebhookMethod();
        $webHookMethod->fill([
            'url' => config('app.url') . '/tg/webhook'
        ]);
        $bot->setWebhook($webHookMethod);
        return 0;
    }
}
