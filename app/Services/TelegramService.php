<?php

namespace App\Services;

use App\Contracts\TelegramServiceInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class TelegramService implements TelegramServiceInterface
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

    public function sendMessage(string $message): JsonResponse
    {
        try {
            $url = "https://api.telegram.org/bot{$this->botToken}/sendMessage";

            $data = [
                'chat_id' => $this->chatId,
                'text'    => $message,
            ];

            $response = Http::post($url, $data);

            return response()->json(['message' => 'Message sent successfully.', 'data' => $response->json()]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to send message.', 'error' => $e->getMessage()]);
        }
    }
}
