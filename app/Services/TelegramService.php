<?php

namespace App\Services;

use App\Contracts\TelegramServiceInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;

class TelegramService implements TelegramServiceInterface
{
    private $baseUrl = 'https://api.telegram.org/bot';
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

        $this->baseUrl .= $this->botToken . '/';
    }

    public function sendMessage(string $message): JsonResponse
    {
        try {
            $url = $this->baseUrl . 'sendMessage';

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
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function sendPhoto(UploadedFile $photo, string $caption): JsonResponse
    {
        try {
            $url = $this->baseUrl . 'sendPhoto';

            $photoPath = $photo->getPathName();
            $photoName = $photo->getClientOriginalName();
            $stream    = fopen($photoPath, 'r');

            $data = [
                'chat_id' => $this->chatId,
                'caption' => $caption,
            ];

            $response = Http::attach(
                'photo',
                $stream,
                $photoName
            )->post($url, $data);

            fclose($stream);

            return response()->json([
                'message' => $response->successful() ? 'Photo sent successfully.' : 'Telegram API Failed.',
                'data'    => $response->json(),
            ], $response->status());
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to send photo.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function sendDocument(UploadedFile $document, string $caption): JsonResponse
    {
        try {
            $url = $this->baseUrl . 'sendDocument';

            $documentPath = $document->getPathName();
            $documentName = $document->getClientOriginalName();
            $stream       = fopen($documentPath, 'r');

            $data = [
                'chat_id' => $this->chatId,
                'caption' => $caption,
            ];

            $response = Http::attach(
                'document',
                $stream,
                $documentName
            )->post($url, $data);

            fclose($stream);

            return response()->json([
                'message' => $response->successful() ? 'Document sent successfully.' : 'Telegram API failed.',
                'data'    => $response->json(),
            ], $response->status());
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to send document.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
