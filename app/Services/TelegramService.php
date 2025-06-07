<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class TelegramService
{
    private $botToken;
    private $chatId;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->botToken = config('telegram.telegram_bot_http_token');
        $this->chatId   = config('telegram.telegram_bot_chat_id');
    }

    public function sendMessage($message)
    {
        try {
            $url = "https://api.telegram.org/bot{$this->botToken}/sendMessage";

            $data = [
                'chat_id' => $this->chatId,
                'text'    => $message,
            ];

            Http::post($url, $data);

            return response()->json(['message' => 'Message sent successfully.']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to send message.', 'error' => $e->getMessage()]);
        }
    }
}
