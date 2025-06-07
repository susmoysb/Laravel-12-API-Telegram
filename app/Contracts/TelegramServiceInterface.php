<?php

namespace App\Contracts;

use Illuminate\Http\JsonResponse;

interface TelegramServiceInterface
{
    public function sendMessage(string $message): JsonResponse;
}
