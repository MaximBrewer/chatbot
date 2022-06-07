<?php

namespace App\Http\Controllers;

use App\Models\Telebot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use TgBotApi\BotApiBase\Method\ForwardMessageMethod;
use TgBotApi\BotApiBase\Method\SendMessageMethod;

class TelegramBotController extends Controller
{
    public function webhook(Request $request)
    {
        try {
            $post = $request->all();
            $bot = new Telebot();

            if (
                isset($post['my_chat_member'])
                && isset($post['my_chat_member']['new_chat_member'])
                && isset($post['my_chat_member']['new_chat_member']['user'])
                && isset($post['my_chat_member']['new_chat_member']['user']['is_bot'])
            ) {
                $bot = new Telebot();
                $userId = $post['my_chat_member']['chat']['id'];
                $bot->send(SendMessageMethod::create($userId, '<b>Hello!</b>', [
                    'parseMode' => 'html'
                ]));
            } elseif (
                isset($post['message'])
                && isset($post['message']['text'])
                && isset($post['message']['from'])
                && isset($post['message']['from']['id'])
            ) {
                switch ($post['message']['text']) {
                    case "/start":
                        $message = __('START_MESSAGE');
                        $bot->send(
                            SendMessageMethod::create(
                                $post['message']['from']['id'],
                                $message,
                                [
                                    'parseMode' => 'html'
                                ]
                            )
                        );
                        break;
                    case config('telegrambot.hash'):
                        $message = __('START_MESSAGE');
                        if (
                            isset($post['message']['chat'])
                            && isset($post['message']['chat']['id'])
                        ) {
                            file_put_contents(storage_path('chatid'), $post['message']['chat']['id']);
                        }
                        break;
                    default:
                        if ($chatId = file_get_contents(storage_path('chatid'))) {
                            if ($chatId == $post['message']['chat']['id']) {
                                if ($post['message']['reply_to_message']) {
                                    if (
                                        $post['message']['reply_to_message']['forward_from']
                                        && $post['message']['reply_to_message']['forward_from']['id']
                                    )
                                        $bot->send(
                                            SendMessageMethod::create(
                                                $post['message']['reply_to_message']['forward_from']['id'],
                                                $post['message']['text']
                                            )
                                        );
                                }
                            } else {
                                $bot->send(
                                    ForwardMessageMethod::create(
                                        $chatId,
                                        $post['message']['chat']['id'],
                                        $post['message']['message_id']
                                    )
                                );
                            }
                        }
                }
            }
        } catch (\Throwable $e) {
            Log::write('error',  $e->getMessage());
        }
    }
}
