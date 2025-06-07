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
        $this->botToken = config('telegram.bot_http_token');
        // $this->chatId   = config('telegram.bot_chat_id');
        // $this->chatId   = config('telegram.bot_group_chat_id'); // For Group
        $this->chatId   = config('telegram.bot_channel_chat_id'); // For Channel
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

            return response()->json([
                'message' => $response->successful() ? 'Message sent successfully.' : 'Telegram API Failed.',
                'data'    => $response->json(),
            ], $response->status());
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to send message.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
