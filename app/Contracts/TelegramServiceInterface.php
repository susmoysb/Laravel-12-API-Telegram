<?php

namespace App\Contracts;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;

interface TelegramServiceInterface
{
    public function sendMessage(string $message): JsonResponse;
    public function sendPhoto(UploadedFile $message, string $caption): JsonResponse;
}
